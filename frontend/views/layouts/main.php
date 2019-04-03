<?php

/* @var $this View */
/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\web\View;

AppAsset::register($this);
$asset = AppAsset::register($this);
$baseUrl = $asset->baseUrl;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div id="preloader">
            <div id="status">&nbsp;</div>
    </div>
    <?= $this->render('header.php',['baseUrl' => $baseUrl]) ?>
        <?= $content ?>
     <?= $this->render('footer.php',['baseUrl' => $baseUrl]) ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
