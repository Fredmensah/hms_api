<?php
/**
 * Created by PhpStorm.
 * User: DevKobby
 * Date: 3/7/2020
 * Time: 2:19 AM
 */
function imploadValue($types){
    $strTypes = implode(",", $types);
    return $strTypes;
}

function explodeValue($types){
    $strTypes = explode(",", $types);
    return $strTypes;
}

function random_code(){

    return random_int(1000, 9999);
}

function remove_special_char($text) {

    $t = $text;

    $specChars = array(
        ' ' => '-',    '!' => '',    '"' => '',
        '#' => '',    '$' => '',    '%' => '',
        '&amp;' => '',    '\'' => '',   '(' => '',
        ')' => '',    '*' => '',    '+' => '',
        ',' => '',    '₹' => '',    '.' => '',
        '/-' => '',    ':' => '',    ';' => '',
        '<' => '',    '=' => '',    '>' => '',
        '?' => '',    '@' => '',    '[' => '',
        '\\' => '',   ']' => '',    '^' => '',
        '_' => '',    '`' => '',    '{' => '',
        '|' => '',    '}' => '',    '~' => '',
        '-----' => '-',    '----' => '-',    '---' => '-',
        '/' => '',    '--' => '-',   '/_' => '-',

    );

    foreach ($specChars as $k => $v) {
        $t = str_replace($k, $v, $t);
    }

    return $t;
}
