<?php

/** @var yii\web\View $this */
/** @var string $content */


use app\assets\AdminAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AdminAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <meta charset="UTF-8">
    <!-- <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"> -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Goods</title>
    <script defer src="/courseadmin/bootstrap/js/bootstrap.bundle.js"></script>
    <link rel="shortcut icon" href="/courseadmin/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="/courseadmin/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/courseadmin/css/style.css">
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header id="header">
        <nav class="mt-3 d-flex justify-content-between fs-2">
            <a href="/course-admin/courses" class="text-primary text-decoration-none">Курсы</a>
            <a href="/course-admin/video" class="text-primary text-decoration-none">Лекции</a>
            <a href="/course-admin/user" class="text-primary text-decoration-none">Юзеры</a>
            <?php if (!Yii::$app->user->isGuest) { ?>
                <a href="/course-admin/default/logout" class="text-primary text-decoration-none">Выйти</a>
            <?php
            }
            ?>
            <!-- <div>
                <a href="/course-admin/default/login" class="login text-decoration-none">Login</a>
            </div> -->
        </nav>
    </header>

    

    <div class='offset'>
        <section class="container">
            <?= $content ?>
        </section>

    </div>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>