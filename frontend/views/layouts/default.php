<?php
/* @var $this View */
/* @var $content string */

use frontend\assets\HomeAsset;
use yii\helpers\Html;
use yii\web\View;

HomeAsset::register($this);
$asset = HomeAsset::register($this);
$baseUrl = $asset->baseUrl;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= Html::encode($this->title) ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $this->head(); ?>
    </head>
    <body class="hold-transition login-page">
        <?php $this->beginBody() ?>
            <?= $content ?>
            <?= $this->registerJs("
$(document).ready(function() {
        $('.control-label').append('<span>&nbsp;*&nbsp;</span>');
        $('span').css({'color':'red'});
                $('input').select({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
  });") ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
