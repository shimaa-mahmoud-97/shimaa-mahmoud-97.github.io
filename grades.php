<?php
	include_once('./controllers/common.php');
	include_once('./components/head.php');
	include_once('./models/grade.php');


	Database::connect('school', 'root', '');
?>
	<div style="padding: 10px 0px 20px 0px; vertical-align: text-bottom;">
		<span style="font-size: 125%;">GRADES</span>

		<p><p>
    <table class="table table-striped">
    	<thead>
	    	<tr>
	      		<th scope="col">ID</th>
	      		<th scope="col">student_id</th>
	      		<th scope="col">course_id</th>
	      		<th scope="col">degree</th>
	      		<th scope="col">examine_at</th>
	      		<th scope="col"></th>
	    	</tr>
	  	</thead>
	  	<tbody>
		  	<?php
				$grades = grade::all(safeGet('keywords'));
				foreach ($grades as $grade) {
			?>
    		<tr>
    			<td><?=$grade->id?></td>
    			<td><?=$grade->student_id?></td>
    			<td><?=$grade->course_id?></td>
				<td><?=$grade->degree?></td>
				<td><?=$grade->examine_at?></td>
    			<td>
    				<button class="button edit_degree" id="<?=$grade->id?>">Edit</button>&nbsp;
    				<button class="button delete_degree" id="<?=$grade->id?>">Delete</button>
				</td>
    		</tr>
    		<?php } ?>
    	</tbody>
    </table>

<?php include_once('./components/tail.php') ?>

<script type="text/javascript">
	$(document).ready(function() {
		$('.edit_degree').click(function(event) {
			window.location.href = "editgrades.php?id="+$(this).attr('id');
		});

		$('.delete_degree').click(function(){
			var anchor = $(this);
			$.ajax({
				url: './controllers/deletegrade.php',
				type: 'GET',
				dataType: 'json',
				data: {id: anchor.attr('id')},
			})
			.done(function(reponse) {
				if(reponse.status==1) {
					anchor.closest('tr').fadeOut('slow', function() {
						$(this).remove();
					});
				}
			})
			.fail(function() {
				alert("Connection error.");
			})
		});
	});
</script>
