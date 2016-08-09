<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArrayObjectReporter
 *
 * @author Ramadan
 */
class ArrayObjectReporter {

    private $data;
    private $output;
    private $extra;

    public function __construct($data = [], $output = 'pdf') {
        $this->output = $output;
        $this->data = $data;
    }

    public function generate($attributes = [], $output = FALSE) {
        if ($output != FALSE) {
            $this->output = $output;
        }
        $data = $this->data;
        foreach ($this->extra as $r) {
            $data[] = $r;
        }

        if(count($data) == 0){
            $data = "<p><font color=red>No data in record</font></p>";
        }
        if ($this->output == 'pdf') {
            Report::pdf($data, $attributes);
        } else if ($this->output == Report::$TYPE_EXCEL) {
            Report::printExcel($data);
        }
    }

    public function addRow($row) {
        $this->extra[] = $row;
    }

    /**
     * @param CActiveRecord $row Description
     */
    protected function extractColumns($row) {
        $cols = array_keys($row);
        return $cols;
    }

}
