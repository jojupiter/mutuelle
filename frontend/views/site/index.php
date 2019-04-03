<?php

use common\models\Member;
use yii\db\Query;
use yii\web\View;
/* @var $this View */

$this->title = 'Home';
$admins = (new Query())->from('user')->where(['type'=>'1'])->limit(3);
?>
<div class="site-index">
    <div class="slider-area" style="vertical-align: middle;text-align: center;">
        <div class="slider" style="width:80%;margin: 0 auto;">
            <br>
            <div id="bg-slider" class="owl-carousel owl-theme">
                <div class="item"><img style="border:0;" src="slider1.jpg"></div>
                <div class="item"><img style="border:0;" src="slider7.jpg"></div>
                <div class="item"><img style="border:0;" src="slider3.jpg"></div>

            </div>
        </div>
        <div class="slider-content" style="vertical-align: middle;text-align: center;">
            <h2><br><br><br><br><b>Welcome to the Mutual</b></h2>
        </div>
    </div>

    <!--TESTIMONIALS -->
    <div class="testimonial-area recent-property" style="background-color: #FCFCFC; padding-bottom: 15px;">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12 text-center page-title">
                    <!-- /.feature title -->
                    <h2>Our Administrators</h2> 
                </div>
            </div>

            <div class="row">
                <div class="row testimonial">
                    <div class="col-md-12">
                        <div id="testimonial-slider">
                            <?php if($admins != []): ?>
                            <?php foreach ($admins->each() as $admin): ?>
                             <?php $member = Member::findOne($admin['id']); ?>
                            <div class="item">
                                <div class="client-text">                                
                                    <p>Lecturer at the National Advanced School of Engineering</p>
                                    <h4><strong><?= $member['firstname'].' '.$member['lastname'] ?>, </strong><i>Administrator</i></h4>
                                </div>
                                <div class="client-face wow fadeInRight" data-wow-delay=".9s"> 
                                    <img src="<?php echo Yii ::getAlias('@imageurl'); ?>/uploads/<?= $member['photo']?>" alt="" style="position: relative;
    float: left;
    width:  100px;
    height: 100px;
    background-position: 50% 50%;
    background-repeat:   no-repeat;
    background-size:     cover;">
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Count area -->
    <div class="count-area">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12 text-center page-title">
                    <!-- /.feature title -->
                    <h2>You can trust Us </h2> 
                </div>
            </div>
            <br>
        </div>
    </div>
