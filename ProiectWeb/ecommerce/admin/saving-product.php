<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(strlen($_SESSION['odmsaid'])==0)
{	
	header('location:index.php');
}
if(isset($_POST['submit']))
{

	if( empty( $_POST['token'] ) ){
		echo '<span class="notice">Error!</span>';
		exit;
	}
	if( $_POST['token'] != 'FsWga4&@f6aw' ){
		echo '<span class="notice">Error!</span>';
		exit;
	}
	$category=$_POST['category'];
	$product=$_POST['product'];
	$brand=$_POST['brand'];
	$discount=$_POST['discount'];
	$subcategory=$_POST['subcategory'];
	$price1=$_POST['price1'];
	$price2=$_POST['price2'];
	$group_tag=$_POST['group_tag'];
	$details=$_POST['details'];
	$description=$_POST['description'];
	$image=$_FILES["imageUpload"]["name"];
	move_uploaded_file($_FILES["imageUpload"]["tmp_name"],"productimages/".$_FILES["imageUpload"]["name"]);
	$sql="insert into tblproducts(CategoryName,ProductName,ProductPrice,PriceBefore,productDetails,productDescription,Grouptag,BrandName,ProductDiscount,Subcategory,ProductImage)values(:category,:product,:price1,:price2,:details,:description,:group_tag,:brand,:discount,:subcategory,:image)";
	$query=$dbh->prepare($sql);
	$query->bindParam(':category',$category,PDO::PARAM_STR);
	$query->bindParam(':product',$product,PDO::PARAM_STR);
	$query->bindParam(':brand',$brand,PDO::PARAM_STR);
	$query->bindParam(':discount',$discount,PDO::PARAM_STR);
	$query->bindParam(':subcategory',$subcategory,PDO::PARAM_STR);
	$query->bindParam(':image',$image,PDO::PARAM_STR);
	$query->bindParam(':price1',$price1,PDO::PARAM_STR);
	$query->bindParam(':price2',$price2,PDO::PARAM_STR);
	$query->bindParam(':details',$details,PDO::PARAM_STR);
	$query->bindParam(':description',$description,PDO::PARAM_STR);
	$query->bindParam(':group_tag',$group_tag,PDO::PARAM_STR);

	$query->execute();
	$LastInsertId=$dbh->lastInsertId();
	if ($LastInsertId>0) 
	{
		?>
		<script >
			swal.fire({
				'title': 'Thank you',
				'text': 'Saved successfuly',
				'icon': 'success',
				'type': 'success'
			}).then( () => {
				location.href = 'product-add.php'
			})
		</script>
		<?php
	}
	else
	{
		echo '<script>alert("Something Went Wrong. Please try again")</script>';
	}
}
?>