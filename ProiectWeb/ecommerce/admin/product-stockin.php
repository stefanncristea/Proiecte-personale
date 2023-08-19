<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(strlen($_SESSION['odmsaid'])==0)
{	
	header('location:index.php');
}
if(isset($_POST['stockin']))
{
	$product = $_POST['product'];
	$sql3 ="select * from tblproducts where ProductName = '$product' ";
	$query3 = $dbh -> prepare($sql3);
	$query3->execute();
	$results3=$query3->fetchAll(PDO::FETCH_OBJ);
	if($query3->rowCount() > 0)
	{
		foreach($results3 as $row3)
		{ 
			$remaining = $row3->Quantity;
			$newquantity = $_POST['quantity'];
			$quantity2 = ($newquantity+$remaining);
			$price = $_POST['price'];
			$date  = $_POST['date'];
			$product = $_POST['product'];
			$sql3="update tblproducts set UpdationDate=:date, ProductPrice=:price, Quantity=:quantity2 where ProductName = '$product' ";
			$query=$dbh->prepare($sql3);
			$query->bindParam(':date',$date,PDO::PARAM_STR);
			$query->bindParam(':quantity2',$quantity2,PDO::PARAM_STR);
			$query->bindParam(':price',$price,PDO::PARAM_STR);
			$query->execute();
			if ( $query->execute()) {
				echo '<script>alert("Product has been stockedin.")</script>';
				echo "<script>window.location.href ='product-list.php'</script>";
			}else{
				echo '<script>alert("Something Went Wrong. Please try again")</script>';

			}
		}
	}
}
?>
<form method="post" id="brand-form"  enctype="multipart/form-data">
	<div id="form_status"></div>
	<?php
	$pid= $_POST['edit_id5'];
	$sql="SELECT * from tblproducts where id=:pid ";
	$query2 = $dbh -> prepare($sql);
	$query2-> bindParam(':pid', $pid, PDO::PARAM_STR);
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
						<label for="brandName">Product Name</label>
						<input type="text" class="form-control" name="product" value="<?php  echo $row2->ProductName;?>" id="productName" readonly>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="brandName">Quantity</label>
						<input type="text" class="form-control"  name="quantity" id="quantity" >
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="brandName">Product Price</label>
						<input type="text" class="form-control" value="<?php  echo $row2->ProductPrice;?>" name="price" id="price" >
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="brandName">Date</label>
						<input type="date" class="form-control" name="date" id="date" required>
					</div>
				</div>
				<input type="hidden" name="token" value="FsWga4&@f6aw" />

			</div>
			<div class="modal-footer px-4">
				<button type="button" class="btn btn-secondary btn-pill"
				data-bs-dismiss="modal">Cancel</button>
				<button type="submit" name="stockin" class="btn btn-primary btn-pill">Stock In</button>
			</div>
			<?php 
		}
	} ?>
</form>