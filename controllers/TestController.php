<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/28
 * Time: 22:35
 */
namespace app\controllers;
use yii\rest\ActiveController;

class TestController extends ActiveController
{
    public $modelClass = 'app\models\User';
}


?>