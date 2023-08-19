<div class="ec-side-cart-overlay"></div>
<div id="ec-side-cart" class="ec-side-cart">
  <div class="ec-cart-inner">
    <div class="ec-cart-top">
      <div class="ec-cart-title">
        <span class="cart_title">My Cart</span>
        <button class="ec-close">×</button>
      </div>
      <ul class="eccart-pro-items">
        <?php
        if(!empty($_SESSION['cart'])){
        $sql = "SELECT * FROM tblproducts WHERE id IN(";
        foreach($_SESSION['cart'] as $id => $value){
          $sql .=$id. ",";
        }
        $sql=substr($sql,0,-1) . ") ORDER BY id ASC";
        $query = mysqli_query($con,$sql);
        $totalprice=0;
        $totalqunty=0;
        if(!empty($query)){
          while($row = mysqli_fetch_array($query))
          {
            $quantity=$_SESSION['cart'][$row['id']]['quantity'];
            $subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['ProductPrice'];
            $totalprice += $subtotal;
            $_SESSION['qnty']=$totalqunty+=$quantity;
            ?>
            <li>
              <a href="product.php?pid=<?php echo htmlentities($row['id']);?>" class="sidecart_pro_img"><img
                src="admin/productimages/<?php echo htmlentities($row['ProductImage']);?>" alt="product">
              </a>
              <div class="ec-pro-content">
                <a href="product.php?pid=<?php echo htmlentities($row['id']);?>" class="cart_pro_title"><?php echo $row['ProductName']; ?></a>
                <span class="cart-price"><span>$<?php echo htmlentities(number_format($row['ProductPrice'], 0, '.', ','));?></span> x <?php echo $_SESSION['cart'][$row['id']]['quantity']; ?></span>
                <div class="qty-plus-minus">
                  <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                </div>
                <a href="cart.php?action=remove&code=<?php echo $row['id']; ?>" class="remove">×</a>
              </div>
            </li>
            <?php
          }
        }else{?>
          <h4>Your cart is empty</h4>
          <?php
        }
      }else{?>
          <h4>Your cart is empty</h4>
          <?php
        }
        ?>
      </ul>
    </div>
    <div class="ec-cart-bottom">
      <div class="cart-sub-total">
        <table class="table cart-table">
          <tbody>
            <tr>
              <td class="text-left">Sub-Total :</td>
              <td class="text-right">$ &nbsp; <?php echo htmlentities(number_format($totalprice, 0, '.', ','));?></td>
            </tr>
            <tr>
              <td class="text-left">VAT (18%) :</td>
              <td class="text-right">$ &nbsp; <?php echo htmlentities(number_format(($totalprice*'0.18'), 0, '.', ','));?></td>
            </tr>
            <tr>
              <td class="text-left">Total :</td>
              <td class="text-right primary-color">$&nbsp; <?php echo htmlentities(number_format((($totalprice*'0.18')+$totalprice), 0, '.', ','));?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="cart_btn">
        <a href="cart.php" class="btn btn-primary">View Cart</a>
        <a href="checkout.php" class="btn btn-secondary">Checkout</a>
      </div>
    </div>
  </div>
</div>