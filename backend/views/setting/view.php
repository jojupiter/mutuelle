<?php

use common\models\Setting;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Setting */

$this->title = $model->id_exercise;
$this->params['breadcrumbs'][] = ['label' => 'Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_exercise], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_exercise], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_exercise',
            'registration_fees',
            'interest_rate',
            'amount_sb_om',
            'amount_sb_nm',
            'delays_sb',
            'parent_death',
            'parent_in_law_death',
            'member_death',
            'partner_death',
            'childreen_death',
            'birth',
            'wedding',
            'other_happy_events',
            'other_unfortunate_events',
        ],
    ]) ?>

</div>
