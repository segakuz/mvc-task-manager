<?php

//Compares cyrillic strings
function mb_strcasecmp($str1, $str2, $encoding = null) {
    if (null === $encoding) {
    	$encoding = mb_internal_encoding();
    }
    return strcmp(mb_strtolower($str1, $encoding), mb_strtolower($str2, $encoding));
}
