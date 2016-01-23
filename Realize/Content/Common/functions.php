<?php

function thumb($path){
	$path = explode("/", $path);
	$path = '/'.$path[1].'/'.$path[2].'/thumb/'.$path[4].'/s_'.$path[5];
	return $path;
}