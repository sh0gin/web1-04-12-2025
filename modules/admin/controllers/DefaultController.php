<?php

namespace app\modules\admin\controllers;

use app\models\Courses;
use app\models\LoginForm;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => fn() => Yii::$app->user->identity->isAdmin,
                    ],
                ],
                'denyCallback' => function () {
                    if (Yii::$app->user->isGuest) {
                        return Yii::$app->response->redirect('/course-admin/default/login');
                    }
                }
            ],
        ];
    }

    public $defaultAction = 'login';
    /**
     * Renders the index view for the module
     * @return string
     */
    // public function actionIndex()
    // {
    //     self::actionLogin();
    // }

    public function actionCategory()
    {
        // Yii::$app->user->logout();
        $query = Courses::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 1,
            ]
        ]);

        return $this->render('category', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('orders');
        }

        return $this->render('login', [
            'model' => $model
        ]);
    }

    public function actionLogout()
    {
        $model = new LoginForm();
        $user = User::findOne([Yii::$app->user->id]);
        $user->authKey = null;
        $user->save(false);
        Yii::$app->user->logout();
        return $this->render('login', [
            'model' => $model
        ]);
    }

    public function actionAddCourses()
    {

        $model = new Courses();
        if ($model->load(Yii::$app->request->post())) {
            $model->image_full = UploadedFile::getInstance($model, 'img');
            $model->img = $model->image_full->name;
            if ($model->save()) {

                return $this->render('category'); // а я могу здесь сыллку на функцию сделать?
            }
        }

        return $this->render('add-courses', [
            'model' => $model
        ]);
    }

    public function actionOrders()
    {

        return $this->render('orders');
    }

    public function actionGoods()
    {

        return $this->render('goods');
    }

    public function actionAddCategory()
    {

        return $this->render('add-category');
    }

    public function actionAddGood()
    {
        return $this->render('add-good');
    }

    public function actionCategoryView()
    {
        return $this->render('category-view');
    }
}
