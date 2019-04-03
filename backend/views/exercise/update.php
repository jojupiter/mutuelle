<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Exercise */

$month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
$this->title = 'Update Exercise : '.$month[$model->month].' '.$model->year;
$this->params['breadcrumbs'][] = ['label' => 'Exercises', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $month[$model->month].' '.$model->year, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="exercise-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
