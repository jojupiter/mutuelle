<?php

/* @var $this View */
/* @var $content string */

use yii\helpers\Html;
use yii\web\View;
?>
<!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-ligth-warning sidebar-light-warning">
    <!-- Brand Logo -->
    <a href="https://polytechnique.cm" class="brand-link">
      <img src="<?= $baseUrl ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Teachers Mutual</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
    <!--  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= $baseUrl ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>-->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open" id="nav1" onclick="change(1)">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Activities
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <?= Html::a('<i class="fa fa-book nav-icon"></i>
                                            <p>Exercises</p>', ['exercise/index'], ['class' => 'nav-link']) ?>
              </li>
              <li class="nav-item">
                  <?= Html::a('<i class="fa fa-bookmark nav-icon"></i>
                                            <p>Sessions</p>', ['session/index'], ['class' => 'nav-link']) ?>
              </li>
              <li class="nav-item">
                <?= Html::a('<i class="fa fa-cog nav-icon"></i>
                                            <p>Settings</p>', ['setting/index'], ['class' => 'nav-link']) ?>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-open" id="nav2" onclick="change(2)">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Members
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <?= Html::a('<i class="fa fa-paypal nav-icon"></i>
                                            <p>Registrations</p>', ['member/index'], ['class' => 'nav-link']) ?>
              </li>
              <li class="nav-item">
                  <?= Html::a('<i class="fa fa-user nav-icon"></i>
                                            <p>Profiles</p>', ['user/index'], ['class' => 'nav-link']) ?>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-open" id="nav3" onclick="change(3)">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-bank"></i>
              <p>
                Treasury
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <?= Html::a('<i class="fa fa-envelope nav-icon"></i>
                                            <p>Savings</p>', ['saving/index'], ['class' => 'nav-link']) ?>
              </li>
              <li class="nav-item">
                  <?= Html::a('<i class="fa fa-credit-card nav-icon"></i>
                                            <p>Loans</p>', ['loan/index'], ['class' => 'nav-link']) ?>
              </li>
              <li class="nav-item">
                <?= Html::a('<i class="fa fa-money nav-icon"></i>
                                            <p>Repayments</p>', ['repayment/index'], ['class' => 'nav-link']) ?>
              </li>
              <li class="nav-item">
                <?= Html::a('<i class="fa fa-history nav-icon"></i>
                                            <p>Social Contributions</p>', ['socialbackground/index'], ['class' => 'nav-link']) ?>
              </li>
              <li class="nav-item">
                <?= Html::a('<i class="fa fa-check nav-icon"></i>
                                            <p>Helps</p>', ['help/index'], ['class' => 'nav-link']) ?>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>