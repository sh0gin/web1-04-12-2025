<?php

namespace app\modules\admin\controllers;

use app\models\Courses;
use app\models\User;
use app\models\UserOrder;
use app\models\UserSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex($id = null)
    {
        $searchModel = new UserSearch();
        if (!$id) {
            $dataProvider = $searchModel->search($this->request->queryParams);
        } else {
            $query = User::find()->innerJoin('user_order', 'user.id = user_order.user_id')->where(['user_order.course_id' => $id]);
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        }

        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();
        $order = new UserOrder();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $order->load($this->request->post());
                $order->user_id = $model->id;
                $order->status_id = 1;
                $order->payment_status_id = 1;
                $order->save(false);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'order' => $order,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionSert($id, $course_id)
    {
        $this->layout = 'sertlte';
        $course = Courses::findOne($course_id);
        $user = User::findOne($id);


        $note = UserOrder::findOne(['user_id' => $id, 'course_id' => $course_id]);
        if ($course && $note) {
            $curl = curl_init();
            // $data = ['student_id' => $id, 'course_id' => $course_id];
            $data = 
            "{'course_id' : " 
            . $course_id 
            . ", 'student_id' : " 
            . $id 
            . "}";
            // var_dump($data); die;
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://other/create-sertificate',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
                // переделать как у Макса
                CURLOPT_HTTPHEADER => array(
                    'Accept: application/json',
                    'Content-Type: application/json',
                    'ClientId: gfdhgfhdfghfghd' // логин чампа
                ),
            ));

            $response = curl_exec($curl);
            // Всегда проверяйте наличие ошибок cURL
            if (curl_errno($curl)) {
                echo 'cURL error: ' . curl_error($curl);
            }
            curl_close($curl);

            $data = json_decode($response);
            $newId = $data->course_number;
            $newId = $newId . substr(time(), -5) . "1";
            return  $this->render('sert', [
                'course' => $course,
                'user' => $user,
                'newId' => $newId,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'Не нашлась запись с таким курсом и пользователем');
            return $this->redirect('/admin');
        }
    }
}
