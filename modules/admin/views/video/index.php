<?php

use app\models\Video;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\VideoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Video', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <table class="table table-striped table-hover align-middle fs-5">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>courses_id</th>
                <th>name</th>
                <th>Hours</th>
                <th>description</th>
                <th>video_link</th>
                <th class="text-end">Actions</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataProvider->models as $value) { ?>
                <tr>
                    <td><?= $value->id ?></td>
                    <td><?= $value->courses_id ?></td>
                    <td><?= $value->name ?></td>
                    <td><?= $value->hours ?></td>
                    <td><?= $value->description ?></td>
                    <td><?= $value->video_link ?></td>

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