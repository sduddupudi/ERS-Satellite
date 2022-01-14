<?php

function checkField($value = "", $name = "", $option = []) {
    $value = clean($value);

    if(!(isset($option['empty']) && $option['empty'] && mb_strlen($value) == 0)) {
        if(isset($option['required']) && $option['required']) {
            checkRequired($value, $name);
        }

        if(isset($option['checkEmail']) && $option['checkEmail']) {
            $value = checkEmail($value, $name);
        }

        if(isset($option['min'])) {
            checkMin($value, $name, $option['min']);
        }

        if(isset($option['max'])) {
            checkMax($value, $name, $option['max']);
        }

        if(isset($option['regex'])) {
            checkRegex($value, $name, $option['regex'], (isset($option['empty']) && $option['empty']));
        }
    }

    return $value;
}

function clean($value = "") {
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);

    return $value;
}

function checkRequired($value = "", $name = "") {
    $result = mb_strlen($value) > 0;

    if(empty($value) || !$result) {
        throw new Exception($name . ' - required error');
    }
}

function checkEmail($value = "", $name = "") {
    $email_validate = filter_var($value, FILTER_VALIDATE_EMAIL);

    if($email_validate == false) {
        throw new Exception($name . ' - email error');
    }

    return $email_validate;
}

function checkMin($value = "", $name = "", $min = 2) {
    $result = mb_strlen($value) < $min;

    if($result) {
        throw new Exception($name . ' - min length error');
    }
}

function checkMax($value = "", $name = "", $max = 30) {
    $result = mb_strlen($value) > $max;

    if($result) {
        throw new Exception($name . ' - max length error');
    }
}

function checkRegex($value = "", $name = "", $regex = '', $empty = false)
{
    if(!($empty && mb_strlen($value) == 0)) {
        if (!preg_match("#^[".$regex."]+$#", $value)) {
            throw new Exception($name . ' - regex error');
        }
    }
}

?>