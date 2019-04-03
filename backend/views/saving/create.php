<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Saving */

$this->title = 'Create Saving';
$this->params['breadcrumbs'][] = ['label' => 'Savings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="saving-create" style="margin: 0 auto;">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
