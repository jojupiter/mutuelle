<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Member */

$this->title = 'Update Member : '.$model->firstname.' '.$model->lastname;
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->firstname.' '.$model->lastname, 'url' => ['view', 'id' => $model->matricule]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="member-update">
    <?= $this->render('_form', [
        'model' => $model,'picture'=>$picture,
    ]) ?>

</div>
