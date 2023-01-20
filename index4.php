<html>
<body>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.1/datatables.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap4.css">
<!-- delete -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<!-- edit -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.1/datatables.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">


<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once('model.php');
require_once('view.php');



showHeader();
$task = $_REQUEST['task'];

if ($task == 'new') {
	$rec['first_name'] = '';
	$rec['last_name'] = '';
	$rec['dob'] = '';
	$rec['gender'] = '';
	$rec['email'] = '';
	$rec['id'] = -1;
	showStudentForm($rec);
	showHomePage();

} else if ($task == 'edit') {
	$student_id = $_REQUEST['id'];
	$rs = getStudent($student_id, $rec);
	if ($rs) {
		showStudentForm($rec);
	}
	showHomePage();
} else if ($task == 'save') {
	//print_r($_POST);
	$rec['first_name'] = $_POST['first_name'];
	$rec['last_name'] = $_POST['last_name'];
	$rec['dob'] = $_POST['dob'];
	$rec['gender'] = $_POST['gender'];
	$rec['email'] = $_POST['email'];
	$rec['id'] = $_POST['id'];
	if ($rec['id'] > 0)
		$rs = updateStudent($rec);
	else
		$rs = saveStudent($rec);
	if ($rs) {
		showMessage("Saved Successfully...!");
	} else {
		ShowError("Couldn't Save");
	}
	showHomePage();



} else if ($task == 'remove') {
	$student_id = $_REQUEST['id'];
	$rs = removeStudent($student_id);
	if ($rs) {
		showMessage("Removed Successfully...!");
	} else {
		ShowError ("Delete Failed");
	}
	showHomePage();
} else if ($task == 'delete') {
	$student_id = $_REQUEST['id'];
	$rs = deleteMultipleStudent($student_id);
	if ($rs) {
		showMessage("Removed Successfully...!");
	} else {
		ShowError ("Delete Failed");
	}
	showHomePage();
}else {
	//Default task

	$students = '';
	$status = getStudents($students);
	if ($status)
		printStudents($students);
}


?>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/jquery.dataTables.min.js"></script>

<!--datatable -->
<script type="text/javascript">
	$('#datatable').DataTable({});
	</script> 
<!-- checkbox select all  -->
<script type="text/javascript">
$('#checkAll').click(function(e){
    var table= $(e.target).closest('table');
    $('td input:checkbox',table).attr('checked',e.target.checked);
});
</script>

<!--checkbox delete -->
<script type="text/javascript">
$(document).ready(function(){
	$(document).on("click", "#btnDelete", function() {
		if (confirm("Are you sure ?")) {
			console.log("here")
			let id = []
			for (let index = 0; index < $(".checkItem").length; index++) {
				if ($($(".checkItem")[index])[0].checked) {
					id.push($($(".checkItem")[index]).attr("value"))
				}
			} 
			$("#txtId").val(id.toString())
			$("#deleteForm").submit();
		}
	});
});



</script>
</body>

</html>
