<?php

use app\models\Courses;
use app\models\PaymentStatus;
use app\models\Role;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\VarDumper;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <p>
        <?= Html::a('Создать пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <table class="table table-striped table-hover align-middle fs-5">
        <thead class="table-light">
            <tr>
                <!-- <th>ID</th> -->
                <th>Название</th>
                <th>Электронная почта</th>
                <th>Курс</th>
                <th>Куплен в</th>
                <th>Статус оплаты</th>
                <th>Сертификат</th>
                <!-- <th>Role Id</th> -->
                <!-- <th class="text-end">Actions</th> -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataProvider->models as $value) { 
                if ($value->userOrders) {

                ?>
                
                <tr>
                    <td><?= $value->name ?></td>
                    <td><?= $value->email ?></td>
                    <td><?= Courses::getTitle($value->userOrders[0]->course_id) ?></td>
                    <td><?= $value->userOrders[0]->created_at ?></td>
                    <td><?= PaymentStatus::getTitle($value->userOrders[0]->payment_status_id) ?></td>
                    <td><?= Courses::findOne($value->userOrders[0]->course_id)->end_date < date('Y-m-d')
                        ? Html::a("Выдать сертификат", ['user/sert', 'id' => $value->id, 'course_id' => $value->userOrders[0]->course_id], ['class' => 'btn btn-success'])
                        : "Курс не пройден"
                    ?></td>

                    <!-- <td class="text-end">
                        <div class="btn-group" role="group">
                            <a href="/courseadmin/courses/view?view={$value->id}" type="button" class="btn btn-lg btn-outline-primary no-reverse">
                                <img src="/courseadmin/img/icons/eye.svg" alt="eye" class="action-image">
                            </a>
                            <a href="add_category.html" type="button" class="btn btn-lg btn-outline-success no-reverse">
                                <img src="/courseadmin/img/icons/pencil.svg" alt="eye" class="action-image">
                            </a>
                            <a href="" type="button" class="btn btn-lg btn-outline-danger no-reverse">
                                <img src="/courseadmin/img/icons/trash.svg" alt="eye" class="action-image">
                            </a>
                        </div>
                    </td> -->
                </tr>
            <?php }} ?>

        </tbody>
    </table>

    <?php Pjax::end(); ?>


</div>