<?php

// uncomment the following to define a path alias
Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
//require_once( dirname(_FILE_).'/../components/global.php');
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'UDSM Academic Staff MS',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        /** import for College module */
        'application.modules.college.models.forms.*',
        'application.modules.college.models.*',
        'application.modules.college.components.*',
        /** import for Department module */
        'application.modules.department.models.forms.*',
        'application.modules.department.models.*',
        'application.modules.department.components.*',
        /** import for staff module */
        'application.modules.staff.models.forms.*',
        'application.modules.staff.models.*',
        'application.modules.staff.components.*',
        /** import for position module */
        'application.modules.position.models.forms.*',
        'application.modules.position.models.*',
        'application.modules.position.components.*',
        /** import for publication module */
        'application.modules.publication.models.forms.*',
        'application.modules.publication.models.*',
        'application.modules.publication.components.*',
        
         /** import for progress report module */
        'application.modules.progreport.models.forms.*',
        'application.modules.progreport.models.*',
        'application.modules.progreport.components.*',
        
         /** import for assesment module */
        'application.modules.Assescriteria.models.forms.*',
        'application.modules.Assescriteria.models.*',
        'application.modules.Assescriteria.components.*',
        
         /** import for report module */
        'application.modules.report.models.forms.*',
        'application.modules.report.models.*',
        'application.modules.report.components.*',
        
        /** import for studylevel module */
        'application.modules.study.models.forms.*',
        'application.modules.study.models.*',
        'application.modules.study.components.*',
        
         /** import for comment module */
        'application.modules.comment .models.forms.*',
        'application.modules.comment .models.*',
        'application.modules.comment .components.*',
        'application.vendors.mpdf.*',
        'application.extensions.PHPExcel.*',
    ),
    'modules' => array(
//		 uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '12345',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        'college' => array(
        ),
        'department' => array(
        ),
        'staff' => array(),
        'position' => array(),
        'publication'=>array(),
        'progreport'=>array(),
        'Assescriteria'=>array(),
        'report'=>array(),
        'comment'=>array(),
        'study'=>array(),
    ),
    // application components
    'components' => array(
        'clientScript' => array(
            'packages' => array(
                'jquery' => array(
                    'baseUrl' => 'js',
                    'js' => array('jquery-2.1.3.min.js'),
                    'coreScriptPosition' => CClientScript::POS_END
                ),
            ),
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'loginUrl' => array('site/login'),
        ),
        'authManager' => array(
            'class' => 'CDbAuthManager',
            'connectionID' => 'db',
            'itemTable' => 'authItems',
            'assignmentTable' => 'authAssignments',
            'itemChildTable' => 'authItemChilds',
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
//		'db'=>array(
//			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
//		),
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=astaff',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'MACHUNGI',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'bootstrap' => array(
            'class' => 'bootstrap.components.Bootstrap',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
        
                
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        
    ),
);
