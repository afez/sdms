<?php

/**
 * 
 * @param type $timestamp
 * @return type
 */
function get_date($timestamp = null) {
    //get default  date time settings
    $dateFormat = Yii::app()->params['dateFormat'];
    return date($dateFormat, $timestamp);
}

/**
 * 
 * @param type $timestamp
 * @return type
 */
function get_date_time($timestamp = null) {
    //get default  date time settings
    $dateFormat = Yii::app()->params['dateTimeFormat'];
    return date($dateFormat, $timestamp);
}

/**
 * 
 * @param type $timestamp
 * @return type
 */
function get_timeRange($timestamp) {

    $time = time() - $timestamp; // to get the time since that moment

    $tokens = array(
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit)
            continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '') . ' ago';
    }
}

/**
 * 
 * @param type $fname
 * @param type $lname
 * @return type string formated name
 */
function format_name($fname, $lname) {
    return $fname . ' ' . strtoupper(substr($lname, 0, 1)) . '.';
}

/**
 * load currencies
 * @param type $default  false get all currencies accepted, default value is true, 
 * @return type
 */
function get_currency($default = true) {
    return Yii::app()->params['defaultCurrency'];
}

/**
 * 
 * @param type $user_id
 * @param type $len
 * @return type
 */
function generate_uuid($user_id) {
    //get max leng of the account code   
    $len = Yii::app()->params['accountCodeLength'];
    $hex = md5($user_id . uniqid("", true));

    $pack = pack('H*', $hex);
    $tmp = base64_encode($pack);

    $uid = preg_replace("#(*UTF8)[^A-HJ-NP-Z2-9]#", "", $tmp);
    //remove consecutive repeating characters
    $uid = preg_replace('/(.)\\1+/', '$1', $uid);
    $len = max(4, min(128, $len));

    while (strlen($uid) < $len)
        $uid .= generate_uuid($user_id, 22);

    return substr($uid, 0, $len);
}

/**
 * Accepts string, return alpha-numeric charcters 
 * @param type $string
 */
function get_key($string) {
    $key = preg_replace("~[^a-z0-9:]~i", "", $string);
    return strtolower($key);
}

function get_list($model, $label, $value = 'id') {
    if (!$label)
        $label = 'name';
    if (!$value)
        $value = 'id';
    return CHtml::listData($model, $value, $label);
}

function get_unique_filename() {
    return rand(0, 99) . time() . Yii::app()->user->id . rand(0, 999);
}

/**
 * 
 * @param type $absolute
 * @return type string absolute url of the folder
 */
function track_upload_url($absolute = false) {
    if ($absolute)
        return Yii::getPathOfAlias('webroot.uploads.tracks') . DIRECTORY_SEPARATOR;
    else
        return param('trackUrl');
}

/**
 * 
 * @param type $absolute
 * @return type string absolute url of the folder
 */
function short_track_upload_url($absolute = false) {
    if ($absolute)
        return Yii::getPathOfAlias('webroot.uploads.tracks.short') . DIRECTORY_SEPARATOR;
    else
        return param('trackShortUrl');
}

/**
 * returns relative or absolute url of the Track cover directory
 * @param boolean $relative default false
 * @return string relative or absolute url
 */
function cover_upload_url($relative = false) {
    $relativeUrl = baseUrl() . '/uploads/images/cover/tracks/';
    $absoluteUrl = Yii::getPathOfAlias('webroot.uploads.images.cover.tracks') . DIRECTORY_SEPARATOR;
    return $relative ? $relativeUrl : $absoluteUrl;
}

function url($route, $params = array()) {

    return Yii::app()->createUrl($route, $params);
}

function baseUrl() {
    return Yii::app()->baseUrl;
}

/**
 * 
 * @param type array $array
 * @return String separated by commas
 */
function get_string($array) {
    $string = null;
    $i = 0;
    if (is_array($array)) {
        $len = sizeof($array);
        foreach ($array as $elem) {
            $string .= $elem;

            if (++$i < $len)
                $string .= ',';
        }
    }
    return $string;
}

/**
 * 
 * @return int id user id of current user
 */
function get_user_id() {
    return Yii::app()->user->id;
}

/**
 * 
 * @param type $action
 * @return boolean if user can perform action
 */
function can($action) {
    return Yii::app()->user->can($action);
}

/**
 * 
 * @param type $path
 * @return boolean
 */
function file_download($path, $name = null) {
    $file = Yii::app()->file->set($path, true);

    if ($file->exists)
        $file->download($name);
    else
        return false;

    return true;
}

/**
 * it wraps yii::app()->params[]
 * @param  string $key key of parameter
 * @return string param value
 */
function param($key) {
    return Yii::app()->params[$key];
}

/**
 * 
 * @param string $label stat label
 * @param number $value number of the stat
 * @param  boolean $both if both label and value should be returned 
 * @param boolen $plural  if the stat has plural form default true
 * @return string formated label
 */
function format_stats($label, $value, $both = true, $plural = true) {
    if ($value > 1) {
        if ($plural)
            $label = $label . 's';
    }
    if ($both)
        return number_format($value) . ' ' . $label;

    return $label;
}

function load($model) {
    if (!$model)
        throw new CHttpException(404, 'Page requested not found');
}

function format_money($money, $includeCurrency = true) {
      $space = '&nbsp;';
       $currency = null;
    if ($includeCurrency)
        $currency = param('defaultCurrency').$space;

    return $currency . number_format($money);
}

?>
