<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReportForm
 *
 * @author Ramadan
 */
abstract class ReportForm extends Report implements IReporter {

    public $report;
    public $sorted;
    public $cols;
    public $save;

    public function rules() {
        return array_merge(
                parent::rules(), array(
            array('cols,report', 'required',
            ),
            array(
                'cols,sorted,save,report', 'safe')
        ));
    }

    function setAttributes($values, $safeOnly = true) {
        parent::setAttributes($values, $safeOnly);
        if ($this->id == NULL) {
            $this->cols = explode(",", $this->sorted);
            $this->cols = array_filter($this->cols);
            $this->cols = array_values($this->cols);
        }
        if ($this->report != -1 && $this->report != FALSE) {
            $m = ReportForm::model()->findByPk($this->report);
            $this->scenario = 'update';
            parent::setAttributes($m->attributes);
            $this->id = $m->id;
            $this->isNewRecord = FALSE;
            $cr = new CDbCriteria();
            $cr->order = "position ASC";
            $cr->condition = "report_id=$m->id";
            $cols = ReportColumn::model()->findAll($cr);
            foreach ($cols as $col) {
                $this->cols[] = $col->name;
            }
        }
    }

    public function getColumns() {
        $reps = $this->getReportables();
        $d = array();
        foreach ($reps as $r) {
            $re = new $r;
            $a = array();
            $attrs = $re->getReportAttributes();
            foreach ($attrs as $key => $val) {
                $a[$key] = $val;
            }
            $d[$r] = $a;
        }
        return $d;
    }

    public function attributeLabels() {
        return array_merge(
                parent::attributeLabels(), array(
            'cols' => 'Available Columns',
            'report' => 'Template'
        ));
    }

    public static function getReports() {
        $rs = Report::model()->findAll();
        $d = array();
        $d[-1] = 'Custom';
        foreach ($rs as $r) {
            $d[$r->id] = $r->name;
        }
        return $d;
    }

    public function prepareReport($data) {
        $_title = safeEval($this->title, array("data" => $data), TRUE);
        $title = str_replace("/", "_", $_title); // date slashes
        $_header = safeEval($this->header, array("data" => $data), TRUE);
        $_footer = safeEval($this->footer, array("data" => $data), TRUE);


        $header = "";
        if ($this->header != FALSE) {
            if ($this->header_pos == Report::$LEFT_POSITION) {
                $header.=$_header . "|";
            } elseif ($this->header_pos == Report::$RIGHT_POSITION) {
                $header.= "{l}|{m}|" . $_header;
            } else if ($this->header_pos == Report::$MIDDLE_POSITION) {
                $header.= "{l}|" . $_header;
            }
        }

        $footer = "";
        $has_footer = FALSE;
        if ($this->footer != FALSE) {
            $has_footer = TRUE;
            if ($this->footer_pos == Report::$LEFT_POSITION) {
                $footer.=$_footer . "|{m}|{r}";
            } elseif ($this->footer_pos == Report::$RIGHT_POSITION) {
                $footer.= "{l}|{m}|" . $_footer;
            } else if ($this->footer_pos == Report::$MIDDLE_POSITION) {
                $footer.= "{l}|" . $_footer . "|{r}";
            }
        }

        if ($this->pagination == ReportForm::$INCLUDE) {
//check id top or bottom
            $page = "{PAGENO}";
            if (!$has_footer) {
                if ($this->page_pos == Report::$LEFT_POSITION) {
                    $footer.=$this->header . "|{m}|{r}";
                } elseif ($this->page_pos == Report::$RIGHT_POSITION) {
                    $footer.= "{l}|{m}|" . $page;
                } else if ($this->page_pos == Report::$MIDDLE_POSITION) {
                    $footer.= "{l}|" . $page . "|{r}";
                }
            } else {
                if ($this->page_pos == Report::$LEFT_POSITION) {
                    $footer = str_replace("{l}", $page, $footer);
                } elseif ($this->page_pos == Report::$RIGHT_POSITION) {
                    $footer = str_replace("{r}", $page, $footer);
                } else if ($this->page_pos == Report::$MIDDLE_POSITION) {
                    $footer = str_replace("{m}", $page, $footer);
                }
            }
        }
        $logo = "<img alt='logo' src='" . app()->baseUrl . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . "logo_white.png>";
        if ($this->logo == ReportForm::$INCLUDE) {

            $loghd = FALSE;
            if ($this->logo_vpos == ReportForm::$TOP_POSITION) {
                $loghd = true;
            }
            $loglf = FALSE;
            if ($this->logo_hpos == ReportForm::$LEFT_POSITION) {
                $loglf = TRUE;
            }
            if ($loghd) {
                if ($loglf) {
                    if ($header != '' && str_contain("{l}", $header)) {
                        $header = str_replace("{l}", $logo, $header);
                    } else {
                        $header = $logo . "|{m}|{r}";
                    }
                } else {
                    if ($header != '' && str_contain("{r}", $header)) {
                        $header = str_replace("{r}", $logo, $header);
                    } else {
                        $header = "{l}|{m}" . $logo;
                    }
                }
            } else {
                if ($loglf) {
                    $footer = str_replace("{l}", $logo, $header);
                } else {
                    $footer = str_replace("{r}", $logo, $header);
                }
            }
        }

        $date = "";
        if ($this->date == ReportForm::$INCLUDE) {
            $date = "Printed On {DATE d/m/Y}";
//check if top or bottom
            if (!$has_footer) {
                if ($this->date_pos == Report::$LEFT_POSITION) {
                    $footer.=$this->header . "|{m}|{r}";
                } elseif ($this->date_pos == Report::$RIGHT_POSITION) {
                    $footer.= "{l}|{m}|" . $date;
                } else if ($this->date_pos == Report::$MIDDLE_POSITION) {
                    $footer.= "{l}|{m}" . $date;
                }
            } else {
                if ($this->date_pos == Report::$LEFT_POSITION) {
                    $footer = str_replace("{l}", $date, $footer);
                } elseif ($this->date_pos == Report::$RIGHT_POSITION) {
                    $footer = str_replace("{r}", $date, $footer);
                } else if ($this->date_pos == Report::$MIDDLE_POSITION) {
                    $footer = str_replace("{m}", $date, $footer);
                }
            }
        }

        $footer = str_replace(array("{m}", '{l}', "{r}"), "", $footer);
        $header = str_replace(array("{m}", '{l}', "{r}"), "", $header);

        return array(
            "footer" => $footer,
            "header" => $header,
            'title' => $title
        );
    }

    function validate($attributes = null, $clearErrors = true) {
        if(parent::validate($attributes, $clearErrors)){ 
            if($this->save == '1' && ($this->name == FALSE|| $this->name = '')){
                $this->addError("name", $this->getAttributeLabel("name")." is required.");
            }
        }
        return !$this->hasErrors();
    }
    function generate($content = array(), $data = [], $details = FALSE) {
        if ($this->validate()) {
            if ($details == FALSE) {
                $details = $this->prepareReport($data);
            }
            if ($this->save == '1') {
                if ($this->save()) {
                    $i = 1;
                    foreach ($this->cols as $col) {
                        $rc = new ReportColumn;
                        $rc->report_id = $this->id;
                        $rc->name = $col;
                        $rc->position = $i;
                        $i++;
                        $rc->save();
                    }
                }
            }
            if ($this->output == ReportForm::$TYPE_PDF) {
                Report::pdf($content, $details);
            } elseif ($this->output == ReportForm::$TYPE_EXCEL) {
                
            }
            die();
        }
    }

}
