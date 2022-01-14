<?php

function generateToken($id = null) {
    return $_SESSION[getKey($id)] = substr( str_shuffle( 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM' ), 0, 10 );
}

function csrfHtml($id = null) {
    generateToken($id);
    printf('<input type="hidden" name="csrf" value="%s" />', $_SESSION[getKey($id)]);
}

function checkCsrf($id = null) {
    if (!array_key_exists('csrf', $_POST) || $_POST['csrf'] !== $_SESSION[getKey($id)]) {
        throw new Exception('CSRF token error');
        die;
    }
}

function removeCsrf($id = null)
{
    unset($_SESSION[getKey($id)]);
}

function getKey($id = null) {
    return $id != null ? 'csrf_token_'.$id : 'csrf_token';
}

?>