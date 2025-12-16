<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Courses $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="courses-form">
    <div class="d-flex flex-column justify-content-center form-container category">
        <div class="card shadow">
            <div class="card-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'course-form',
                ]); ?>
                <div class="mb-5">
                    <?= $form->field($model, 'name', ['options' => ['class' => "form-label fs-2"]])->textInput(['options' => ['class' => "form-control fs-2"]])->input('text', ['placeholder' => 'Название курса']) ?>
                </div>
                <div class="mb-5">
                    <?= $form->field($model, 'description', ['options' => ['class' => "form-label fs-2"]])->textInput(['options' => ['class' => "form-control fs-2"]])->input('text', ['placeholder' => 'Описание курса']) ?>
                </div>
                <div class="mb-5">
                    <?= $form->field($model, 'hours', ['options' => ['class' => "form-label fs-2"]])->textInput(['options' => ['class' => "form-control fs-2"]])->input('text', ['placeholder' => 'Количество часов']) ?>
                </div>
                <div class="mb-5">
                    <?= $form->field($model, 'price', ['options' => ['class' => "form-label fs-2"]])->textInput([
                        'options' => ['class' => "form-control fs-2"],
                        "value" => '122.00'
                    ])->input('text', ['placeholder' => 'Стоимость']) ?>
                </div>
                <div class="mb-5">
                    <?= $form->field($model, 'start_date', ['options' => ['class' => "form-label fs-2"]])->textInput(['type' => 'date', 'options' => ['class' => "form-control fs-2"]])->widget(\yii\widgets\MaskedInput::class, [
                        'mask' => '99-99-9999'
                    ]) ?>
                </div>
                <div class="mb-5">
                    <?= $form->field($model, 'end_date', ['options' => ['class' => "form-label fs-2"]])->textInput(['type' => 'date', 'options' => ['class' => "form-control fs-2"]]) ?>
                </div>
                <div class="mb-5">
                    <?= $form->field($model, 'img', ['options' => ['class' => "form-label fs-2"]])->fileInput(['options' => ['class' => "form-control fs-2"]]) ?>
                </div>



                <div class="form-group">
                    <div>
                        <?= Html::submitButton('Save', ['class' => 'btn btn-primary w-100 my-2 fs-2', 'name' => 'save-button']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>