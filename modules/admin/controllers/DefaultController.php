<?php

namespace app\modules\admin\controllers;

use app\models\Courses;
use app\models\LoginForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{

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
        // var_dump(Yii::$app->security->generatePasswordHash('admin')); die;
        if (!Yii::$app->user->isGuest) {
            return $this->render('orders');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->render('orders');
        }

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
