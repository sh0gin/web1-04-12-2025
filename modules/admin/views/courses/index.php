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

$this->title = 'Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courses-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Courses', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <table class="table table-striped table-hover align-middle fs-5">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Hours</th>
                <th>Img</th>
                <th>start_date</th>
                <th>end_date</th>
                <th>price</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($dataProvider->models as $value) { ?>
            <tr>
                <td><?= $value->id ?></td>
                <td><?= $value->name ?></td>
                <td><?= $value->description ?></td>
                <td><?= $value->hours ?></td>
                <td><?= $value->img ?></td>
                <td><?= $value->start_date ?></td>
                <td><?= $value->end_date ?></td>
                <td><?= $value->price ?></td>

                <td class="text-end">
                    <div class="btn-group" role="group">
                        <a href="category_view.html" type="button" class="btn btn-lg btn-outline-primary no-reverse">
                            <img src="/courseadmin/img/icons/eye.svg" alt="eye" class="action-image">
                        </a>
                        <a href="add_category.html" type="button" class="btn btn-lg btn-outline-success no-reverse">
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