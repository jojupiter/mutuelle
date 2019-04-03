<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Registration */

$this->title = 'Update Registration: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Registrations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->matricule_member, 'url' => ['view', 'id' => $model->matricule_member]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="registration-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
