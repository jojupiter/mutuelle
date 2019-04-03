<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Exercise */

$this->title = 'Create Exercise';
$this->params['breadcrumbs'][] = ['label' => 'Exercises', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exercise-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
