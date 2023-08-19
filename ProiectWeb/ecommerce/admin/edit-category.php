<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(strlen($_SESSION['odmsaid'])==0)
{	
	header('location:index.php');
}
if(isset($_POST['updatecategory']))
{
	$caid = $_SESSION['subcid'];
	$fulldescription = $_POST['fulldescription'];
	$category  = $_POST['category'];
	$sql3="update tblcategory set CategoryName=:category, Categorydescription=:fulldescription where id = '$caid' ";
	$query=$dbh->prepare($sql3);
	$query->bindParam(':category',$category,PDO::PARAM_STR);
	$query->bindParam(':fulldescription',$fulldescription,PDO::PARAM_STR);
	$query->execute();
	if ( $query->execute()) {
		echo '<script>alert("Category has been added.")</script>';
		echo "<script>window.location.href ='main-category.php'</script>";
	}else{
		echo '<script>alert("Something Went Wrong. Please try again")</script>';

	}
}

?>
<form method="post" id="subcategory-form" >
	<div id="form_status"></div>
	<?php
	$pid= $_POST['edit_id5'];
	$sql="SELECT * from tblcategory where id=:pid ";
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

				<div class="col-lg-12">
					<div class="form-group">
						<label for="brandName">Category Name</label>
						<input type="text" class="form-control" name="category" value="<?php  echo $row2->CategoryName;?>" id="subcategory">
					</div>
				</div>
				
				<div class="col-lg-12">
					<div class="form-group">
						<label for="description">Description</label>
						<textarea id="fulldescription" name="fulldescription" cols="40" rows="4" class="form-control"><?php  echo $row2->Categorydescription;?></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer px-4">
				<button type="button" class="btn btn-secondary btn-pill"
				data-bs-dismiss="modal">Cancel</button>
				<button type="submit" name="updatecategory" class="btn btn-primary btn-pill">Update</button>
			</div>
			<?php 
		}
	} ?>
</form>