<?php
require_once "method.php";
$mhs = new Mahasiswa();
$request_method=$_SERVER["REQUEST_METHOD"];
switch ($request_method) {
	case 'GET':
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				$mhs->get_mhs($id);
			}
			else
			{
				$mhs->get_mhss();
			}
			break;
	case 'POST':
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				$mhs->update_mhs($id);
			}
			else
			{
				$mhs->insert_mhs();
			}		
			break; 
	case 'DELETE':
		    $id=intval($_GET["id"]);
            $mhs->delete_mhs($id);
            break;
	default:
		// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
		break;
}




?>