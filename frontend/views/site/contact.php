<?php

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model app\models\ContactForm */

use yii\bootstrap\ActiveForm;
use yii\web\View;

$this->title = 'Contact';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-contact">
   <!-- property area -->
        <div class="content-area recent-property padding-top-40" style="background-color: #FFF;">
            <div class="container">  
                <div class="row">
                    <div class="col-md-8 col-md-offset-2"> 
                        <div class="" id="contact1">                        
                            <div class="row">
                                <div class="col-sm-4">
                                    <h3><i class="fa fa-map-marker"></i> Address</h3>
                                    <p>Rue Melen
                                        <br>Yaoundé 
                                        <br>
                                        <strong>Cameroon</strong>
                                    </p>
                                </div>
                                <!-- /.col-sm-4 -->
                                <div class="col-sm-4">
                                    <h3><i class="fa fa-phone"></i> Call center</h3>
                                    <p class="text-muted">This number is not reachable at any time otherwise we advise you to use the electronic
                                        form of communication.</p>
                                    <p><strong>+237 222 224 547</strong></p>
                                </div>
                                <!-- /.col-sm-4 -->
                                <div class="col-sm-4">
                                    <h3><i class="fa fa-envelope"></i> Electronic support</h3>
                                    <p class="text-muted">Please feel free to write an email to us.</p>
                                    <ul>
                                        <li><strong><a href="mailto:">gi@polytechnique.com</a></strong>   </li>
                                    </ul>
                                </div>
                                <!-- /.col-sm-4 -->
                            </div>
                            <!-- /.row -->
                            <hr>
                            <div id="map"></div>
                            <hr>
                  
                        </div>
                    </div>    
                </div>
            </div>
        </div>
</div>

