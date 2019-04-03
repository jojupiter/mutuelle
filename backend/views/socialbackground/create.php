<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Socialbackground */

$this->title = 'Create Socialbackground';
$this->params['breadcrumbs'][] = ['label' => 'Socialbackgrounds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="socialbackground-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
