<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArrayModelReporter
 *
 * @author Ramadan
 */
class ArrayModelReporter {

    private $data;
    private $output;
    private $columns;
    private $rows = [];

    /**
     * @param CActiveRecord[] $data Description
     */
    public function __construct($data = [], $columns = [], $output = 'pdf') {
        $this->data = $data;
        $this->output = $output;
        $this->columns = $columns;
    }

    public function generate($attributes = [], $output = FALSE) {
        if ($output != FALSE) {
            $this->output = $output;
        }
        if (count($this->data) > 0) {
            if ($this->columns == NULL) {
                $this->columns = $this->extractColumns($this->data[0]);
            }
            $data = [];
            foreach ($this->data as $row) {
                $d = [];
                foreach ($this->columns as $col) {
                    $head = NULL;
                    if (is_array($col)) {
                        $head = $col['header'];
                        $col = $col['name'];
                    }
                    if (strpos($col,".")===FALSE) {
                        if ($head == NULL) {
                            $head = $row->getAttributeLabel($col);
                        }
                        $value = $row->$col;
                    } else {
                        $ar = explode(".", $col);
                        $ob = $row;
                        foreach ($ar as $r) {
                            if (is_object($ob)) {
                                $dt = $ob->$r;
                                if (is_object($dt)) {
                                    $ob = $dt;
                                } else {
                                    $value = $dt;
                                }
                                if ($head == NULL) {
                                    $head = $ob->getAttributeLabel($r);
                                }
                            } else {
                                $value = $ob;
                            }
                        }
                    }
                    $d[$head] = $value;
                }
                $data[] = $d;
            }
            foreach ($this->rows as $r) {
                $data[] = $r;
            }
        } else {
            $data = '<p>No Data</p>';
        }

        if ($this->output == 'pdf') {
            Report::pdf($data, $attributes);
        } else if ($this->output == Report::$TYPE_EXCEL) {
            Report::printExcel($data);
        }
    }

    /**
     * Add extra row to the data rows.
     */
    public function addRow($row) {
        $this->rows[] = $row;
    }

    /**
     * @param CActiveRecord $row Description
     */
    protected function extractColumns($row) {
        $cols = $row->attributeNames();
        return $cols;
    }

}
