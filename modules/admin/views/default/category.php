<?php

use yii\bootstrap5\LinkPager;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\VarDumper;

$this->params['title'] = 'Курсы' ?>
<div class="d-flex justify-content-end mb-4">
    <a href="/course-admin/default/add-courses" class="btn btn-primary fs-3">Добавить курс</a>
</div>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'pager' => [
        'class' => LinkPager::class,
        'options' => [
            'class' => 'd-flex justify-content-end'
        ]
    ],
    'columns' => [
        'name',
        'description',
        'hours',
        'start_date',
        'end_date',
        'price',
        [
            'attribute' => 'img',
            'format' => 'html',
            'value' => fn($model) => Html::img("/web/img/{$model->img}"),
        ],
        [
            'attribute' => 'Действия',
            'format' => 'html',
            'value' => fn($model) => Html::a('Просмотр', ['/course-admin/default/category-view', 'id' => $model->id], ['class' => 'btn btn-outline-primary w-100 m-1'])
                . Html::a('Удалить', ['/course-admin/default/category-view', 'id' => $model->id], ['class' => 'btn btn-outline-primary w-100 m-1'])
                . Html::a('Редактировать', ['/course-admin/default/category-view', 'id' => $model->id], ['class' => 'btn btn-outline-primary w-100 m-1']),
        ]

    ],
]) ?>


</div>