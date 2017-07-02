<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
	    'css/jquery.jqprint-0.3.js',
		//'css/jquery-1.4.4.min.js',
		'css/jquery-migrate-1.2.1.min.js',
		'css/print/jQuery.print.js',	
    ];
	public $jsOptions = [
	    'position'=>\yii\web\View::POS_HEAD
	];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
