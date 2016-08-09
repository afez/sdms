<?php

class StaffController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
//public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'liststaff', 'sendsms', 'report', 'notifyreport'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Staff;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);
        if (isset($_POST['Staff'])) {
            $model->attributes = $_POST['Staff'];
            $model->imagepath = CUploadedFile::getInstance($model, 'imagepath');
            if ($model->imagepath != FALSE) {
                $model->upload();
            }
            if ($model->validate()) {
                $user = new User();
                $user->username = $_POST['Staff']['username'];
                $user->password = md5('12345');
                $user->role_id = 2;
                $user->save();

                $model->user_id = $user->id;
                $model->save();

                $this->redirect(array('index', 'id' => $model->id));
            }
        }


        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['Staff'])) {
            //$model = new Staff;
            $model->attributes = $_POST['Staff'];
            $imagepath = CUploadedFile::getInstance($model, 'imagepath');
            if ($imagepath != FALSE) {
                $model->imagepath = $imagepath;
                $model->upload();
            }
            if ($model->validate()) {
                $model->save();
                $this->redirect(array('index', 'id' => $model->id));
            } else {
                var_dump($model->errors);
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $criteria = new CDbCriteria();

        if (isset($_GET['q'])) {
            $q = $_GET['q'];
            $criteria->compare('first_name', $q, true, 'OR');
            $criteria->compare('last_name', $q, true, 'OR');
            $criteria->compare('title', $q, true, 'OR');
            $criteria->compare('college_id', $q, true, 'OR');
            $criteria->compare('department_id', $q, true, 'OR');
        }

        $dataProvider = new CActiveDataProvider
                ("Staff", array('criteria' => $criteria));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionListstaff() {
        $cr = new CDbCriteria;
        $cr->order = 'department_id asc';
        $models = Staff::model()->findAll($cr);
        $this->render('liststaff', array(
            'models' => $models,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Staff('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Staff']))
            $model->attributes = $_GET['Staff'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionReport() {
        $model = new AReport;
        if (isset($_POST['AReport'])) {
            $model->attributes = $_POST['AReport'];
            if ($model->validate()) {
                $out = $model->output;

                $user = Staff::model()->findAll();
                $u = new ArrayModelReporter($user, array(
                    'title',
                    'first_name',
                    'last_name',
                    array(
                        'name' => 'DOB',
                        'header' => 'Date of Birth',
                    ),
                    array(
                        'name' => 'college.name',
                        'header' => 'College',
                    ),
                    array(
                        'name' => 'department.name',
                        'header' => 'Department',
                    ),
                    'phone',
                    'email',
                    array(
                        'name' => 'status',
                        'header' => 'work Status',
                    ),
                ));
                $u->generate([
                    'title' => 'UDSM Academic Staff',
                    'header' => 'UDSM Academic Staff Report|',
                    'footer' => "Copyright © Academic Staff " . date('d/m/Y') . " |{PAGENO}|"
                        ], $out);
            }
        }
        $this->render('report', ['model' => $model]);
    }

    public function actionNotifyreport() {
        $model = new AReport;
        if (isset($_POST['AReport'])) {
            $model->attributes = $_POST['AReport'];
            if ($model->validate()) {
                $out = $model->output;

                $user = Notification::model()->findAll();
                $u = new ArrayModelReporter($user);
                $u->generate([
                    'title' => 'Academic Staff Overstayed',
                    'header' => 'UDSM Academic Staff Overstayed Report|',
                    'footer' => "Copyright © Academic Staff " . date('d/m/Y') . " |{PAGENO}|"
                        ], $out);
            }
        }
        $this->render('notifyreport', ['model' => $model]);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Staff the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Staff::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Staff $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'staff-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public static function actionSendSMS() {

        $ov = Notification::getOverstay();
        foreach ($ov as $v) {
            $no = $v->phone;
            $send = '{  
  "from":"UdStaff",
  "to":"' . $no . '",
  "text":"Hello! Please register for further studies according to policies and principles of Academic staff development UDSM"
}';
        }
        $url = 'api.infobip.com/sms/1/text/single';



        $sms = curl_init($url);
        curl_setopt($sms, CURLOPT_POST, 1);
        curl_setopt($sms, CURLOPT_POSTFIELDS, $send);
        curl_setopt($sms, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($sms, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic U0RNQWRtaW46JERldnAxNkA=',
            'Content-Type: application/json',
            'accept: application/json',
        ));
        curl_setopt($sms, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($sms);
        echo $response;
    }

}
