<?php
require_once('config.php');

function db_open()
{
	global $db_host;
	global $db_name;
	global $db_user;
	global $db_pass;

	$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	if ($link === false) {
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	return $link;
}

function db_close($link)
{
	// Close connection
	mysqli_close($link);
}


function getStudents(&$recs)
{
	$link = db_open();
	$sql = "SELECT *,DATE_FORMAT(FROM_DAYS(DATEDIFF(now(),dob)), '%Y')+0 AS age FROM student";
	$result = mysqli_query($link, $sql);
	if ($result) {
		$recs = mysqli_fetch_all($result, MYSQLI_ASSOC);
		db_close($link);
		return true;
	}
	db_close($link);
	return false;
}

function getStudent($student_id, &$rec)
{
	$link = db_open();
	$sql = "SELECT * FROM student WHERE id = '" . $student_id . "'";
	$result = mysqli_query($link, $sql);
	if ($result) {
		$rec = mysqli_fetch_array($result, MYSQLI_ASSOC);
		db_close($link);
		return true;
	}
	db_close($link);
	return false;

}

function saveStudent($rec)
{
	$link = db_open();
	$sql = "INSERT INTO student(first_name, last_name, dob, gender, email) VALUES ('" . $rec['first_name'] . "', '" . $rec['last_name'] . "','" . $rec['dob'] . "', '" . $rec['gender'] . "' , '" . $rec['email'] . "')";
	$res = mysqli_query($link, $sql);
	db_close($link);
	if ($res) {
		return true;
	} else {
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		return false;
	}
}

function removeStudent($student_id)
{
	$link = db_open();
	$sql = "DELETE FROM student WHERE id='" . $student_id . "'";
	$res = mysqli_query($link, $sql);
	db_close($link);
	if ($res) {
		return true;
	} else {
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		return false;
	}
}

function updateStudent($rec)
{
	$link = db_open();
	$sql = "UPDATE student SET first_name='" . $rec['first_name'] . "', last_name='" . $rec['last_name'] . "', dob='" . $rec['dob'] . "',gender='" . $rec['gender'] . "', email='" . $rec['email'] . "' WHERE id='" . $rec['id'] . "'";
	$res = mysqli_query($link, $sql);
	db_close($link);
	if ($res) {
		return true;
	} else {
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		return false;
	}
}

//delete all
function deleteMultipleStudent($id)
{
	$link = db_open();
	$sql = "delete from student where id in (".$id.")";
	$res = mysqli_query($link, $sql);
	db_close($link);
	if ($res) {
		return true;
	} else {
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		return false;
	}
}

?>
