<?php

/**
 * This is the model class for table "report".
 *
 * The followings are the available columns in table 'report':
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $title
 * @property string $header
 * @property string $header_pos
 * @property string $footer
 * @property string $footer_pos
 * @property string $pagination
 * @property string $page_pos
 * @property string $date
 * @property string $date_pos
 * @property string $logo
 * @property string $logo_vpos
 * @property string $logo_hpos
 * @property string $output
 * @property string $description
 * @property string $ctime
 */
class Report extends CActiveRecord {

    public static $LEFT_POSITION = "left";
    public static $MIDDLE_POSITION = "middle";
    public static $RIGHT_POSITION = "right";
    public static $INCLUDE = "Include";
    public static $IGNORE = "Ignore";
    public static $TOP_POSITION = "top";
    public static $BOTTOM_POSITION = "bottom";
    public static $TYPE_pdf = "pdf";
    public static $TYPE_EXCEL = "excel";
    public static $TYPE_CSV = "csv";

    public static function preprocess($content, $styles = FALSE) {
        $base_keys = array_keys($content);
        $f = $content[$base_keys[0]];
        $headers = array();
        $rows = array();
        if (is_array($f)) {
            //multidim with data possibly in second dimension
            //extract headers from this dimension
            $headers = array_keys($f);
            foreach ($content as $r) {
                $rows[] = $r;
            }
        } else {
            //single row base keys are headers
            $headers = $base_keys;
            $rows[] = $content;
        }
        $str = "<html><head><style type='text/css'>$styles</style></head><body>"
                . "<table border=1 cellpadding=1 cellspacing=0 width=100%><tr><td align=center><img src=images/udlogo.png width=113 height=118 /></td></tr></table>"
                . "<table border=1 cellpadding=2 cellspacing=0 width=100% align=center>";
        $thd = '<thead><tr>';
        //if ($headers[0] != 0) {
        foreach ($headers as $col) {
            $th = "<th>" . ucfirst($col) . "</th>";
            $thd.=$th;
        }
        //}
        $thd.='</tr></thead><tbody>';
        $str.=$thd;
        foreach ($rows as $row) {
            $tr = '<tr>';
            foreach ($row as $col => $value) {
                $tr.="<td>$value</td>";
            }
            $tr.='</tr>';
            $str.=$tr;
        }
        $str.='</tbody></table></body></html>';
        return $str;
    }

    public static function printPdf($content, $title = false, $header = FALSE, $footer = FALSE, $css = FALSE, $page_layout = 'potrait') {
        if ($page_layout == 'potrait') {
            $mpdf = new mpdf();
        } else {
            $mpdf = new mpdf('c', 'A4-L');
        }
        if (is_array($css)) {
            $stylesheet = "";
            foreach ($css as $c) {
                $stylesheet .= file_get_contents($c);
            }
            //$mpdf->WriteHTML($stylesheet, 1);
        } else {
            if ($css == FALSE) {
                $css = Yii::getPathOfAlias("webroot.css") . DIRECTORY_SEPARATOR . "pdfrpt.css";
            }
            $stylesheet = file_get_contents($css);
            $mpdf->WriteHTML($stylesheet, 1);
        }
        if (is_array($content)) {
            $content = self::preprocess($content, $stylesheet);
        }
        $mpdf->SetProtection(array('print'));
        if ($title) {
            $mpdf->SetTitle($title);
        }
        if ($header) {
            $mpdf->SetHeader($header);
        }
        if ($footer) {
            $mpdf->SetFooter($footer);
        }
        $mpdf->WriteHTML($content);

        $mpdf->Output('Academic Staff -' . time() . '.pdf', 'I');
    }

    public static function pdf($content, $attributes) {
        self::printPdf($content, $attributes['title'], $attributes['header'], $attributes['footer'],$attributes['css'],$attributes['layout']);
    }

    public static function getPdf($content, $title = false, $header = FALSE, $footer = FALSE) {
        $mpdf = new mpdf();
        $mpdf->SetProtection(array('print'));
        if ($title) {
            $mpdf->SetTitle($title);
        }
        if ($header) {
            $mpdf->SetHeader("Academic Staff UDSM");
        }
        if ($footer) {
            $mpdf->SetFooter('Printed on: {DATE d/m/Y}|{PAGENO}');
        }
        $mpdf->WriteHTML($content);
        $path = Yii::getPathOfAlias('webroot.docs.tmp');
        $name = time() . '.pdf';
        $file = $path . DIRECTORY_SEPARATOR . $name;
        $mpdf->Output($file, 'F');
        return $name;
    }

    public static function printExcel($rows = [], $headers = [], $title = false, $worksheet = FALSE, $description = FALSE) {
        Yii::import('ext.phpexcel.XPHPExcel');
        $objPHPExcel = XPHPExcel::createPHPExcel();
// Set properties
        $objPHPExcel->getProperties()->setCreator("SDMS Portal");
        $objPHPExcel->getProperties()->setCompany("SDMS");
        if ($title != FALSE) {
            $objPHPExcel->getProperties()->setTitle($title);
        }
        $objPHPExcel->getProperties()->setSubject("Report");
        $objPHPExcel->getProperties()->setDescription($description);
// Add some data
        $objPHPExcel->setActiveSheetIndex(0);
        if ($worksheet != FALSE) {
            $objPHPExcel->getActiveSheet()->setTitle($worksheet);
        }

        if ($headers == NULL) {
            if (!array_key_exists(0, $rows)) {
                $headers = array_keys($rows);
            } else {
                $headers = array_keys($rows[0]);
            }
        }
        $letters = range('A', 'Z');
        $count = 0;
        $cell_name = "";
        foreach ($headers as $header) {
            $cell_name = $letters[$count] . "1";
            $count++;
            $objPHPExcel->getActiveSheet()->SetCellValue($cell_name, $header);
            $objPHPExcel->getActiveSheet()->getStyle($cell_name)
                    ->getFill()
                    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FF808080');
        }
        $rowCount = 2;
        foreach ($rows as $row) {
            $count = 0;
            foreach ($row as $key => $value) {
                $cell_name = $letters[$count] . $rowCount;
                $count++;
                $objPHPExcel->getActiveSheet()->SetCellValue($cell_name, $value);
            }
            $rowCount++;
        }

        ob_end_clean();
        ob_start();

        if ($title == FALSE) {
            $title = "SDMS report.xls";
        }
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $title . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public static function readExcel($filename) {
        Yii::import('ext.phpexcel.XPHPExcel');
        XPHPExcel::createPHPExcel();
        try {
            $inputFileType = PHPExcel_IOFactory::identify($filename);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($filename);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($filename, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $rowData = array();
        for ($row = 1; $row <= $highestRow; $row++) {
            $rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row)[0];
        }
        return $rowData;
    }

    public static function getReports() {
        $rs = Report::model()->findAll();
        $d = array();
        $d[-1] = 'None';
        foreach ($rs as $r) {
            $d[$r->id] = $r->name;
        }
        return $d;
    }

    public static function getPosition() {
        return array(
            'left' => 'Left',
            'middle' => 'Middle',
            'right' => 'Right'
        );
    }

    public static function getInclude() {
        return array(
            'Include' => 'Include',
            'Ignore' => 'Ignore'
        );
    }

    public function getOutputs() {
        return array(
            'excel' => 'Excel',
            'pdf' => 'pdf',
            'print' => 'Print',
            'screen' => 'Screen',
        );
    }

}
