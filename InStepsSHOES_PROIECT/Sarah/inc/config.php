<?php
	
	$cfg_main['rel_root'] = '/Sarah';

	$cfg_main['static_root'] = 'http://' . $_SERVER['SERVER_NAME'] .  $cfg_main['rel_root'];
	
    $cfg_main['path_root'] = $_SERVER['DOCUMENT_ROOT'] . $cfg_main['rel_root'];		
	
    $cfg_main['path_inc'] = $cfg_main['path_root'] . '/inc/';

	$cfg_main['tema'] = 'standard';
	
	$cfg_main['path_tema'] = $cfg_main['path_root'] . '/teme/'.$cfg_main['tema'].'/';

	//mysql config
	$cfg_mysql['host'] = 'localhost';
	$cfg_mysql['db'] = 'shoes';
	$cfg_mysql['user'] = 'root';
	$cfg_mysql['password'] = '';

