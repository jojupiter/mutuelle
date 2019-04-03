<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Setting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-form">

    <div class="card card-info" style="width: 96%; margin: 0 auto;">
        <div class="card-header">
            <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php $form = ActiveForm::begin(); ?>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $form->field($model, 'registration_fees')->textInput() ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'interest_rate')->dropDownList(['0.01' => 1, '0.02' => 2, '0.03' => 3, '0.04' => 4, '0/05' => 5, '0.06' => 6, '0.07' => 7, '0.08' => 8, '0.09' => 9, '0.1' => 10])->label("Interest Rate (in percent)") ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'amount_sb_om')->textInput()->label("Amount Social Bacground Old Members") ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'amount_sb_nm')->textInput()->label("Amount Social Bacground New Members") ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'delays_sb')->textInput()->label("Social Background Payment Delay (in month)") ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'birth')->textInput() ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'wedding')->textInput() ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'other_happy_events')->textInput() ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $form->field($model, 'parent_death')->textInput() ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'parent_in_law_death')->textInput() ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'member_death')->textInput() ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'partner_death')->textInput() ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'partner_death')->textInput() ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'childreen_death')->textInput() ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'other_unfortunate_events')->textInput() ?>
                    </div>
                    <br>
                    <div class="card-footer" style="padding-top: 10px">
                                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Cancel', ['setting/index'], ['class' => 'btn btn-default float-right']) ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <?php ActiveForm::end(); ?>

    </div>
