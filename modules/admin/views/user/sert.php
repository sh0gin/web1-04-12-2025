<?php
\app\assets\SertAsset::register($this);
?>
<div class="sertificate">
        <button class="print-button" onclick="window.print()">Print</button>
        <div class="content">
            <div class="recipient-name"><?=$user->name?> </div> <!-- Username here -->
            <p>has successfully completed the course</p>
            <h2><?=$course->name?></h2>
            <p>Certificate code: <?=$newId?></p> <!-- Enter certificate generating code here -->
            <div class="details">
                <p>Course duration: <?=$course->hours?> academic hours</p> <!-- course duration time here -->
                <p>Completion date: <?=$course->start_date?> </p> <!-- enter recoding date here -->
            </div>

            <div class="signatures">
                <div class="signature-block">
                    <p>Director of Education Center</p>
                    <p>_________________________</p>
                    <p>John Smith</p>
                </div>

                <div class="signature-block">
                    <p>Program Manager</p>
                    <p>_________________________</p>
                    <p>Emily Johnson</p>
                </div>
            </div>
        </div>
    </div>
<?=\yii\bootstrap5\Html::a('back to student', ['/course-admin/courses'],['class'=>"back-button"])?>
