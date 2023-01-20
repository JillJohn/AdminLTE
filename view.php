<html>
<link href="code.css" rel="stylesheet" type="text/css" />

<body>

	<?php
	
    //  error_reporting(E_ALL);
    //	ini_set('display_errors', '1');
	

	function showMessage($msg)
	{
		echo '<div class="alert alert-success">
 			  <strong>Success!</strong> ' . $msg . '
			  </div>';
	}

	function showError($msg)
	{
		echo '<div class="alert alert-danger">
	  	 	  <strong>Danger!</strong>' . $msg . '
	  	 	  </div>';

	}

	function showHeader()
	{
		echo '<br />';
	}
	function showHomePage()
	{
		echo '<br />';
		echo '<a href="student.php"><button type="back">Back</button></a>	';
	}
	?>

<div class="dropdown">
  <button class="dropbtn">Class</button>
  <div class="dropdown-content">
    <a href="#">I-STD</a>
    <a href="#">II-STD</a>
    <a href="#">III-STD</a>
    <a href="#">IV-STD</a>
    <a href="#">V-STD</a>
    <a href="#">VI-STD</a>
  </div>
</div>


	<?php

	function showStudentForm($rec)
	{

		echo '<form action="student.php?task=save" method="post" name="addform">';
		echo '<br>';
		echo '<label>First Name:</label> <input type="text" name="first_name" value="' . $rec['first_name'] . '" />';
		echo '<br>';
		echo '<label>Last Name:</label> <input type="text" name="last_name" value="' . $rec['last_name'] . '" />';
		echo '<br>';
		echo '<label>DOB:</label> <input type="text" placeholder="YYYY-MM-DD" name="dob" value="' . $rec['dob'] . '" />';
		echo '<br>';
		echo '<label for="gender">Gender</label>
		  <select name="gender" id="gender">
	  	  <option value="Male">Male</option>
	      <option value="Female">Female</option>
	      <option value="Others">Others</option>
	      </select>';
		echo '<br>';
		echo '<label>Email:</label> <input type="text" name="email" value="' . $rec['email'] . '" />';
		echo '<br>';
		echo '<input type="hidden" name="id" value="' . $rec['id'] . '" />';
		echo '<br>';
		echo '<button type="submit" name="submit" value="Save"> Save </button>';

		echo '</form>';

	}


	function printStudents($recs)
	{
		echo " ";
		echo " ";
				
		echo '<table id="datatable"  class="table table-bordered table-hover ">';
		echo '<thead ">';
		echo '<tr>
				<th>
				<form action="student.php?task=delete" method="post" id="deleteForm">
				<input type="hidden" name="id" id="txtId" value="">
				<button type="button" class="btn btn-danger" id="btnDelete">Delete</button>
				</form>
				</th>
			</tr>';	
		echo '<tr>
				<th><input type="checkbox" id="checkAll"></th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>DOB</th>
				<th>Age</th>
				<th>Gender</th>
				<th>Email</th>
				<th>Edit</th>
				<th>Delete</th>
				</tr>';
		echo '</thead>';
		echo "<tbody>";


		foreach ($recs as $rec) {
			echo "<tr>";
						echo "
							  <td><input type='checkbox' class='checkItem' value='" .$rec['id'] . "' name='id[]'></td>
							  <td>" . $rec['first_name'] . "</td>
							  <td>" . $rec['last_name'] . "</td>
							  <td>" . $rec['dob'] . "</td>
						      <td align='right'>" . $rec['age'] . "</td>
							  <td>" . $rec['gender'] . "</td>
						      <td>" . $rec['email'] . '</td>';

			echo '<div class = change>';
			echo '<td><a class="fa fa-edit green-color " href="student.php?task=edit&id=' . $rec['id'] . '"></a></td>';
			echo '<td><a class="bi bi-trash red-color" href="student.php?task=remove&id=' . $rec['id'] . '"></a></td>';
			echo '</div';
			echo "</tr>";

		}
		
		echo '</tbody>';
		echo "</table>";
		echo '';
		echo '';
		echo '<div class = addstudent>';

		echo '<a href="student.php?task=new">New Student</a>';
		echo '</div>';
		echo '';


	

	}

	?>




</body>
</html>
