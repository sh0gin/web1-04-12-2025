<?php

namespace app\controllers;

use app\models\Role;
use app\models\User;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\VarDumper;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = "";
    public $enableCsrfValidation = "";

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
                'login' => [
                    'Access-Control-Allow-Credentials' => true,
                ]
            ]
        ];

        $auth = [
            'class' => HttpBearerAuth::class,
            'only' => ['logout'], // только те action, для которых будет применяться аутентификация
        ];

        // re-add authentication filter
        $behaviors['authenticator'] = $auth;
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = ['options'];

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();

        // disable the "delete" and "create" actions
        unset($actions['delete'], $actions['create']);

        // customize the data provider preparation with the "prepareDataProvider()" method
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRegister()
    {
        $model = new User(['scenario' => 'register']);

        if ($model->load(Yii::$app->request->post(), '')) {
            if ($model->validate()) {
                $model->role_id = Role::getRole('user');
                $model->password = Yii::$app->security->generatePasswordHash($model->password);
                $model->save();
                return $this->asJson([
                    'success' => true,
                ]);
            } else {
                Yii::$app->response->statusCode = 422;
                return $this->asJson([
                    'message' => 'invalid fields',
                    'errors' => $model->errors,
                ]);
            }
        };
    }

    public function actionLogin()
    {
        $model = new User();

        $model->load(Yii::$app->request->post(), '');

        if ($model->validate()) {
            $user = User::findOne(['email' => $model->email]);
            if (Yii::$app->security->validatePassword($model->password, $user->password)) {
                $user->authKey = Yii::$app->security->generateRandomString();
                $user->save(false);
                return $this->asJson([
                    'body' => [
                        'token' => $user->authKey,
                    ],
                ]);
            } else {
                Yii::$app->response->statusCode = 401;
            }
        } else {
            Yii::$app->response->statusCode = 422;
            return $this->asJson([
                'message' => 'invalid fields',
                'errors' => $model->errors,
            ]);
        };
    }
}
