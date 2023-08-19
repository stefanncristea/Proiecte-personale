<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(strlen($_SESSION['odmsaid'])==0)
{	
	header('location:index.php');
}

?>
<form method="post" id="brand-form"  enctype="multipart/form-data">
	<div id="form_status"></div>
	<?php
	$pid= $_POST['edit_id5'];
	$sql="SELECT * from productreviews where id=:pid ";
	$query2 = $dbh -> prepare($sql);
	$query2-> bindParam(':pid', $pid, PDO::PARAM_STR);
	$query2->execute();
	$results2=$query2->fetchAll(PDO::FETCH_OBJ);
	if($query2->rowCount() > 0)
	{
		foreach($results2 as $row2)
		{ 
			?>
			<div class="row mb-2">

				<div class="col-lg-12">
					<div class="form-group">
						<label for="brandName">Review</label>
						<textarea class="form-control"  class="form-control" name="review" rows="4" readonly><?php  echo $row2->review;?></textarea>
					</div>
				</div>
				
			</div>
			<div class="modal-footer px-4">
				<button type="button" class="btn btn-secondary btn-pill"
				data-bs-dismiss="modal">Cancel</button>
			</div>
			<?php 
		}
	} ?>
</form>