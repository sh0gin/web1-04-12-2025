<?php

use app\models\Courses;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\CoursesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Курсы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courses-index">

    <?php Pjax::begin(); ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать курс', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <table class="table table-striped table-hover align-middle fs-5">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Длительность</th>
                <th>Обложка</th>
                <th>Дата старта</th>
                <th>Дата окончания</th>
                <th>Стоимость</th>
                <th class="text-end">Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataProvider->models as $value) { ?>
                <tr>
                    <td><?= $value->id ?></td>
                    <td><?= $value->name ?></td>
                    <td><?= $value->description ?></td>
                    <td><?= $value->hours ?></td>
                    <td><?= Html::img('/web/img/' . $value->img, ['alt' => 'изображение курса']) ?></td>
                    <td><?= $value->start_date ?></td>
                    <td><?= $value->end_date ?></td>
                    <td><?= $value->price ?></td>

                    <td class="text-end">
                        <div class="btn-group" role="group">
                            <a href="/course-admin/courses/view?id=<?= $value->id ?>" type="button" class="btn btn-lg btn-outline-primary no-reverse">
                                <img src="/courseadmin/img/icons/eye.svg" alt="eye" class="action-image">
                            </a>
                            <a href="/course-admin/courses/update?id=<?= $value->id ?>" type="button" class="btn btn-lg btn-outline-success no-reverse">
                                <img src="/courseadmin/img/icons/pencil.svg" alt="eye" class="action-image">
                            </a>
                            <a href="/course-admin/courses/delete?id=<?= $value->id ?>" type="button" class="btn btn-lg btn-outline-danger no-reverse">
                                <img src="/courseadmin/img/icons/trash.svg" alt="eye" class="action-image">
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>

        </tbody>
    </table>

    <!-- LinkPager documentation -->
    <?= \yii\bootstrap5\LinkPager::widget(
        [
            'class' => \yii\bootstrap5\LinkPager::class,
            'pagination' => $dataProvider->pagination, 
            'options' => [
                'class' => 'd-flex justify-content-end'
            ]
        ]
    )
    ?>

    <?php Pjax::end(); ?>

</div>