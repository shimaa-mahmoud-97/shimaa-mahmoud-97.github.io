<?php
	include_once("../controllers/common.php");
	include_once("../models/course.php");
	Database::connect('school', 'root', '');
	$id = safeGet("id", 0);
	if($id==0) {
		course::add($_POST['Name'] , $_POST['max_degree'] , $_POST['study_year'] );
	} else {
		$course = new course($id);
		$course->name = safeGet("Name");
		$course->max_degree = safeGet("max_degree");
		$course->study_year = safeGet("study_year");
		$course->save();
	}
	header('Location: ../courses.php');
?>