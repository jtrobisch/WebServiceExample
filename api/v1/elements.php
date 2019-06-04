<?php
	// Connect to database
	include("../connection.php");
	$db = new dbObj();
	$connection =  $db->getConnstring();
	
	//Fetch server request method
	$request_method=$_SERVER["REQUEST_METHOD"];
	
	switch($request_method)
	{
		case 'GET':
			// Return Elements
			if(isset($_GET["atomic_id"])){
				if(!empty($_GET["atomic_id"]))
				{
					$id=intval($_GET["atomic_id"]);
					get_element_by_id($id);
				}
				else
				{
					get_elements();
				}
			}
			elseif(isset($_GET["atomic_symbol"])){
				if(!empty($_GET["atomic_symbol"]))
				{
					$symbol=$_GET["atomic_symbol"];
					get_element_by_symbol($symbol);
				}
				else
				{
					get_elements();
				}
			}else{
				get_elements();
			}
		break;
		case 'POST':
			// Insert Element
			insert_element();
		break;
		case 'PUT':
			// Update Element
			update_element();
		break;
		case 'DELETE':
			// Delete Element
			$id=intval($_GET["atomic_id"]);
			delete_element($id);
		break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
		break;
	}

	function get_elements()
	{
		global $connection;
		$query="SELECT * FROM periodic_table";
		$response=array();
		$result=mysqli_query($connection, $query);
		while($row=mysqli_fetch_assoc($result))
		{
		$response[]=$row;
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	
	function get_element_by_id($id=0)
	{
		global $connection;
		$query="SELECT * FROM periodic_table";
		if($id != 0)
		{
			$query.=" WHERE `atomic_id` =".$id." LIMIT 1";
		}
		$response=array();
		$result=mysqli_query($connection, $query);
		while($row=mysqli_fetch_assoc($result))
		{
			$response[]=$row;
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	
	function get_element_by_symbol($symbol)
	{
		global $connection;
		$query="SELECT * FROM periodic_table";
		if($symbol != "")
		{
			$query.=" WHERE `atomic_symbol` ='".$symbol."' LIMIT 1";
		}
		$response=array();
		$result=mysqli_query($connection, $query);
		while($row=mysqli_fetch_assoc($result))
		{
			$response[]=$row;
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	function insert_element()
	{
		global $connection;
 
		$data = json_decode(file_get_contents('php://input'), true);
		$symbol=$data["atomic_symbol"];
		$name=$data["element_name"];
		$mass=$data["atomic_mass"];
		$melting_point=$data["melting_point_in_C"];
		$boiling_point=$data["boiling_point_in_C"];
		$source=$data["source"];
		$colour=$data["colour"];
		$uses=$data["uses"];

		$query="INSERT INTO periodic_table SET atomic_symbol='".$symbol."', element_name='".$name."', atomic_mass='".$mass
		."', melting_point_in_C='".$melting_point."', boiling_point_in_C='".$boiling_point."', source='".$source
		."', colour='".$colour."', uses='".$uses."'";
		if(mysqli_query($connection, $query))
		{
		$response=array(
		'status' => 1,
		'status_message' =>'Element Added Successfully.'
		);
		}
		else
		{
		$response=array(
		'status' => 0,
		'status_message' =>'Element Addition Failed.'
		);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	function update_element()
	{
		global $connection;
		$post_vars = json_decode(file_get_contents("php://input"),true);
		$symbol=$post_vars["atomic_symbol"];
		$name=$post_vars["element_name"];
		$mass=$post_vars["atomic_mass"];
		$melting_point=$post_vars["melting_point_in_C"];
		$boiling_point=$post_vars["boiling_point_in_C"];
		$source=$post_vars["source"];
		$colour=$post_vars["colour"];
		$uses=$post_vars["uses"];
		$id=$post_vars["atomic_id"];

		$query="UPDATE periodic_table SET atomic_symbol='".$symbol."', element_name='".$name."', atomic_mass='".$mass
		."', melting_point_in_C='".$melting_point."', boiling_point_in_C='".$boiling_point."', source='".$source
		."', colour='".$colour."', uses='".$uses."' WHERE atomic_id=".$id;
		if(mysqli_query($connection, $query))
		{
		$response=array(
		'status' => 1,
		'status_message' =>'Element Updated Successfully.'
		);
		}
		else
		{
		$response=array(
		'status' => 0,
		'status_message' =>'Element Updation Failed.'
		);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	function delete_element($id)
	{
		global $connection;
		$query="DELETE FROM periodic_table WHERE atomic_id =".$id;
		if(mysqli_query($connection, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Element Deleted Successfully.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'Element Deletion Failed.'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

?>