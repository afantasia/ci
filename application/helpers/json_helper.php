<?php

/**
 * Created by PhpStorm.
 * User: inno_03
 * Date: 2017-04-12
 * Time: 오후 6:36
 */
function RetJson($arr){
	$return = json_encode($arr,JSON_UNESCAPED_UNICODE+JSON_UNESCAPED_SLASHES);
	return $return;
}
function PrtJson($arr){
	$return = json_encode($arr,JSON_UNESCAPED_UNICODE+JSON_UNESCAPED_SLASHES);
	echo $return;
}