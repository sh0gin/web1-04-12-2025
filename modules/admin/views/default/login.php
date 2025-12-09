<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->params['title'] = 'Login' ?>


<div class="d-flex flex-column justify-content-center form-container">



    <div class="card shadow">
        <div class="card-body">
            <h2 class="text-center mb-4 fs-1">Authentication</h2>
            <!-- <div class="alert alert-danger fs-2" id="errorMessage">
                Wrong email or password
            </div> -->
            <?php $form = ActiveForm::begin([
                'id' => 'login-form-admin',
            ]); ?>
            <!-- <div class="mb-5">
                <label for="email" class="form-label fs-2">Email</label>
                <input type="email" class="form-control fs-2" id="email" name="email"
                    placeholder="Enter your email">
                <div class="invalid-feedback fs-3">
                    Wrong text for email
                </div>
            </div>
            <div class="mb-5">
                <label for="password" class="form-label fs-2">Password</label>
                <input type="password" class="form-control fs-2 is-invalid" id="password" name="password"
                    placeholder="Enter password">
                <div class="invalid-feedback fs-3">
                    Minimum 6 characters required
                </div>
            </div> -->
            
            <div class="mb-5"> 
                <?= $form->field($model, 'email', ['options' => ['class' => "form-label fs-2"]])->passwordInput(['options' => ['class' => "form-control fs-2"]])->input('some', ['placeholder' => 'Enter your email']) ?>
            </div>
            <div class="mb-5"> 
                <?= $form->field($model, 'password', ['options' => ['class' => "form-label fs-2"]])->passwordInput(['options' => ['class' => "form-control fs-2"]])->input('password', ['placeholder' => 'Enter password']) ?>
            </div>



            <div class="form-group">
                <div>
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary w-100 my-2 fs-2', 'name' => 'login-button']) ?>
                </div>
            </div>
            <!-- <button type="submit" class="btn btn-primary w-100 my-2 fs-2">Login</button> -->
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>