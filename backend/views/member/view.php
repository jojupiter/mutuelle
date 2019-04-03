<?php

use backend\assets\AppAsset;
use common\models\Member;
use common\models\User;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Member */

$asset = AppAsset::register($this);
$baseUrl = $asset->baseUrl;
$this->title = $model->firstname.' '.$model->lastname;
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$path = $baseUrl.'/dist/img/user1-128x128.jpg';
if($model->photo != null) $path = "uploads/".$model->photo;
?>
<?php $user = User::findOne(['id'=>Yii::$app->user->id]); ?>
<div class="member-view">
<div class="card" style="margin: 0 auto;width: 96%;">
            <div class="card-header">
              <h3 class="card-title">Member Informations</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="col-md-4" style="margin: 0 auto;">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info-active">
                <h3 class="widget-user-username"><?= $model->firstname.' '.$model->lastname ?></h3>
              </div>
              <div class="widget-user-image">
                  <img class="img-circle elevation-2" src="<?= $path; ?>" alt="User Avatar" style="position: relative;
    float: left;
    width:  100px;
    height: 100px;
    background-position: 50% 50%;
    background-repeat:   no-repeat;
    background-size:     cover;"/>
              </div>
              <div class="card-footer">
                    <div class="description-block">
                      <h5 class="description-header"><?= $model->matricule ?></h5>
                    </div>
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
            <div style="width: 70%; margin: 0 auto;"> 
                <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'email:email',
            'phone',
            'pobox',
            'residence',
        ],
    ]) ?>
                </div> 
                 
                   <!-- /.card-body -->
     <div class="card-footer">
      <p>
          <?php if($user->type == 1 || ($user->type == 0 && $user->id == $model->matricule)): ?>
       <?= Html::a('Update', ['update', 'id' => $model->matricule], ['class' => 'btn btn-primary']) ?>
          <?php endif; ?>
        <?php if($user->type == 1): ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->matricule], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
          <?php endif; ?>
    </p>
    </div>
    </div>
</div>
