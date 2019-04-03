<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Repayment */

$this->title = 'Create Repayment';
$this->params['breadcrumbs'][] = ['label' => 'Repayments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repayment-create">
    <?= $this->render('_form', [
        'model' => $model,'idl' =>$idl,
    ]) ?>

</div>
