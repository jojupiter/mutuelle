<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Repayment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repayment-form">
<div class="card card-info" style="width: 50%; margin: 0 auto;">
        <div class="card-header">
            <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
    <?php $form = ActiveForm::begin(); ?>
    <div class="card-body">
        <div class="form-group">
                <?= $form->field($model, 'amount')->textInput() ?>
            </div>
        </div>
        <!-- /.card-body -->
         <div class="card-footer">
            <?= Html::submitButton('Save',['class' => 'btn btn-success'],['create', 'idl' =>$idl]) ?>
            <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-default float-right']) ?>
        </div>
        <!-- /.card-footer -->
    <?php ActiveForm::end(); ?>

</div>