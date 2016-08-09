<?php

class EventController extends SecureController {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
//            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    function init() {
        parent::init();
        $this->leftPortlets['ptl.EVMenu'] = array();
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to 
                'expression' => array('RoleMan', 'hasEvent'),
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
        $model = Event::model()->with(array("type", "scope"))->findByPk($id);
        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new EventForm;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['EventForm'])) {
            $model->attributes = $_POST['EventForm'];
            if ($model->save()) {
                if ($model->scope_id == -1) {
                    foreach ($model->attendants as $at) {
                        $ma = new StaffEvent;
                        $ma->type = 'event';
                        $ma->emp_id = $at;
                        $ma->event_id = $model->id;
                        $ma->save();
                    }
                }
                //else {
                $this->notifyRecipient($model, "New Event $model->name on $model->start_date");
                $this->redirect(array('view', 'id' => $model->id));
                //  }
                flashSuccess("Event was successfully created and noted.");
                $this->redirect(array('admin'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * @param Event $event Description
     */
    function notifyGroupEvent($event) {
        Notification::infoGroup("New Event $event->name on $event->start_date", $event->scope);
    }

    function notifyPersonalEvent($event, $uid) {
        Notification::infoUser("New Event $event->name on $event->start_date", "", $uid);
    }

    /**
     * @param Event $event Description
     */
    function notifyRecipient($event, $message) {
        if ($event->scope_id == -1) {
            if ($event->atts == NULL) {
                $event->with('atts');
            }
            foreach ($event->attendants as $at) {
                if (is_a($at, Employees)) {
                    $at = $at->empid;
                }
                $ma = new StaffEvent;
                $ma->type = 'event';
                $ma->emp_id = $at;
                $ma->event_id = $event->id;
                $ma->save();
                Notification::infoUser($message, "", $at);
            }
        } else {
            Notification::infoGroup($message, $event->scope);
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = EventForm::model()->findByPk($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['EventForm'])) {
            $model->attributes = $_POST['EventForm'];
            $model->with('atts');
            foreach ($model->atts as $at) {
                $old[] = $at->empid;
            }
            $allnew = $model->attendants;
            $new = array_diff($allnew, $old);
            $del = array_diff($old, $allnew);
            if ($model->save()) {
                if (count($new) > 0) {
                    foreach ($new as $n) {
                        $ma = new StaffEvent;
                        $ma->type = 'event';
                        $ma->emp_id = $at;
                        $ma->event_id = $model->id;
                        $ma->save();
                        Notification::infoUser("New " . $model->name . " scheduled on " . $model->start_date . " at " . $model->start_time, FALSE, $n);
                    }
                }

                if (count($del) > 0) {
                    foreach ($del as $d) {
                        $dm = StaffEvent::model()->find("event_id=:id AND emp_id=:sid AND type='event'", array(":id" => $model->id, ":sid" => $d));
                        if ($dm != NULL) {
                            $dm->delete();
                            Notification::infoUser("You have been removed from event $model->name", FALSE, $d);
                        }
                    }
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        if ($model->scope_id == -1) {
            $model->with('atts');
            $atts = $model->atts;
            $model->attendants = [];
            foreach ($atts as $at) {
                $model->attendants[] = $at->empid;
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
        $model = $this->loadModel($id);
        if ($model->active == 'Inactive') {
            flashError("You cannot cancel this event because it is not active.");
            $this->redirect(array('admin'));
        }
        if ($model->active == 'Canceled') {
            flashError("You cannot cancel this event because it is already cancelled.");
            $this->redirect(array('admin'));
        }
        $sdate = $model->start_date;
        $edate = $model->end_date;
        $tsd = strtotime(mydate($sdate));
        $ted = strtotime(mydate($edate));
        $tnw = time();
        if ($ted < $tnw) {
            flashError("You cannot cancel this event because it is has already happened.");
            $this->redirect(array('admin'));
        }
        $st = explode(":", $model->start_time)[0];
        $et = explode(":", $model->end_time)[0];
        $nt = date("h");
        if ($st <= $nt && $nt <= $et) {
            flashError("You cannot cancel this event because it is now in session.");
            $this->redirect(array('admin'));
        }
        if ($nt > $et) {
            flashError("You cannot cancel this event because it has already passed.");
            $this->redirect(array('admin'));
        }
        $model->active = 'Canceled';
        $model->save();
        $this->notifyRecipient($model, "Event $model->name due $model->start_date was cancelled");
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionMtCancel($id) {
        $model = Meeting::model()->findByPk($id);
        $ajax = request()->isAjaxRequest;

        if ($model->active == 'Inactive') {
            if (!$ajax) {
                flashError("You cannot cancel this meeting because it is not active.");
                $this->redirect(array('meetings'));
            }
        }
        $st = explode(":", $model->stime)[0];
        $et = explode(":", $model->etime)[0];
        $nt = date("h");
        if ($st <= $nt && $nt <= $et) {
            if (!$ajax) {
                flashError("You cannot cancel this meeting because it is now in session.");
                $this->redirect(array('meetings'));
            }
        }
        if ($nt > $et) {
            if (!$ajax) {
                flashError("You cannot cancel this meeting because it has already passed.");
                $this->redirect(array('meetings'));
            } else {
                echo formatError("You cannot cancel this meeting because it has already passed.");
            }
        }
        if (request()->isPostRequest) {
            $model->attributes = post("Meeting");
            if ($model->cancel_reason == '') {
                echo formatError("Cancel reason is required.");
                die();
            }
            $model->active = 'Canceled';
            $model->cancel_by = user()->id;
            $model->cancel_time = new CDbExpression("CURRENT_TIMESTAMP");
            $model->save();
            $mt = $model->category;
            if ($model->status == 'approved') {
                if ($mt->isDept()) {
                    $dir = $model->creator->dirid;
                    $ats = Employees::getActiveFromDir($dir);
                    foreach ($ats as $at) {
                        $uid = $at->empid;
                        Notification::infoUser("Meeting $model->name was cancelled due to $model->cancel_reason", '', $uid);
                    }
                } elseif ($mt->attnd_scope != -1) {
                    Notification::infoGroup("Meeting $model->name was cancelled due to $model->cancel_reason", $mt->attnd_scope);
                } else {
                    $ats = $model->custom->get;
                    foreach ($ats as $at) {
                        $uid = $at->emp_id;
                        Notification::infoUser("Meeting $model->name was cancelled due to $model->cancel_reason", '', $uid);
                    }
                }
            }if (!$ajax) {
                flashError("The meeting was successfully canceled");
                $this->redirect(array('meetings'));
            } else {
                echo formatSuccess("The meeting was successfully canceled");
            }
        } else {
            $this->renderPartial("_close", array("model" => $model));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $evs = Event::incoming();
        $prov = new CArrayDataProvider($evs);
        $this->render("incoming", array("model" => $prov));
//        $criteria = new CDbCriteria;
//        $criteria->order = "start_date DESC";
//        $criteria->with = array('type', 'scope');
//
//        $dataProvider = new CActiveDataProvider('Event', array(
//            'criteria' => $criteria,
//        ));
//        //$dataProvider = new CActiveDataProvider('Event');
//        $this->render('index', array(
//            'dataProvider' => $dataProvider,
//        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Event('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Event']))
            $model->attributes = $_GET['Event'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Event the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Event::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Event $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'event-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionMtOp($id = FALSE) {
        if ($id != FALSE) {
            $model = MeetingType::model()->findByPk($id);
            $btn = '<input type="submit" name="btnUpd" value="Update" class="btn btn-primary">';
        } else {
            $model = new MeetingType;
            $btn = '<input type="submit" name="btnAdd" value="Create" class="btn green">';
        }
        if (isset($_POST['btnAdd'])) {
            $model->attributes = post("MeetingType");
            if ($model->validate()) {
                $model->save();
                logAction("Meeting Type Create", "Content Id:" . $model->id);
                setFlash("success", "Meeting Type was successfully created.");
            }
        } elseif (isset($_POST['btnUpd'])) {
            $model->attributes = post("MeetingType");
            if ($model->validate()) {
                $model->update();
                logAction("Meeting Type Update", "Content Id:" . $model->id);
                setFlash("success", "Meeting Type was successfully updated");
            }
        }

        $this->render("mtop", array("model" => $model, 'btn' => $btn));
    }

    public function actionMtList() {
        $mts = $this->getMtList();
        $this->render("mtlist", array("mts" => $mts));
    }

    /**
     * Meeting Operation
     * @param integer $id Meeting id in case of update
     */
    public function actionMop($id = FALSE) {
        if ($id != FALSE) {
            $model = MeetingForm::model()->findByPk($id);
            $btn = '<input name="btnUpd" type="submit" value="Update" class="btn btn-primary">';
        } else {
            $model = new MeetingForm;
            $btn = '<input name="btnAdd" type="submit" value="Create" class="btn green">';
        }
        if (app()->request->isPostRequest && $id == FALSE) {
            $model->attributes = post("MeetingForm");
            $model->status = 'pending';
            if ($model->validate()) {
                $mt = MeetingType::model()->findByPk($model->type);

                $ignore = $model->ignore == 'true';
                if (HRRoles::inGroup($mt->creator_scope) || HRRoles::isSysOwner()) {
                    if (!$ignore) {
                        if ($model->type != -1) {
                            $col = Meeting::hasColission(mydate($model->date), $mt->attnd_scope, FALSE);
                        } else {
                            $col = FALSE;
                            foreach ($model->attendants as $at) {
                                $col |=Meeting::hasColission(mydate($model->date), $at);
                            }
                        }
                        if ($col == 1 || $col == TRUE) {
                            $model->ignore = 'prompt';
                            $this->render("mop", array("model" => $model, "btn" => $btn));
                            die();
                        }
                    }
                    $model->stage = 1;
                    if ($model->save()) {
                        if ($model->type == -1) {
                            $ce = new CustomMeeting();
                            $ce->name = $model->name;
                            $ce->meeting_id = $model->id;
                            if ($ce->save()) {
                                foreach ($model->attendants as $at) {
                                    $ma = new StaffEvent;
                                    $ma->type = 'meeting';
                                    $ma->emp_id = $at;
                                    $ma->event_id = $ce->id;
                                    $ma->save();
                                }
                            }
                        }
                        logAction("Meeting Add", "Meeting id:" . $model->id);
                        $syw = SysWorkflow::model()->findByPk(1);
                        $wf = Workflow::model()->findByPk($syw->meeting_wf);
                        $wf->startFlow($model->id, "New Meeting Request", Yii::app()->createUrl("event/apprm", array("id" => $model->id)));
                        setFlash("success", "Meeting created successfully");
                        $this->redirect(array('event/meetings'));
                    }
                } else {
                    setFlash("error", "Sorry you cannot create this type of Meeting");
                    logAction("Create Meeting Error", "Meeting Type Name:" . $mt->name);
                }
            }
        } elseif (app()->request->isPostRequest && $id != FALSE) {
            $model->attributes = post("MeetingForm");
            if ($model->save()) {
                logAction("Meeting Update", $model->attributes);
                flashSuccess("Meeting was successfully updated");
            }
        }

        $this->render("mop", array("model" => $model, "btn" => $btn));
    }

    public function actionMhistory() {
        $c = new CDbCriteria;
        $c->condition = "active='Inactive' OR date < " . AutoSql::CurrentDate() . " or active='Canceled'";
        $c->order = "date DESC";
        $model = Meeting::model()->findAll($c);
        $pv = new CArrayDataProvider($model);
        $this->render("mhistory", array('provider' => $pv));
    }

    public function actionApprM($id) {
        $mtn = Meeting::model()->findByPk($id);
        $mtp = MeetingType::model()->findByPk($mtn->type);
        //$swf = SysWorkflow::getMeetingFlow();
        $wf = SysWorkflow::getMeetingFlow();
        $model = $wf->getStageModel($id, $mtn->stage);
        if ($wf->canApprove($id, $mtn->stage) || RoleMan::isSysOwner()) {
            if (isset($_POST['btnSave'])) {
                $model->attributes = post("WfTxn");
                $mt = MeetingType::model()->findByPk($mtn->type);
                $stat = $wf->submit($model, "New Meeting Request", Yii::app()->createUrl("meeting/apprm", array("id" => $id)));
                if ($stat == 0) {
                    $mtn->stage = ($mtn->stage + 1);
                    $mtn->save();
                    setFlash("success", "Meeting successfully approved and sent to higher levels");
                } elseif ($stat == 1) {
                    $mtn->status = 'approved';
                    $mtn->save();
                    if ($mt->isDept()) {
                        $dir = $mtn->creator->dirid;
                        $ats = Employees::getActiveFromDir($dir);
                        foreach ($ats as $at) {
                            $uid = $at->empid;
                            Notification::infoUser("New " . $mtn->name . " Meeting scheduled on " . $mtn->date . " at " . $mtn->stime, '', $uid);
                        }
                    } elseif ($mt->attnd_scope != -1) {
                        Notification::infoGroup("New " . $mtn->name . " Meeting scheduled on " . $mtn->date . " at " . $mtn->stime, $mt->attnd_scope);
                    } else {
                        $ats = $mtn->custom->get;
                        foreach ($ats as $at) {
                            $uid = $at->emp_id;
                            Notification::infoUser("New " . $mtn->name . " Meeting scheduled on " . $mtn->date . " at " . $mtn->stime, '', $uid);
                        }
                    }
                    setFlash("success", "Meeting successfully approved and executed");
                } else {
                    $mtn->status = 'denied';
                    $mtn->update();
                    Notification::warnUser("Your " . $mt->name . " request was denied.", $mtn->cby);
                    setFlash("success", "Meeting was successfully denied");
                }
                $this->redirect(array('event/meetings'));
            }
            if ($mtn->status == 'approved' || $mtn->status == 'denied') {
                $btn = '<input type="submit" name="btnSave" disabled value="Continue" class="btn green">';
                setFlash("error", "Meeting was already aproved");
            } else {
                $btn = '<input type="submit" name="btnSave" value="Continue" class="btn green">';
            }
            $this->render("mappr", array("model" => $model, 'meeting' => $mtn, 'type' => $mtp, 'btn' => $btn));
        } else {
            flashError("You cannot approve this type of meeting");
            //logAction("Illegal Access", "Create Meeting " . $mtp->name);
            $this->redirect(app()->homeUrl);
        }
    }

    /**
     * @param Meeting $meeting Description
     * @param MeetingType $meetingType Description
     */
    function notifyMeeting($meeting, $meetingType = FALSE) {
        if ($meetingType == FALSE) {
            $meetingType = MeetingType::model()->findByPk($meeting->type);
        }
        if ($meetingType->attnd_scope != -1) {
            Notification::infoGroup("New " . $meetingType->name . " scheduled on " . $meeting->date . " at " . $meeting->stime, '', $meetingType->attnd_scope);
        } else {
            $ats = $meeting->custom->get;
            foreach ($ats as $at) {
                $uid = $at->emp_id;
                Notification::infoUser("New " . $meetingType->name . " scheduled on " . $meeting->date . " at " . $meeting->stime, '', $uid);
            }
        }
    }

    public function getMtList() {
        $comm = app()->db->createCommand();
        $res = $comm->select("mt.id,mt.name Name,r.rolename Attendant,rt.rolename Creator")
                ->from('meeting_type mt')
                ->join("roles r", 'r.roleid=mt.attnd_scope')
                ->join("roles rt", 'rt.roleid=mt.creator_scope')
                ->where("active='Y'")
                ->queryAll();
        $mts = new CArrayDataProvider($res, array(
            'id' => 'logs',
            'sort' => array(
                'attributes' => array(
                    'Name', 'Attendant', 'Creator',
                ),
            ),
            'pagination' => array('pageSize' => PAGE_SIZE,),
        ));
        return $mts;
    }

    public function actionCost($id) {
        $model = new EventItemCost;
        if (app()->request->isPostRequest) {
            $model->attributes = post("EventItemCost");
            $model->event_id = $id;
            if ($model->save()) {
                echo '<div class="alert alert-success">
			Item Successfully Added
                    </div>';
            } else {
                $form = new MetroActiveForm();
                error($form, $model);
            }
            die();
        }
        $this->renderPartial("_cost", array("model" => $model));
    }

    public function actionCosts($id) {
        $criteria = new CDbCriteria;
        $total = EventItemCost::getTotal($id);
        //$event = Event::model()->findByPk();
        if ($total != FALSE) {
            $criteria->condition = "(event_id =$id)";
            $model = new CActiveDataProvider('EventItemCost', array(
                'criteria' => $criteria,
            ));
            $this->render("costs", array("model" => $model, "total" => $total));
        } else {
            flashError("There is no such event or such event has no Costs, Please select from the list provided!.");
            $this->redirect(array("event/admin"));
        }
    }

    public function actionMeetings() {
        $model = new Meeting();
        $criteria = new CDbCriteria();
        //$criteria->select = "*,(if(t.active='Active','Active','Inactive')) as t.active";
        $criteria->with = array('category');
        $criteria->condition = "date >= " . AutoSql::CurrentDate() . " AND t.active='Active'";
        $provider = new CActiveDataProvider("Meeting", array('criteria' => $criteria));
        $this->render("meetings", array("model" => $provider, "meeting" => $model));
    }

    public function actionMTpending() {
        $user = Employees::model()->findByPk(user()->id);
        $req = Meeting::hasRequest($user);
        $prov = new CArrayDataProvider($req);
        $this->render("pending", array("model" => $prov));
    }

    public function actionIncoming() {
        $evs = Event::incoming();
        $prov = new CArrayDataProvider($evs);
        $this->render("incoming", array("model" => $prov));
    }

    public function actionMtClose($id) {
        $model = Meeting::model()->with('category')->findByPk($id);
        $mdate = strtotime(mydate($model->date));
        $now = time();
        if ($mdate > $now) {
            flashError("You cannot close the meeting as it has not taken place yet.");
            $this->redirect(array('meetings'));
        }
        if ($model->status != 'approved') {
            flashError("You cannot close this meeting because it is not approved");
            $this->redirect(array('meetings'));
        }
        if (app()->request->isPostRequest) {

            $model->attributes = post("Meeting");
            $model->active = 'N';
            if ($model->save()) {
                $this->redirect(array("meetings"));
            }
        }
        $this->render("mtclose", array("model" => $model));
    }

    public function actionMtView($id) {
        $model = Meeting::model()->with(array('category'))->findByPk($id);
        $this->render("mtview", array("model" => $model));
    }

    public function actionReports() {
        $model = new Event('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Event']))
            $model->attributes = $_GET['Event'];

        $this->render('rgeneral', array(
            'model' => $model,
        ));
    }

    function actionRptAttendants($id) {
        $model = new EventAttendantsReport;
        if (app()->request->isPostRequest) {
            $model->attributes = post("EventAttendantsReport");
            if ($model->validate()) {
                $ev = Event::model()->findByPk($id);
                if ($ev->scope_id != -1) {
                    $ev->with('scope.members');
                    if ($ev->scope->code != 'user') {
                        $members = $ev->scope->members;
                    } else {
                        $members = Employees::getAllActiveObject();
                    }
                } else {
                    $ev->with('atts');
                    $members = $ev->atts;
                }
                $data = $ev->getValues($model->cols, FALSE);
                $rep = [];
                foreach ($members as $em) {
                    $rep[] = $em->getValues($model->cols);
                }
                $model->generate($rep, $data);
            }
        }
        $this->render("rptattnd", array("model" => $model));
    }

    function actionRptCosts($id) {
        $model = new EventCostReport;
        if (app()->request->isPostRequest) {
            $model->attributes = post("EventCostReport");
            $ev = Event::model()->with('costs')->findByPk($id);
            $costs = $ev->costs;
            $data = $ev->getValues($model->cols, FALSE);
            $rep = [];
            foreach ($costs as $em) {
                $rep[] = $em->getValues($model->cols);
            }
            $model->generate($rep, $data);
        }
        $this->render("rptcost", array("model" => $model));
    }

    public function actionRptMtDate() {
        $model = new RptMtDate();
        if (app()->request->isPostRequest) {
            $model->attributes = post("RptMtDate");
            if ($model->validate()) {
                $cr = new CDbCriteria();
                if ($model->type != 0) {
                    $cr->condition = "type=$model->type";
                }
                $cr->addBetweenCondition("date", mydate($model->from), mydate($model->to));
                $data = Meeting::model()->findAll($cr);
                $v = new ArrayModelReporter($data, array('name',
                    array('name' => 'category.name', 'header' => 'Type'),
                    'date',
                    'stime',
                    'etime'
                        ), $model->output);
                $v->generate(array(
                    'title' => 'Meeting Report',
                    'header' => 'Meeting Report|',
                    'footer' => 'LAPF|{PAGENO}|'
                ));
                exit;
            }
        }
        $this->render("mt_date", array("model" => $model));
    }

    public function actionRptEvDate() {
        $model = new RptMtDate();
        if (app()->request->isPostRequest) {
            $model->attributes = post("RptMtDate");
            if ($model->validate()) {
                $cr = new CDbCriteria();
                if ($model->type != 0) {
                    $cr->condition = "type_id=$model->type";
                }
                $cr->addBetweenCondition("start_date", mydate($model->from), mydate($model->to));
                $data = Event::model()->findAll($cr);
                $v = new ArrayModelReporter($data, array('name', array('name' => 'type.name', 'header' => 'Type'),
                    'start_date',
                    'start_time',
                    'end_date',
                    'end_time'));
                $v->generate(array(
                    'title' => 'Events Report',
                    'header' => 'Events Report|',
                    'footer' => 'LAPF|{PAGENO}|'
                        ), $model->output);
            }
        }
        $this->render("ev_date", array("model" => $model));
    }

    public function actionRptMtCancel() {
        $model = new RptMtDate();
        if (app()->request->isPostRequest) {
            $model->attributes = post("RptMtDate");
            if ($model->validate()) {
                $cr = new CDbCriteria();
                if ($model->type != 0) {
                    $cr->addCondition("type=$model->type");
                }
                $cr->addBetweenCondition("date", mydate($model->from), mydate($model->to));
                $cr->addCondition("active='Canceled'");
                $cr->order = "date DESC";
                $data = Meeting::model()->findAll($cr);

                $v = new ArrayModelReporter($data, array('name',
                    array('name' => 'category.name', 'header' => 'Type'),
                    'date',
                    'stime',
                    'etime',
                    array('name' => 'creator.fullname',
                        'header' => 'Created By'),
                    array('name' => 'canceler.fullname',
                        'header' => 'Cancelled By'),
                    array('name' => 'cancel_reason',
                        'header' => 'Reason'),
                    'cancel_time'));
                $v->generate(array(
                    'title' => 'Cancelled Meeting Report',
                    'header' => 'Canceled Meeting Report|',
                    'footer' => "Copyright © LAPF " . date('Y') . " |{PAGENO}|"
                        ), $model->output);
            }
        }
        $this->render("mt_cancel", array("model" => $model));
    }

    public function actionRptEvCancel() {
        $model = new RptMtDate();
        if (app()->request->isPostRequest) {
            $model->attributes = post("RptMtDate");
            if ($model->validate()) {
                $cr = new CDbCriteria();
                if ($model->type != 0) {
                    $cr->addCondition("type=$model->type");
                }
                $cr->addBetweenCondition("start_date", mydate($model->from), mydate($model->to));
                $cr->order = "start_date DESC";
                $cr->addCondition("active='Canceled'");
                $data = Event::model()->findAll($cr);
                $v = new ArrayModelReporter($data, array('name',
                    array('name' => 'type.name', 'header' => 'Type'),
                    'start_date',
                    'start_time',
                    'end_date',
                    'end_time',
                    array('name' => 'canceler.fname',
                        'header' => 'Cancelled By'),
                    array('name' => 'cancel_reason',
                        'header' => 'Reason'), 'cancel_time'));
                $v->generate(array(
                    'title' => 'Cancelled Events Report',
                    'header' => 'Canceled Events Report|',
                    'footer' => "Copyright © LAPF " . date('Y') . " |{PAGENO}|"
                        ), $model->output);
            }
        }
        $this->render("ev_cancel", array("model" => $model));
    }

    public function actionRptEvCosts() {
        $model = new RptMtDate();
        if (app()->request->isPostRequest) {
            $model->attributes = post("RptMtDate");
            if ($model->validate()) {
                $cr = new CDbCriteria();
                if ($model->type != 0) {
                    $cr->condition = "type_id=$model->type";
                }
                $cr->select = '*,SUM(costs.value) AS total_cost';
                $cr->addBetweenCondition("start_date", mydate($model->from), mydate($model->to));
                $cr->group = 'event_id';
                $cr->order = "start_date asc";
                $data = Event::model()->with('costs')->findAll($cr);
                if (count($data) > 0) {
                    $v = new ArrayModelReporter($data, array('name', array('name' => 'type.name', 'header' => 'Type'),
                        'start_date',
                        'start_time',
                        'end_date',
                        'end_time',
                        array('name' => 'total_cost',
                            'header' => 'Cost'
                        )
                    ));

                    $total = 0;
                    foreach ($data as $r) {
                        $total+=($r->total_cost);
                    }
                    //$v->addRow(array('<hl></hl>'));
                    $v->addRow(array(
                        '<strong>Total</strong>', '', '', '', '', '', $total
                    ));
                    $v->generate(array(
                        'title' => 'Events Costs Report',
                        'header' => 'Events Costs Report|',
                        'footer' => "Copyright © LAPF " . date('Y') . " |{PAGENO}|"
                            ), $model->output);
                } else {
                    flashError("No Data Available in that range");
                }
            }
        }
        $this->render("ev_costs", array("model" => $model));
    }

    public function actionRptMtCosts() {
        $model = new RptMtDate();
        if (app()->request->isPostRequest) {
            $model->attributes = post("RptMtDate");
            if ($model->validate()) {
                $cr = new CDbCriteria();
                if ($model->type != 0) {
                    $cr->condition = "type_id=$model->type";
                }
                $cr->addBetweenCondition("date", mydate($model->from), mydate($model->to));
                $cr->order = "date ASC";
                //$cr->group = 'event_id';
                $data = Meeting::model()->findAll($cr);
                if (count($data) > 0) {
                    $v = new ArrayModelReporter($data, array('name', array('name' => 'type.name', 'header' => 'Type'),
                        'date',
                        'stime',
                        'etime', 'cost'
                    ));

                    $total = 0;
                    foreach ($data as $r) {
                        $total+=($r->cost);
                    }
                    //$v->addRow(array('<hl></hl>'));
                    $v->addRow(array(
                        '<strong>Total</strong>', '', '', '', '', $total
                    ));
                    $v->generate(array(
                        'title' => 'Meeting Costs Report',
                        'header' => 'Meeting Costs Report|',
                        'footer' => "Copyright © LAPF " . date('Y') . " |{PAGENO}|"
                            ), $model->output);
                } else {
                    flashError("No Data Available in that range");
                }
            }
        }
        $this->render("mt_costs", array("model" => $model));
    }

    public function actionRptEviCosts() {
        $model = new RptMtDate();
        $this->render("evi_costs", array("model" => $model));
    }

    public function actionRptMtiCosts() {
        $model = new RptMtDate();
        $this->render("mti_costs", array("model" => $model));
    }

    public function actionDelMt($id) {
        $model = MeetingType::model()->findByPk($id);
        if ($model != FALSE) {
            $model->active = 'N';
            $model->save();
            flashSuccess("Meeting Type was successfully deleted");
            $this->redirect(["mtlist"]);
        }
    }

    function genCalendar() {
        $date = date("Y") . "01-01";
        $val = Calendar::model()->find('dt=:dt', [":dt" => $date]);
        if ($val == FALSE) {
            $q = "INSERT INTO calendar_table (dt)
            SELECT DATE('$date') + INTERVAL a.i*10000 + b.i*1000 + c.i*100 + d.i*10 + e.i DAY
            FROM ints a JOIN ints b JOIN ints c JOIN ints d JOIN ints e
            WHERE (a.i*10000 + b.i*1000 + c.i*100 + d.i*10 + e.i) <= 11322
            ORDER BY 1;";
            if (db()->createCommand($q)->execute()) {
                $hd = "UPDATE calendar_table
                SET isWeekday = CASE WHEN dayofweek(dt) IN (1,7) THEN 0 ELSE 1 END,
                        isHoliday = 0,
                        isPayday = 0,
                        y = YEAR(dt),
                        q = quarter(dt),
                        m = MONTH(dt),
                        d = dayofmonth(dt),
                        dw = dayofweek(dt),
                        monthname = monthname(dt),
                        dayname = dayname(dt),
                        w = week(dt),
                        holidayDescr = '';";
                db()->createCommand($hd)->execute();
                $id = "UPDATE calendar_table SET isHoliday = 1, holidayDescr = 'New Year''s Day' WHERE m = 1 AND d = 1;";
                db()->createCommand($id)->execute();
                $nw = "UPDATE calendar_table SET isHoliday = 1, holidayDescr = 'Independence Day' WHERE m = 12 AND d = 9;";
                db()->createCommand($nw)->execute();
                $kd = "UPDATE calendar_table SET isHoliday = 1, holidayDescr = 'Republic''s Day' WHERE m = 4 AND d = 26;";
                db()->createCommand($kd)->execute();
                $sd = "UPDATE calendar_table SET isHoliday = 1, holidayDescr = 'Sabasaba''s Day' WHERE m = 7 AND d = 7;";
                db()->createCommand($sd)->execute();
            }
        }
    }

}
