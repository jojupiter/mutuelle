<?php

use common\models\Exercise;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Exercise */
/* @var $form ActiveForm */
?>

<div class="exercise-form">

    <div class="card card-info" style="width: 50%; margin: 0 auto;">
        <div class="card-header">
            <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php
        $form = ActiveForm::begin([
                    'class' => 'form-horizontal'
        ]);
        ?>
        <div class="card-body">
            <div class="form-group">
                <?= $form->field($model, 'year')->textInput() ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'month')->dropDownList(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'duration')->dropDownList(['1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10, '11' => 11, '12' => 12]) ?>
            </div>
            <div class="form-group">
<?= $form->field($model, 'session_frequency')->dropDownList(['1' => 1, '2' => 2, '3' => 3]) ?>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['exercise/index'], ['class' => 'btn btn-default float-right']) ?>
        </div>
        <!-- /.card-footer -->
<?php ActiveForm::end(); ?>
    </div>

</div>
