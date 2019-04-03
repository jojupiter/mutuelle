<?php

/* @var $this View */
/* @var $content string */

use frontend\assets\AppAsset;
use yii\web\View;

AppAsset::register($this);
$asset = AppAsset::register($this);
$baseUrl = $asset->baseUrl;

?>
<!-- Footer area-->
        <div class="footer-area">
            <div class="footer-copy text-center">
                <div class="container">
                    <div class="row">
                        <div class="pull-left">
                            <span> (C) <a href="http://www.polytechnique.cm">My Application</a> , All rights reserved 2018 - <?= date('Y') ?></span> 
                        </div> 
                    </div>
                </div>
            </div>

        </div>
