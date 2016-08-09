<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SmsSender
 *
 * @author JAQUILINE
 */
class SmsSenderCommand extends CConsoleCommand {

    public function actioncronsend() {
        $ov = Notification::getOverstay();

        $url = 'api.infobip.com/sms/1/text/single';
        foreach ($ov as $v) {
            $no = $v->phone;
            $send = '{  
  "from":"UdStaff",
  "to":"' . $no . '",
  "text":"Hello! Please register for further studies according to policies and principles of Academic staff development UDSM"
}';
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

    public function actionsend($message, $number) {
        
    }

}
