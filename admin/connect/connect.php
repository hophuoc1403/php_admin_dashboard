<?php



$conn = mysqli_connect("localhost","phuocdepzai","123456","shopping");

if($conn->connect_error){
   echo $conn->errno;
};

function getData($table,$id=0){
	global $conn;
	$queryId = $id ? "where id = $id " : "";
	$query =  "select * from $table $queryId";

	return mysqli_query($conn,$query);
}

function addData($table,$data){


	$keyData = "";
	foreach ($table as $key => $value) {
		$keyData .= $key . ",";
	}
}

?>
