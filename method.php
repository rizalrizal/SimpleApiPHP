<?php
include "koneksi.php";
class Mahasiswa 
{

	public  function get_mhss()
	{
		global $mysqli;
		$query="SELECT * FROM tbl_mahasiswa";
		$response=array();
		$result=$mysqli->query($query);
		while($row=mysqli_fetch_object($result))
		{
			$response[]=$row;
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function get_mhs($id=0)
	{
		global $mysqli;
		$query="SELECT * FROM tbl_mahasiswa";
		if($id != 0)
		{
			$query.=" WHERE id=".$id." LIMIT 1";
		}
		$response=array();
		$result=$mysqli->query($query);
		while($row=mysqli_fetch_object($result))
		{
			$response[]=$row;
		}
		header('Content-Type: application/json');
		echo json_encode($response);
		 
	}

	public function insert_mhs()
		{
			global $mysqli;
			$arrcheckpost = array('nim' => '', 'nama' => '', 'jk' => '', 'alamat' => '', 'jurusan'   => '');
			$hitung = count(array_intersect_key($_POST, $arrcheckpost));
			if($hitung == 5){
			
					$result = mysqli_query($mysqli, "INSERT INTO tbl_mahasiswa SET
					nim = '$_POST[nim]',
					nama = '$_POST[nama]',
					jk = '$_POST[jk]',
					alamat = '$_POST[alamat]',
					jurusan = '$_POST[jurusan]'");
					
					if($result)
					{
						$response=array(
							'status' => 1,
							'status_message' =>'Mahasiswa Added Successfully.'
						);
					}
					else
					{
						$response=array(
							'status' => 0,
							'status_message' =>'Mahasiswa Addition Failed.'
						);
					}
			}else{
				$response=array(
							'status' => 0,
							'status_message' =>'Mahasiswa Addition Failed.'
						);
			}
			header('Content-Type: application/json');
			echo json_encode($response);
		}

	function update_mhs($id)
		{
			global $mysqli;
			parse_str(file_get_contents("php://input"),$post_vars);
			
		        $result = mysqli_query($mysqli, "UPDATE tbl_mahasiswa SET
		        nim = '$post_vars[nim]',
		        nama = '$post_vars[nama]',
		        jk = '$post_vars[jk]',
		        alamat = '$post_vars[alamat]',
		        jurusan = '$post_vars[jurusan]'
		        WHERE id='$id'");
		   
			if($result)
			{
				$response=array(
					'status' => 1,
					'status_message' =>'Mahasiswa Updated Successfully.'
				);
			}
			else
			{
				$response=array(
					'status' => 0,
					'status_message' =>'Mahasiswa Updation Failed.'
				);
			}
			header('Content-Type: application/json');
			echo json_encode($response);
		}

	function delete_mhs($id)
	{
		global $mysqli;
		$query="DELETE FROM tbl_mahasiswa WHERE id=".$id;
		if(mysqli_query($mysqli, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Mahasiswa Deleted Successfully.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'Mahasiswa Deletion Failed.'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
}

 ?>