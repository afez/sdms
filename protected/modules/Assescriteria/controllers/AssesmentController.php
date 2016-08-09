<?php

class AssesmentController extends Controller {
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

    public function actionSummary($id = FALSE) {
        if ($id == FALSE) {
            $id = User::loggedUser()->id;
        }
        $model = Assesment::model()->with('publication')->findAll("staff_id=$id");
    
        var_dump($model);
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
                // 'actions' => array('create', 'update', 'result'),
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
        $model = new Assesment;
        $pb = Publication::model()->findByPk($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Assesment'])) {
            $model->attributes = $_POST['Assesment'];

            $cov = $model->coverag;
            $org = $model->originality;
            $co = $model->Contribut;
            $ac = $model->academic_discipline;
            $sp = $model->specialize;
            $pr = $model->presentation;
            $ov = $model->overall_quality;


            $avg = ($cov + $org + $co + $ac + $sp + $pr + $ov) / 7;


            if (($avg > 70) AND ( $avg < 100)) {
                $model->grade = "A";
                $model->point = 1.5;
            } elseif (($avg > 60) AND ( $avg < 71)) {
                $model->grade = "B+";
                $model->point = 1.0;
            } elseif (($avg > 30) AND ( $avg < 61)) {
                $model->grade = "B";
                $model->point = 1.0;
            } else {
                $model->grade = "D";
                $model->point = 0.0;
            }

            $model->average = $avg;
            $model->publication_id = $id;


            if ($model->save())
                $this->redirect(array('index', 'id' => $id));
        }

        $this->render('create', array(
            'model' => $model, 'id' => $id
        ));
    }

    public function actionPrintresult() {
        $model = new AReport;
        if (isset($_POST['AReport'])) {
            $model->attributes = $_POST['AReport'];
            if ($model->validate()) {
                $out = $model->output;

                $result = Assesment::model()->findAll();
                $u = new ArrayModelReporter($result, array(
                    array(
                        'name' => 'publication.staff.first_name',
                        'header' => 'Authour',
                    ),
                    array(
                        'name' => 'publication.type',
                        'header' => 'Publication Type',
                    ),
                    array(
                        'name' => 'reviewer.staff.first_name',
                        'header' => 'Reviewer',
                    ),
                    'average',
                    'grade',
                    'point',
                ));
                $u->generate([
                    'title' => 'Results',
                    'header' => 'Publication Result|',
                    'footer' => "Copyright © Academic Staff " . date('d/m/Y') . " |{PAGENO}|"
                        ], $out);
            }
        }
        $this->render('printresult', ['model' => $model]);
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

        if (isset($_POST['Assesment'])) {
            $model->attributes = $_POST['Assesment'];
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
    public function actionResult() {

        $model = Assesment::model()->findAll();

        $this->render('result', array(
            'model' => $model,
        ));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Assesment');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionassess($id) {
        $dataProvider = new CActiveDataProvider('Assesment');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'id' => $id));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Assesment('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Assesment']))
            $model->attributes = $_GET['Assesment'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Assesment the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Assesment::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Assesment $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'assesment-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
