<?php

use app\models\Courses;
use app\models\Role;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">
    <div class="d-flex flex-column justify-content-center form-container category">
        <div class="card shadow">
            <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>

                <div class="mb-5">
                    <?= $form->field($model, 'email', ['options' => ['class' => "form-label fs-2"]])->textInput(['options' => ['class' => "form-control fs-2"]])->input('text', ['placeholder' => 'Электронная почта']) ?>
                </div>
                <div class="mb-5">
                    <?= $form->field($model, 'password', ['options' => ['class' => "form-label fs-2"]])->textInput(['options' => ['class' => "form-control fs-2"]])->input('text', ['placeholder' => 'Пароль']) ?>
                </div>
                <div class="mb-5">
                    <?= $form->field($model, 'role_id', ['options' => ['class' => "form-label fs-2"]])->dropDownList(Role::getTitleAll(), ['prompt' => 'Выберите роль пользователя', 'options' => ['class' => "form-control fs-2"]]) ?>
                </div>
                <div class="mb-5">
                    <?= $form->field($model, 'name', ['options' => ['class' => "form-label fs-2"]])->textInput(['options' => ['class' => "form-control fs-2"]])->input('text', ['placeholder' => 'Имя']) ?>
                </div>
                <div class="mb-5">
                    <?= $form->field($order, 'course_id', ['options' => ['class' => "form-label fs-2"]])->dropDownList(Courses::getTitleAll(), ['prompt' => 'Выберите курс зачисления...', 'options' => ['class' => "form-control fs-2"]]) ?>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>