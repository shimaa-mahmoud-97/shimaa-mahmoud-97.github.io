<?php 
	include_once("./controllers/common.php");
	include_once('./components/head.php');
	include_once('./models/course.php');
	$id = safeGet('id');
	Database::connect('school', 'root', '');
	$course = new course($id);
?>

    <h2 class="mt-4"><?=($id)?"Edit":"Add"?> course</h2>

    <form action="controllers/savecourse.php" method="post">
    	<input type="hidden" name="id" value="<?=$course->get('id')?>">
		<div class="card">
			<div class="card-body">
				<div class="form-group row gutters">
					<label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="name" value="<?=$course->get('Name')?>" required>
					</div>

					<label for="inputEmail3" class="col-sm-2 col-form-label">Max Degree</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="max_degree" value="<?=$course->get('max_degree')?>" required>
					</div>

					<label for="inputEmail3" class="col-sm-2 col-form-label">Study Year</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="study_year" value="<?=$course->get('study_year')?>" required>
					</div>

				</div>
		    	<div class="form-group">
		    		<button class="button float-right" type="submit">Add</button>
		    	</div>
		    </div>
		</div>
    </form>

<?php include_once('./components/tail.php') ?>