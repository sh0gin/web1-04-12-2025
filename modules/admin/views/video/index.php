<?php

use app\models\Courses;
use app\models\Video;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\VideoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Лекции';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать лекцию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <table class="table table-striped table-hover align-middle fs-5">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Курс</th>
                <th>Название</th>
                <th>Продолжительность</th>
                <th>Описание</th>
                <th>Сыллка на видео</th>
                <th class="text-end">Действие</th>

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
                            <a href="/course-admin/video/delete?id=<?= $value->id ?>" type="button" class="btn btn-lg btn-outline-danger no-reverse">
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