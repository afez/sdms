<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('YII_DEBUG') or define('YII_DEBUG', true);
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/cron.php';
// including Yii
require_once($yii);

// creating and running console application
Yii::createConsoleApplication($config)->run();
