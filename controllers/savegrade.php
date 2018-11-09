<?php
	include_once("../controllers/common.php");
	include_once("../models/grade.php");
	Database::connect('school', 'root', '');
	$id = safeGet("id", 0);
	if($id==0) {
		grade::add($_POST['student_id'] , $_POST['course_id'] , $_POST['degree'] , $_POST['examined_at']);
	} else {
		$grade = new grade($id);
		$grade->student_id = safeGet("student_id");
		$grade->course_id = safeGet("course_id");
		$grade->degree = safeGet("degree");
		$grade->examined_at = safeGet("examined_at");
		$grade->save();
	}
	header('Location: ../grades.php');
?>
