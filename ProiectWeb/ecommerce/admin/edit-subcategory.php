<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(strlen($_SESSION['odmsaid'])==0)
{	
	header('location:index.php');
}
if(isset($_POST['update']))
{
	$prid = $_SESSION['subcid'];
	$fulldescription = $_POST['fulldescription'];
	$category  = $_POST['category'];
	$subcategory = $_POST['subcategory'];
	$sql3="update subcategory set subcategory=:subcategory, Description=:fulldescription, categoryid=:category where id = '$prid' ";
	$query=$dbh->prepare($sql3);
	$query->bindParam(':subcategory',$subcategory,PDO::PARAM_STR);
	$query->bindParam(':category',$category,PDO::PARAM_STR);
	$query->bindParam(':fulldescription',$fulldescription,PDO::PARAM_STR);
	$query->execute();
	if ( $query->execute()) {
		echo '<script>alert("subcategory has been added.")</script>';
		echo "<script>window.location.href ='sub-category.php'</script>";
	}else{
		echo '<script>alert("Something Went Wrong. Please try again")</script>';

	}
}

?>
<form method="post" id="subcategory-form" >
	<div id="form_status"></div>
	<?php
	$pid= $_POST['edit_id5'];
	$sql="SELECT subcategory.subcategory,subcategory.id,subcategory.Description,tblcategory.CategoryName from subcategory join tblcategory on subcategory.categoryid=tblcategory.id  where subcategory.id=:pid ";
	$query2 = $dbh -> prepare($sql);
	$query2-> bindParam(':pid', $pid, PDO::PARAM_STR);
	$query2->execute();
	$results2=$query2->fetchAll(PDO::FETCH_OBJ);
	if($query2->rowCount() > 0)
	{
		foreach($results2 as $row2)
		{ 
			$_SESSION['subcid']=$row2->id;
			?>
			<div class="row mb-2">

				<div class="col-lg-6">
					<div class="form-group">
						<label for="brandName">Subcategory Name</label>
						<input type="text" class="form-control" name="subcategory" value="<?php  echo $row2->subcategory;?>" id="subcategory">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="brandName">Category</label>
						<select id="category" name="category" class="form-control">
							<option value="<?php  echo htmlentities($row2->id);?>"><?php  echo htmlentities($row2->CategoryName);?></option>
							<?php
							$sql="SELECT * from  tblcategory";
							$query = $dbh -> prepare($sql);
							$query->execute();
							$results=$query->fetchAll(PDO::FETCH_OBJ);
							if($query->rowCount() > 0)
							{
								foreach($results as $row)
								{
									?> 
									<option value="<?php  echo $row->id;?>"><?php  echo $row->CategoryName;?>

								</option>
								<?php 
							}
						} ?>
					</select>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label for="description">Description</label>
					<textarea id="fulldescription" name="fulldescription" cols="40" rows="4" class="form-control"><?php  echo $row2->Description;?></textarea>
				</div>
			</div>
			
			<input type="hidden" name="token" value="FsWga4&@f6aw" />

		</div>
		<div class="modal-footer px-4">
			<button type="button" class="btn btn-secondary btn-pill"
			data-bs-dismiss="modal">Cancel</button>
			<button type="submit" name="update" class="btn btn-primary btn-pill">Update</button>
		</div>
		<?php 
	}
} ?>
</form>