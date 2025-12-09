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

<!-- <table class="table table-striped table-hover align-middle fs-5">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Count</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Electronic</td>
                <td>Technic and electronic devices</td>
                <td>1 234</td>
                <td class="text-end">
                    <div class="btn-group" role="group">
                        <a href="/course-admin/default/category-view" type="button" class="btn btn-lg btn-outline-primary no-reverse">
                            <img src="/courseadmin/img/icons/eye.svg" alt="eye" class="action-image">
                        </a>
                        <a href="/course-admin/default/add-category" type="button" class="btn btn-lg btn-outline-success no-reverse">
                            <img src="/courseadmin/img/icons/pencil.svg" alt="eye" class="action-image">
                        </a>
                        <a href="" type="button" class="btn btn-lg btn-outline-danger no-reverse">
                            <img src="/courseadmin/img/icons/trash.svg" alt="eye" class="action-image">
                        </a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Cloth</td>
                <td>Clothes and rags</td>
                <td>1 234</td>
                <td class="text-end">
                    <div class="btn-group" role="group">
                        <a href="/course-admin/default/category-view" type="button" class="btn btn-lg btn-outline-primary no-reverse">
                            <img src="/courseadmin/img/icons/eye.svg" alt="eye" class="action-image">
                        </a>
                        <a href="/course-admin/default/add-category" type="button" class="btn btn-lg btn-outline-success no-reverse">
                            <img src="/courseadmin/img/icons/pencil.svg" alt="eye" class="action-image">
                        </a>
                        <a href="" type="button" class="btn btn-lg btn-outline-danger no-reverse">
                            <img src="/courseadmin/img/icons/trash.svg" alt="eye" class="action-image">
                        </a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Books</td>
                <td>Books and magazines</td>
                <td>1 234</td>
                <td class="text-end">
                    <div class="btn-group" role="group">
                        <a href="/course-admin/default/category-view" type="button" class="btn btn-lg btn-outline-primary no-reverse">
                            <img src="/courseadmin/img/icons/eye.svg" alt="eye" class="action-image">
                        </a>
                        <a href="/course-admin/default/add-category" type="button" class="btn btn-lg btn-outline-success no-reverse">
                            <img src="/courseadmin/img/icons/pencil.svg" alt="eye" class="action-image">
                        </a>
                        <a href="" type="button" class="btn btn-lg btn-outline-danger no-reverse">
                            <img src="/courseadmin/img/icons/trash.svg" alt="eye" class="action-image">
                        </a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table> -->

<!-- <div class="d-flex justify-content-end">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </div> -->
</div>