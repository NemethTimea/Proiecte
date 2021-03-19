<?php 

require_once(realpath(dirname(__FILE__)) . '/../inc/config.php');
if (empty($_GET['f'])) {
	$_GET['f'] = ""; 
}

switch($_GET['f'])
	{
		case '':
			include('_contact_index_ro.php');
			break;
		
		default:
			include('_contact_' . $_GET['f'] . '.php');
			break;	
	}