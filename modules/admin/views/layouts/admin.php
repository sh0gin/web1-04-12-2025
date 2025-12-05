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
            <a href="category.html" class="text-primary text-decoration-none">Category</a>
            <a href="index.html" class="text-primary text-decoration-none">Goods</a>
            <a href="orders.html" class="text-primary text-decoration-none">Orders</a>
            <div>
                <a href="login.html" class="login text-decoration-none">Login</a>
            </div>
        </nav>
    </header>

   <section class="container">
        <article class="card my-3">
            <div class="card-title bg-secondary bg-gradient p-3 text-light d-flex justify-content-between">
                <h3>Good name</h3>
                <a href="" title="Delete good" class="btn-danger py-1 px-2 justify-content-center text-decoration-none fs-4">&#x2620;</a>
            </div>
            <div class="card-body d-flex justify-content-between">
                <div class="card-img">
                    <img src="/courseadmin/img/default.jpg" alt="Название товара">
                </div>
                <div class="card-info">
                    <p class="card-text text-black-50"><span class="text-dark">About: </span>Lorem ipsum dolor sit amet,
                        consecter.</p>
                    <p class="card-text text-danger d-flex justify-content-end">2 499.99 ₽</p>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <a href="good.html" class="btn btn-primary fs-3">More about</a>
            </div>
        </article>
        <article class="card my-3">
            <div class="card-title bg-secondary bg-gradient p-3 text-light d-flex justify-content-between">
                <h3>Good name</h3>
                <a href="" title="Delete good" class="btn-danger py-1 px-2 justify-content-center text-decoration-none fs-4">&#x2620;</a>
            </div>
            <div class="card-body d-flex justify-content-between">
                <div class="card-img">
                    <img src="/courseadmin/img/default.jpg" alt="Название товара">
                </div>
                <div class="card-info">
                    <p class="card-text text-black-50"><span class="text-dark">About: </span>Lorem ipsum dolor sit amet,
                        consecter.</p>
                    <p class="card-text text-danger d-flex justify-content-end">3 599.99 ₽</p>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <a href="good.html" class="btn btn-primary fs-3">More about</a>
            </div>
        </article>
        <article class="card my-3">
            <div class="card-title bg-secondary bg-gradient p-3 text-light d-flex justify-content-between">
                <h3>Good name</h3>
                <a href="" title="Delete good" class="btn-danger py-1 px-2 justify-content-center text-decoration-none fs-4">&#x2620;</a>
            </div>
            <div class="card-body d-flex justify-content-between">
                <div class="card-img">
                    <img src="/courseadmin/img/default.jpg" alt="Название товара">
                </div>
                <div class="card-info">
                    <p class="card-text text-black-50"><span class="text-dark">About: </span>Lorem ipsum dolor sit amet,
                        consecter.</p>
                    <p class="card-text text-danger d-flex justify-content-end">6 499.99 ₽</p>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <a href="good.html" class="btn btn-primary fs-3">More about</a>
            </div>
        </article>
    </section>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>