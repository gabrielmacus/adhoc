<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 16/01/2017
 * Time: 10:35 AM
 */

function is_assoc($array) {
    return (is_array($array) && (count($array)==0 || 0 !== count(array_diff_key($array, array_keys(array_keys($array))) )));
} 