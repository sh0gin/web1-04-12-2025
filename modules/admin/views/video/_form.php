<?php

use app\models\Courses;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Video $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="video-form">
    <div class="d-flex flex-column justify-content-center form-container category">
        <div class="card shadow">
            <div class="card-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'course-form',
                ]); ?>
                <?= $form->field($model, 'courses_id')->dropDownList(Courses::find()->select('name')->indexBy('id')->column()) ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'video_link')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'hours')->textInput() ?>



                <div class="form-group">
                    <div>
                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary w-100 my-2 fs-2', 'name' => 'login-button']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>