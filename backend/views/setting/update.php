<?php

use common\models\Exercise;
use common\models\Setting;
use yii\web\View;

/* @var $this View */
/* @var $model Setting */
$month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
$exercise = Exercise::findOne(['id'=>$model->id_exercise]);
$this->title = 'Update Setting : '.$month[$exercise->month].' '.$exercise->year;
$this->params['breadcrumbs'][] = ['label' => 'Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $month[$exercise->month].' '.$exercise->year, 'url' => ['index', 'id' => $model->id_exercise, 'from' => 1]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="setting-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
