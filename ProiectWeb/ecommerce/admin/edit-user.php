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
	$uid= $_POST['edit_id5'];
	$sql="SELECT * from tbladmin where id=:uid ";
	$query2 = $dbh -> prepare($sql);
	$query2-> bindParam(':uid', $uid, PDO::PARAM_STR);
	$query2->execute();
	$results2=$query2->fetchAll(PDO::FETCH_OBJ);
	if($query2->rowCount() > 0)
	{
		foreach($results2 as $row2)
		{ 
			$_SESSION['editpid']=$row2->id;
			?>
			<div class="row mb-2">

				<div class="col-lg-6">
					<div class="form-group">
						<label for="brandName">Frist Name</label>
						<input type="text" class="form-control" name="firstname" value="<?php  echo $row2->FirstName;?>" id="firstname">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="LastName">Last Name</label>
						<input type="text" class="form-control" value="<?php  echo $row2->LastName;?>"  name="lastname" id="lastname" >
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="brandName">Email</label>
						<input type="text" class="form-control" name="email" value="<?php  echo $row2->Email;?>" id="email">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="LastName">Mobile No.</label>
						<input type="text" class="form-control" value="<?php  echo $row2->MobileNumber;?>"  name="phone" id="phone" >
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