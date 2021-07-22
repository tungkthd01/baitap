<?php
require_once ('config.php');

function execute($sql) {
	//save data into table
	// open connection to database
	$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	//insert, update, delete
	mysqli_query($con, $sql);

	//close connection
	mysqli_close($con);
}

function executeResult($sql) {
	//save data into table
	// open connection to database
	$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	//insert, update, delete
	$result = mysqli_query($con, $sql);
	$data   = [];
	while ($row = mysqli_fetch_array($result, 1)) {
		$data[] = $row;
	}

	//close connection
	mysqli_close($con);

	return $data;
}

function executeSingleResult($sql) {
	//save data into table
	// open connection to database
	$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	//insert, update, delete
	$result = mysqli_query($con, $sql);
	$row    = mysqli_fetch_array($result, 1);

	//close connection
	mysqli_close($con);

	return $row;
}
$creat = "create table if not exists post(
	id int primary key auto_increment,
	title varchar(200) not null,
	description text,
	image varchar(500),
	status int ,
	created_at datetime,
	updated_at datetime
)";
execute($creat);    