<?php



$conn = mysqli_connect("localhost","phuocdepzai","123456","shopping");

if($conn->connect_error){
   echo $conn->errno;
};

function getData($table,$id=0,$start=0,$limit=0 ){
	global $conn;
	$queryId = $id ? "where id = $id " : "";
    $queryLimit = ($limit) ?
        "limit $start,$limit" : "";
	$query =  "select * from $table $queryId $queryLimit";
	return mysqli_query($conn,$query);
}

function addData($table,$data){
	global $conn;
	$valueData = "";
	$keyData = "";
	foreach ($data as $key => $value) {
		$keyData .= $key."," ;

		$valueData .= "'" . $value . "',";
	}
	 $keyData=trim($keyData,",");
	 $valueData=trim($valueData,",");

	 return mysqli_query($conn,"insert into $table($keyData) values ($valueData)");
}

$updateData = function (string $table,array $data,int $id) use ($conn) {
    $valueUpdate = "";
    foreach ($data as $key => $value) {

        $valueUpdate .=  "$key = '$value' ,";
    }

    $valueUpdate=trim($valueUpdate,",");

    return mysqli_query($conn,"update $table set $valueUpdate where id=$id");
};





