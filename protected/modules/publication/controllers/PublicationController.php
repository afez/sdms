<?php

class PublicationController extends Controller {
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
                'actions' => array('create', 'list', 'update', 'index1', 'pubreport', 'assign','assigned'),
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
    public function actionCreate($id) {
        $model = new Publication;
        $model->staff_id = $id;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Publication'])) {
            $model->attributes = $_POST['Publication'];

            $model->docupload = CUploadedFile::getInstance($model, 'docupload');
            if ($model->docupload != FALSE) {
                $model->upload();
            }
            if ($model->validate()) {
                $model->save();
                $this->redirect(array('list', "id" => $id));
            }
        }

        $this->render('create', array(
            'model' => $model, "id" => $id
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

        if (isset($_POST['Publication'])) {
            $model->attributes = $_POST['Publication'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
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
        $models = Publication::model()->findAll();
        $this->render('index', array(
            'models' => $models,
        ));
    }

    public function actionList($id) {
        $model = Publication::model()->findAll("staff_id=$id");
        $this->render('list', array(
            'model' => $model, "id" => $id
        ));
    }

    public function actionIndex1() {
        $this->render('index1');
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Publication('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Publication']))
            $model->attributes = $_GET['Publication'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionAssign($rid, $pid) {
        $model = Reviewer::model()->find("publication_id=$pid and staff_id=$rid");
        if ($model != FALSE) {
            $this->flashError("The reviwer was already assigned");

            $pub = Publication::model()->findByPk($pid);
            $sid = $pub->staff_id;
            $this->redirect($this->createUrl("/publication/publication/list", ['id' => $sid]));
        }
        $model = new Reviewer;
        $model->publication_id = $pid;
        $model->staff_id = $rid;
        if ($model->save()) {
            $pub = Publication::model()->findByPk($pid);
            $sid = $pub->staff_id;
            $this->flashSuccess('Assigned succefully');
            $this->redirect($this->createUrl("/publication/publication/list", ['id' => $sid]));
        }
    }

    public function actionAssigned() {
       $uid= Yii::app()->user->user_id;
        $model = Reviewer::model()->findAll("staff_id=$uid");

        $this->render('assigned', array(
            'model'=>$model,
        ));
    }

    public function actionPubreport() {
        $model = new AReport;
        if (isset($_POST['AReport'])) {
            $model->attributes = $_POST['AReport'];
            if ($model->validate()) {
                $out = $model->output;

                $user = Publication::model()->findAll();
                $u = new ArrayModelReporter($user);
                $u->generate([
                    'title' => 'Publication',
                    'header' => 'Publication Report|',
                    'footer' => "Copyright © Academic Staff " . date('d/m/Y') . " |{PAGENO}|"
                        ], $out);
            }
        }
        $this->render('pubreport', ['model' => $model]);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Publication the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Publication::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Publication $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'publication-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
