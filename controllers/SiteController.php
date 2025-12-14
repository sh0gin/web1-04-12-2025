<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Courses;
use app\models\PaymentStatus;
use app\models\UserOrder;
use app\models\Video;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class SiteController extends ActiveController
{

    public $modelClass = '';
    public $enableCsrfValidation = '';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // remove authentication filter
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => [isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : 'http://' . $_SERVER['REMOTE_ADDR']],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
            'actions' => [
                'courses' => [
                    'Access-Control-Allow-Credentials' => true,
                ],
                'get-video' => [
                    'Access-Control-Allow-Credentials' => true,
                ],
                'but-courses' => [
                    'Access-Control-Allow-Credentials' => true,
                ],
                'cancel' => [
                    'Access-Control-Allow-Credentials' => true,
                ],
                'get-user-courses' => [
                    'Access-Control-Allow-Credentials' => true,
                ],
            ]
        ];

        $auth = [
            'class' => HttpBearerAuth::class,
            'only' => ['courses', 'get-video', 'buy-courses', 'get-user-courses', 'cancel'], // только те action, для которых будет применяться аутентификация
        ];

        // re-add authentication filter
        $behaviors['authenticator'] = $auth;
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = ['options'];

        return $behaviors;
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionCourses()
    {
        $res = Courses::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $res,
            'pagination' => [
                'pageSize' => 5,
            ]
        ]);

        $arr = $dataProvider->getModels();

        foreach ($arr as &$value) {
            $value->img = '/web/img/' . $value->img;
        }

        return $this->asJson([
            'data' => $arr,
            'pagination' => [
                'total' => $dataProvider->totalCount,
                'current' =>  $dataProvider->pagination->page + 1,
                'per_page' => $dataProvider->getCount()
            ]
        ]);
    }

    public function actionGetVideo($course_id)
    {
        $models = Video::findAll(['courses_id' => $course_id]);

        $result = [];

        foreach ($models as $value) {
            $result[] = [
                'id' => $value->id,
                'name' => $value->name,
                'description' => $value->description,
                'video_link' => $value->video_link,
                'hours' => $value->hours,
            ];
        }

        return $this->asJson([
            'data' => $result,
        ]);
    }

    public function actionBuyCourses($course_id)
    {
        $course = Courses::findOne($course_id);

        if (date("Y-m-d") < $course->start_date) {
            $model = UserOrder::findOne(['course_id' => $course_id, 'user_id' => Yii::$app->user->id]);
            if ($model) {
                $model->payment_status_id = PaymentStatus::getId('pending');
                $model->save();
            } else {
                $model = new UserOrder();
                $model->user_id = Yii::$app->user->id;
                $model->course_id = $course_id;
                $model->payment_status_id = PaymentStatus::getId('pending');
                $model->save();
            }
            return $this->asJson([
                'pay_url' => "http://other2/pay?order=$model->id"
            ]);
        } else {
            Yii::$app->response->statusCode = 401;
        }
    }

    public function actionGetUserCourses()
    {
        $model = UserOrder::findAll(['user_id' => Yii::$app->user->id]);

        $result = [];

        foreach ($model as $elem) {
            $course = Courses::findOne($elem->course_id);

            $one = [
                'id' => $elem->id,
                'payment_status' => PaymentStatus::getTitle($elem->payment_status_id),
                'coure' => [
                    'id' => $course->id,
                    'name' => $course->name,
                    'description' => $course->description,
                    'hours'  => $course->hours,
                    'img'  => '/web/img/' . $course->img,
                    'start_date'  => $course->start_date,
                    'end_date'  => $course->end_date,
                    'price'  => $course->price,
                ]
            ];
            $result[] = $one;
        }
        return $this->asJson([
            'data' => $result,
        ]);
    }

    public function actionCancel($id)
    {
        $model = UserOrder::findOne(['user_id' => Yii::$app->user->id, 'course_id' => $id]);

        if ($model) {
            if ($model->payment_status_id == 1) {
                $model->delete();
                return $this->asJson([
                    'status' => 'success'
                ]);
            } else {
                Yii::$app->response->statusCode = 401;
            };
        } else {
            Yii::$app->response->statusCode = 401;
        }
    }

    public function actionPaymentWebhook()
    {
        $status = Yii::$app->request->post()['status'];
        $userOrder = UserOrder::findOne(['id' => Yii::$app->request->post('order_id')]);
        
        if ($userOrder) {
            $userOrder->payment_status_id = PaymentStatus::getId($status == 'success' ? 'Успешно' : 'Отклоненно');
            // return Yii::$app->request->post();
            $userOrder->save(false);
        }
        Yii::$app->response->statusCode = 204;
        return '';
    }
}
