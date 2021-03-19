<?php 

require_once(realpath(dirname(__FILE__)) . '/../inc/config.php');

if (empty($_GET['f'])) {
	$_GET['f'] = ""; 
}

switch($_GET['f'])
	{
		case '':
			include('_cos_index_ro.php');
			break;
		
		default:
			include('_cos_' . $_GET['f'] . '.php');
			break;	
	}