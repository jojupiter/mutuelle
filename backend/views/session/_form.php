<?php

use common\models\Session;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this View */
/* @var $model Session */
/* @var $form ActiveForm */
?>

<div class="session-form">
    <div class="card card-info" style="width: 50%; margin: 0 auto;">
        <div class="card-header">
            <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php $form = ActiveForm::begin(); ?>
        <div class="card-body" style="margin: 0 auto; width: 50%">
            <div class="form-group" style="margin: 0 auto;">
                <label>Date</label>
                <!-- /.form group -->
                <div class="input-group" style="width: 100%;">
                <!-- phone mask -->
                    <?= $form->field($model, 'date_')->textInput([
                        'type' => 'date',
                    ])->label(false); ?>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Cancel', ['session/index'], ['class' => 'btn btn-default float-right']) ?>
        </div>
        <!-- /.card-footer -->
        <?php ActiveForm::end(); ?>
    </div>
