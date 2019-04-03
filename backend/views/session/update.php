<?php

use common\models\Session;
use yii\web\View;

/* @var $this View */
/* @var $model Session */

$this->title = 'Update Session : '.date('d F, Y (l)', strtotime($model->date_));
$this->params['breadcrumbs'][] = ['label' => 'Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => date('d F, Y (l)', strtotime($model->date_)), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="session-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
