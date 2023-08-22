<?php
	include "resources/initiate.php";
	$title = "Johnny's Liquor";
	$style = "styles/home.css";
	include "components/header.php";
?>

			<div class="banner">
				<img src="images/banner.jpg" alt="Bar" class="banner-image">
				<img src="images/logo.png" alt="Jonny's Liquor" id="banner-logo">
				<p id="banner-text">Jonny's Liquor is dedicated to bringing you the best the West has to offer, with a great selection of bourbons, rye-whiskies, gins, tequilas and more.</p>
				
			</div>
			<h1>Latest Products</h1>
<?php
	//RETRIEVES 4 RECENT PRODUCTS FROM DIFFERENT CATEGORIES
	$sql = "SELECT * FROM product WHERE created IN (select MAX(created) FROM product GROUP BY drink) LIMIT 4";
	$page=mysqli_query($db, $sql);
	while ($row=mysqli_fetch_assoc($page)) { 
		echo product_thumb($row);
	}


?>

<?php include "components/footer.php"; ?>