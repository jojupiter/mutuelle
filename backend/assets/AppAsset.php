<?php

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{ 
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    //public $sourcePath = '@bower/backend/';
    public $css = [
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
        'css/select2.min.css',
        'css/font-awesome.min.css',
        'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
        //'css/adminlte.css',
        'css/adminlte.min.css',
        'css/blue.css',
       // 'css/dataTables.bootstrap4.min.css',
        'css/bootstrap.css',
        'css/bootstrap3-wysihtml5.min.css',
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700',
        'css/bootstrap-toggle.css',
        'css/stylesheet.css',
        
        'css/jquery.dataTables.min.css',
        'css/buttons.dataTables.min.css',
    ];
    public $js = [
        'js/jquery.min.js',
        'js/bootstrap.bundle.min.js',
        'js/jquery.sparkline.min.js',
        'js/jquery.knob.js',
        'js/bootstrap3-wysihtml5.all.min.js',
        'js/jquery.slimscroll.min.js',
        'js/fastclick.js',
        'js/adminlte.js',
        'js/dashboard.js',
        'js/demo.js',
        //'js/jquery.dataTables.js',
        //'js/dataTables.bootstrap4.js',
        'js/adminlte.min.js',
        'js/select2.full.min.js',
        'js/jquery.inputmask.js',
        'js/jquery.inputmask.date.extensions.js',
        'js/jquery.inputmask.extensions.js',
        'js/icheck.min.js',
        'js/bootstrap-toggle.js',

        //'js/jquery-3.3.1.js',
        'js/jquery.dataTables.min.js',
        'js/dataTables.buttons.min.js',
        'js/jszip.min.js',
        'js/pdfmake.min.js',
        'js/vfs_fonts.js',
        'js/buttons.html5.min.js',
        
    ];
    
    public $jsOptions = ['position' => View::POS_END];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
