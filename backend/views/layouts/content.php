<?php

/* @var $this View */
/* @var $content string */

use yii\web\View;
use yii\widgets\Breadcrumbs;

?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style ="background-color: white;">
    <!-- Content Header (Page header) -->
    <section class="content" style="margin: 20px;">
      <?= Breadcrumbs::widget([
            'itemTemplate' => "<li style='marging = 40px;'>{link}&nbsp;\&nbsp;</li>\n",
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </section>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content" id='myStyle' style="margin: 0 auto">
      <?= $content ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->