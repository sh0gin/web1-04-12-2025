<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

 $this->params['title'] = 'Добавление категории' ?>

<div class="d-flex flex-column justify-content-center form-container category">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="text-center mb-4 fs-1">Добавить|Редактировать категории</h2>
            <!-- <div class="alert alert-danger fs-2" id="errorMessage">
                        Both fields is required
                    </div> -->
            <?php $form = ActiveForm::begin([
                'id' => 'login-form-admin',
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
                <?= $form->field($model, 'price', ['options' => ['class' => "form-label fs-2"]])->textInput(['options' => ['class' => "form-control fs-2"]])->input('text', ['placeholder' => 'Стоимость']) ?>
            </div>
            <div class="mb-5">
                <?= $form->field($model, 'start_date', ['options' => ['class' => "form-label fs-2"]])->textInput(['type' => 'date' ,'options' => ['class' => "form-control fs-2"]]) ?>
            </div>
            <div class="mb-5">
                <?= $form->field($model, 'end_date', ['options' => ['class' => "form-label fs-2"]])->textInput(['type' => 'date' ,'options' => ['class' => "form-control fs-2"]]) ?>
            </div>
            <div class="mb-5">
                <?= $form->field($model, 'img', ['options' => ['class' => "form-label fs-2"]])->fileInput(['options' => ['class' => "form-control fs-2"]]) ?>
            </div>



            <div class="form-group">
                <div>
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary w-100 my-2 fs-2', 'name' => 'login-button']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>