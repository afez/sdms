<?php

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Cron',
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
        'college' => array(
        ),
        'department' => array(
        ),
        'staff' => array(),
        'position' => array(),
        'publication' => array(),
        'progreport' => array(),
        'Assescriteria' => array(),
        'report' => array(),
        'comment' => array(),
        'study' => array(),
    ),
    // application components
    'components' => array(
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
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=astaff',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
);
