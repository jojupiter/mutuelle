<?php

/* @var $this View */
/* @var $content string */

use common\models\User;
use frontend\assets\AppAsset;
use yii\web\View;

AppAsset::register($this);
$asset = AppAsset::register($this);
$baseUrl = $asset->baseUrl;

?>
 <!-- Body content -->
        <div class="header-connect">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-8  col-xs-12">
                        <div class="header-half header-call">
                            <p>
                                <span><i class="pe-7s-call"></i>+237 222 224 547</span>
                                <span><i class="pe-7s-mail"></i>gi@polytechnique.com</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2 col-md-offset-5  col-sm-3 col-sm-offset-1  col-xs-12">
                        <div class="header-half header-social">
                            <ul class="list-inline">
                                <li><a href="https://web.facebook.com/ENSPY"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://twitter.com/enspyaounde"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.rescif.net/"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
        <!--End top header -->

        <nav class="navbar navbar-default ">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="http://www.polytechnique.cm"><img src="logo.png" width="50" height="50"/></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse yamm" id="navigation">
                    <div class="button navbar-right">
                        <?php if(Yii::$app->user->isGuest): ?>
                        <button class="navbar-btn nav-button wow bounceInRight login" onclick=" window.open('index.php?r=site/login', '_SELF')" data-wow-delay="0.45s">Login</button>
                        <button class="navbar-btn nav-button wow fadeInRight" onclick=" window.open('index.php?r=site/signup', '_SELF')" data-wow-delay="0.48s">Sign Up</button>
                         <?php else: ?>
                        <button class="navbar-btn nav-button wow bounceInRight login" onclick=" window.open('index.php?r=site/logout', '_SELF')" data-wow-delay="0.48s">Logout</button>
                        <?php $user = User::findOne(['id'=>Yii::$app->user->id]); ?>
                        <button class="navbar-btn nav-button wow fadeInRight" onclick=" window.open('/advanced/backend/web/index.php?r=site/login&id=<?= $user['id'] ?>', '_SELF')" data-wow-delay="0.48s">Member Space</button>                        
                         <?php endif; ?>
                    </div>
                    <ul class="main-nav nav navbar-nav navbar-right">
                        <li class="wow fadeInDown" data-wow-delay="0.2s"><a class="" href="index.php?r=site/index">Home</a></li>
                        <li class="wow fadeInDown" data-wow-delay="0.3s"><a class="" href="index.php?r=site/about">About</a></li>
                        <li class="wow fadeInDown" data-wow-delay="0.5s"><a href="index.php?r=site/contact">Contact</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <!-- End of nav bar -->
