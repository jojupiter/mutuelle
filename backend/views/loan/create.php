<?php

use common\models\Loan;
use yii\web\View;


/* @var $this View */
/* @var $model Loan */

$this->title = 'Create Loan';
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
