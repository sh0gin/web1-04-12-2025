<?php

use app\models\Courses;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\Courses $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="courses-view">


    <?php Pjax::begin(); ?>
    <p class="d-flex justify-content-between mt-5 ">
        <?= Html::a('Студента курса', ['/course-admin/user', 'id' => $model->id], ['class' => 'btn btn-primary fs-5']) ?>

        <span class="fs-5 fw-bold">Лекции курса: <?= $model->name ?> </span>

        <?= Html::a('Добавить урок', ['/course-admin/video/create', 'id' => $model->id], ['class' => 'btn btn-primary fs-5']) ?>
    </p>



    <table class="table table-striped table-hover align-middle fs-5">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Курс</th>
                <th>Название урока</th>
                <th>Продолжительность</th>
                <th>Описание</th>
                <th>Сыллка на урок</th>
                <th class="text-end">Действия</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataProvider->models as $value) { ?>
                <tr>
                    <td><?= $value->id ?></td>
                    <td><?= Courses::getTitle($value->courses_id) ?></td>
                    <td><?= $value->name ?></td>
                    <td><?= $value->hours ?></td>
                    <td><?= $value->description ?></td>
                    <td><?= $value->video_link ?></td>

                    <td class="text-end">
                        <div class="btn-group" role="group">
                            <a href="/course-admin/video/view?id=<?= $value->id ?>" type="button" class="btn btn-lg btn-outline-primary no-reverse">
                                <img src="/courseadmin/img/icons/eye.svg" alt="eye" class="action-image">
                            </a>
                            <a href="/course-admin/video/update?id=<?= $value->id ?>" type="button" class="btn btn-lg btn-outline-success no-reverse">
                                <img src="/courseadmin/img/icons/pencil.svg" alt="eye" class="action-image">
                            </a>
                            <a href="" type="button" class="btn btn-lg btn-outline-danger no-reverse">
                                <img src="/courseadmin/img/icons/trash.svg" alt="eye" class="action-image">
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>

        </tbody>
    </table>

    <?php Pjax::end(); ?>

</div>