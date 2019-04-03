<!-- Navbar -->
  <nav class="main-header navbar navbar-expand border-bottom navbar-light bg-warning">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>
    
    <!-- Right navbar links -->
<?php

/* @var $this View */
/* @var $content string */

use backend\assets\AppAsset;
use common\models\User;
use yii\helpers\Html;
use yii\web\View;

AppAsset::register($this);
?>
    <?php $user = User::findOne(['id'=>Yii::$app->user->id]); ?>
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
       
      <li class="nav-item dropdown">
          <?= Html::a("<i class='fa fa-user'></i> Logout(".$user['username'].")", ['site/logout'], ['class' => 'nav-link',
            'data' => [
                'confirm' => 'Are you sure you want to leave ?',
                'method' => 'post',
            ],
        ]) ?>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->