<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

\app\assets\SertAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>

    <title>Online school</title>

    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">

<?php $this->beginBody() ?>

<div class="background-image">
    <img src="/web/img/ser_bg.png" alt="Certificate Background">
</div>
<div class="sertificate">
    <button class="print-button" onclick="window.print()">Print</button>
    <div class="content">
        <?= $content ?>
    </div>
</div>
<?php $this->endBody() ?>
</body>

</html>

<?php $this->endPage() ?>


