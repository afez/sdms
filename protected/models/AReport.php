<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AReport
 *
 * @author Ramadan
 */
class AReport extends CFormModel  {

    public $output = 'pdf';
    public function rules() {
        return array(
                    array('output','required')
                );
    }
    public function getOutputs() {
        return array(
            'pdf' => 'Pdf',
            'excel' => 'Excel'
        );
    }

}
