<header class="ec-header">
  <!--Ec Header Top Start -->
  <div class="header-top">
    <div class="container">
      <div class="row align-items-center">
        <!-- Header Top phone Start -->
        <div class="col header-top-left">
          <div class="header-top-call">
            <img src="assets/images/icons/top-call.svg" class="svg_img top_svg" alt="" /> Phone:
            <a href="tel:+48735527287"> +1 752 01 327 9</a>
          </div>
        </div>
        <!-- Header Top phone End -->
        <!-- Header Top call Start -->
        <div class="col header-top-center">
          <div class="header-top-call">
            Order online or call us (+1) 752 013279
          </div>
        </div>
        <!-- Header Top call End -->
        <!-- Header Top Language Currency -->
        <div class="col header-top-right d-none d-lg-block">
          <div class="header-top-right-inner d-flex justify-content-end">
            <!-- Currency Start -->
            <div class="header-top-lan-curr header-top-curr dropdown">
              <button class="dropdown-toggle" data-bs-toggle="dropdown">USD <i
                class="ecicon eci-angle-down" aria-hidden="true"></i>
              </button>
              <ul class="dropdown-menu">
                <li class="active"><a class="dropdown-item" href="#">USD $</a></li>
                <li><a class="dropdown-item" href="#">EUR €</a></li>
              </ul>
            </div>
            <!-- Currency End -->
            <!-- Language Start -->
            <div class="header-top-lan-curr header-top-lan dropdown">
              <button class="dropdown-toggle" data-bs-toggle="dropdown">ENG <i
                class="ecicon eci-angle-down" aria-hidden="true"></i>
              </button>
              <ul class="dropdown-menu">
                <li class="active"><a class="dropdown-item" href="#">English</a>
                </li>
                <li><a class="dropdown-item" href="#">French</a>
                </li>
              </ul>
            </div>
            <!-- Language End -->
            <!-- Social Start -->
            <div class="header-top-social">
              <ul class="mb-0">
                <li class="list-inline-item"><a href="#"><i class="ecicon eci-facebook"></i></a>
                </li>
                <li class="list-inline-item"><a href="#"><i class="ecicon eci-twitter"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="ecicon eci-instagram"></i></a>
                </li>
                <li class="list-inline-item"><a href="#"><i class="ecicon eci-linkedin"></i></a>
                </li>
              </ul>
            </div>
            <!-- Social End -->
          </div>
        </div>
        <!-- Header Top Language Currency -->
        <!-- Header Top responsive Action -->
        <div class="col header-top-res d-lg-none">
          <div class="ec-header-bottons">
            <!-- Header User Start -->
            <div class="ec-header-user dropdown">
              <button class="dropdown-toggle" data-bs-toggle="dropdown"><img
                src="assets/images/icons/user.svg" class="svg_img header_svg"
                alt="" />
              </button>
              <ul class="dropdown-menu dropdown-menu-right">
                <li><a class="dropdown-item" href="user-profile.php">My account</a></li>
                <li><a class="dropdown-item" href="register.php">Register</a></li>
                <li><a class="dropdown-item" href="checkout.php">Checkout</a></li>
                <?php if(strlen($_SESSION['login'])==0)
                {   ?>
                  <li><a class="dropdown-item" href="login.php">Login</a></li>
                <?php }
                else{ ?>
                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                  <?php

                } ?> 

              </ul>
            </div>
            <!-- Header User End -->
            <!-- Header Cart Start -->
            <a href="wishlist.php" class="ec-header-btn ec-header-wishlist">
              <div class="header-icon">
                <img src="assets/images/icons/wishlist.svg"
                class="svg_img header_svg" alt="" />
              </div>
              <?php
              if(strlen($_SESSION['login'])==0)
              {   
                ?>
                <span class="ec-header-count ec-wishlist-count">0</span>
                <?php
              }
              else{
                $ret=mysqli_query($con,"select count(userId) as total  from wishlist where userId='".$_SESSION['id']."'");
                $num=mysqli_fetch_array($ret);
                $count=$num['total'];
                ?>
                <span class="ec-header-count ec-wishlist-count"><?php echo $count?></span>
                <?php
              }?>
            </a>
            <!-- Header Cart End -->
            <!-- Header Cart Start -->
            <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
              <div class="header-icon">
                <img src="assets/images/icons/pro_cart.svg"
                class="svg_img header_svg" alt="" />
              </div>
              <?php
              if(!empty($_SESSION['cart']))
              {
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
                  }
                }
                ?>
                <span class="ec-header-count ec-cart-count"><?php echo $_SESSION['qnty'];?></span>
                <?php
              }else{?>
                <span class="ec-header-count ec-cart-count">0</span>
                <?php
              }
              ?>
            </a>
            <!-- Header Cart End -->
            <!-- Header menu Start -->
            <a href="#ec-mobile-menu" class="ec-header-btn ec-side-toggle ec-d-l d-lg-none">
              <i class="ecicon eci-bars"></i>
            </a>
            <!-- Header menu End -->
          </div>
        </div>
        <!-- Header Top responsive Action -->
      </div>
    </div>
  </div>
  <!-- Ec Header Top  End -->
  <!-- Ec Header Bottom  Start -->
  <div class="ec-header-bottom d-none d-lg-block">
    <div class="container position-relative">
      <div class="row">
        <div class="header-bottom-flex">
          <!-- Ec Header Logo Start -->
          <div class="align-self-center ec-header-logo ">
            <div class="header-logo">
              <a href="index.php">
                <img src="assets/images/logo/logo-11.png"
                alt="Site Logo" />
              </a>
            </div>
          </div>
          <!-- Ec Header Logo End -->

          <!-- Ec Header Search Start -->
          <div class="align-self-center ec-header-search">
            <div class="header-search">
              <form class="ec-search-group-form" action="#">
                <div class="ec-search-select-inner">
                  <select name="ec-search-cat">
                    <option selected disabled>All</option>
                    <option value="Laptops">Laptops</option>
                    <option value="Phones">Phones</option>
                    <option value="Desktops">Desktops</option>
                  </select>
                </div>
                <input class="form-control" placeholder="I’m searching for..." type="text">
                <button class="search_submit" type="submit">Search 
                  <img
                  src="assets/images/icons/search.svg" class="svg_img search_svg"
                  alt="" />
                </button>
              </form>
            </div>
          </div>
          <!-- Ec Header Search End -->

          <!-- Ec Header Button Start -->
          <div class="align-self-center ec-header-cart">
            <div class="ec-header-bottons">
              <!-- Header User Start -->
              <div class="ec-header-user dropdown">
                <button class="dropdown-toggle" data-bs-toggle="dropdown">
                  <img src="assets/images/icons/user.svg" class="svg_img header_svg"
                  alt="" />
                  <span class="ec-btn-title">Account</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a class="dropdown-item" href="user-profile.php">My account</a></li>
                  <li><a class="dropdown-item" href="register.php">Register</a></li>
                  <li><a class="dropdown-item" href="checkout.html">Checkout</a></li>
                  <?php if(strlen($_SESSION['login'])==0)
                  {   ?>
                    <li><a class="dropdown-item" href="login.php">Login</a></li>
                  <?php }
                  else{ ?>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    <?php

                  } ?> 
                </ul>
              </div>
              <!-- Header User End -->
              <!-- Header wishlist Start -->
              <a href="wishlist.php" class="ec-header-btn ec-header-wishlist">
                <div class="header-icon">
                  <img src="assets/images/icons/wishlist.svg"
                  class="svg_img header_svg" alt="" />
                </div>
                <?php
                if(strlen($_SESSION['login'])==0)
                {   
                  ?>
                  <span class="ec-header-count ec-cart-wishlist">0</span>
                  <?php
                }
                else{
                  $ret=mysqli_query($con,"select count(userId) as total  from wishlist where userId='".$_SESSION['id']."'");
                  $num=mysqli_fetch_array($ret);
                  $count=$num['total'];
                  ?>
                  <span class="ec-header-count ec-cart-wishlist"><?php echo $count?></span>
                  <?php
                }?>
                <span class="ec-btn-title">wishlist</span>
              </a>
              <!-- Header wishlist End -->
              <!-- Header Cart Start -->
              <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
                <div class="header-icon">
                  <img src="assets/images/icons/cart.svg"
                  class="svg_img header_svg" alt="" />
                </div>
                <?php
                if(!empty($_SESSION['cart']))
                {

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
                    }
                  }
                  
                  ?>
                  <span class="ec-header-count ec-cart-count"><?php echo $_SESSION['qnty'];?></span>
                  <?php
                }else{?>
                  <span class="ec-header-count ec-cart-count">0</span>
                  <?php
                }
                ?>
                <span class="ec-btn-title">In
                Cart</span>
              </a>
              <!-- Header Cart End -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Ec Header Button End -->
  <!-- Header responsive Bottom  Start -->
  <div class="ec-header-bottom d-lg-none">
    <div class="container position-relative">
      <div class="row ">
        <!-- Ec Header Logo Start -->
        <div class="col">
          <div class="header-logo">
            <a href="index.php">
              <img src="assets/images/logo/logo-10.png" alt="Site Logo" />
            </a>
          </div>
        </div>
        <!-- Ec Header Logo End -->
        <!-- Ec Header Search Start -->
        <div class="col align-self-center ec-header-search">
          <div class="header-search">
            <form class="ec-search-group-form" action="#">
              <div class="ec-search-select-inner">
                <select name="ec-search-cat">
                  <option selected disabled>All</option>
                  <option value="Laptops & Bags">Laptops & Bags</option>
                  <option value="Smart Phones">Smart Phones</option>
                  <option value="Desktops">Desktops</option>
                </select>
              </div>
              <input class="form-control" placeholder="I’m searching for..." type="text">
              <button class="search_submit" type="submit">
                <img
                src="assets/images/icons/search.svg" class="svg_img search_svg"
                alt="" />
              </button>
            </form>
          </div>
        </div>
        <!-- Ec Header Search End -->
      </div>
    </div>
  </div>
  <!-- Header responsive Bottom  End -->
  <!-- EC Main Menu Start -->
  <div id="ec-main-menu-desk" class="sticky-nav">
    <div class="container position-relative">
      <div class="row">
        <div class="col-sm-2 ec-category-block">
          <div class="ec-category-menu">
            <div class="ec-category-toggle">
              <span class="ec-category-title">Categories</span>
              <i class="ecicon eci-angle-down" aria-hidden="true"></i>
            </div>
            <div class="ec-category-content">
              <div id="ec-category-menu" class="ec-category-menu">
                <ul class="ec-category-wrapper">
                  <li>
                    <a title="" class="ec-cat-menu-link" href="product.php?pid=62">
                      <img src="assets/images/icons/laptops.svg" class="svg_img pro_svg" alt="" />Laptops
                    </a>
                  </li>
                  <li>
                    <a title="" class="ec-cat-menu-link" href="product.php?pid=68">
                      <img src="assets/images/icons/smartphone.svg" class="svg_img pro_svg" alt="" />Smart phones
                    </a>
                  </li>
                  <li>
                    <a title="" class="ec-cat-menu-link" href="#">
                      <img src="assets/images/icons/bag.svg" class="svg_img pro_svg" alt="" />Laptop Bags
                    </a>
                  </li>
                  <li>
                    <a title="" class="ec-cat-menu-link" href="product.php?pid=66">
                      <img src="assets/images/icons/printer.svg" class="svg_img pro_svg" alt="" />Printers
                    </a>
                  </li>
                  <li>
                    <a title="" class="ec-cat-menu-link" href="product.php?pid=79">
                      <img src="assets/images/icons/tablets.svg" class="svg_img pro_svg" alt="" />Tablets
                    </a>
                  </li>
                  <li>
                    <a title="" class="ec-cat-menu-link" href="product.php?pid=77">
                      <img src="assets/images/icons/headphones.svg" class="svg_img pro_svg" alt="" />Headsets
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-10 ec-main-menu-block align-self-center d-none d-lg-block">
          <div class="ec-main-menu">
            <ul>
              <li><a href="index.php">Home</a></li>
              <li class="dropdown position-static"><a href="javascript:void(0)">Categories</a>
                <ul class="mega-menu d-block">
                  <li class="d-flex">
                    <ul class="d-block">
                      <li class="menu_title"><a href="javascript:void(0)">Laptops</a></li>
                      <?php
                      $ret2=mysqli_query($con,"select * from tblproducts where CategoryName='60' order by rand() limit 4");
                      while ($row2=mysqli_fetch_array($ret2)) 
                      {
                        ?>
                        <li><a href="product.php?pid=<?php echo htmlentities($row2['id']);?>"><?php echo substr($row2['ProductName'],0,25);?></a>
                        </li>
                        <?php
                      }?>
                    </ul>
                    <ul class="d-block">
                      <li class="menu_title"><a href="javascript:void(0)">Phones</a></li>
                      <?php
                      $ret3=mysqli_query($con,"select * from tblproducts where CategoryName='57' order by rand() limit 4");
                      while ($row3=mysqli_fetch_array($ret3)) 
                      {
                        ?>
                        <li><a href="product.php?pid=<?php echo htmlentities($row3['id']);?>"><?php echo substr($row3['ProductName'],0,25);?></a></li>
                        <?php
                      }?>
                    </ul>
                    <ul class="d-block">
                      <li class="menu_title"><a href="javascript:void(0)">Desktops & Laptop Bags</a></li>
                      <?php
                      $ret4=mysqli_query($con,"select * from tblproducts where CategoryName='72' order by rand() limit 4");
                      while ($row4=mysqli_fetch_array($ret4)) 
                      {
                        ?>
                        <li><a href="product.php?pid=<?php echo htmlentities($row4['id']);?>"><?php echo substr($row4['ProductName'],0,25);?></a></li>
                        <?php
                      }?>
                    </ul>
                    <ul class="d-block">
                      <li class="menu_title"><a href="javascript:void(0)">Printers & Headsets</a>
                      </li>
                      <?php
                      $ret5=mysqli_query($con,"select * from tblproducts where CategoryName='61' || CategoryName='17' order by rand() limit 4");
                      while ($row5=mysqli_fetch_array($ret5)) 
                      {
                        ?>
                        <li><a href="product.php?pid=<?php echo htmlentities($row5['id']);?>"><?php echo substr($row5['ProductName'],0,25);?></a></li>
                        <?php
                      }?>
                    </ul>
                  </li>
                  <li>
                    <ul class="ec-main-banner w-100">
                      <li><a class="p-0" href="product.php?pid=62"><img
                        class="img-responsive"
                        src="assets/images/menu-banner/21.jpg" alt=""></a>
                      </li>
                      <li><a class="p-0" href="product.php?pid=81"><img
                        class="img-responsive"
                        src="assets/images/menu-banner/22.jpg" alt=""></a>
                      </li>
                      <li><a class="p-0" href="#"><img
                        class="img-responsive"
                        src="assets/images/menu-banner/24.jpg" alt=""></a>
                      </li>
                      <li><a class="p-0" href="product.php?pid=66"><img
                        class="img-responsive"
                        src="assets/images/menu-banner/23.jpg" alt=""></a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="dropdown"><a href="javascript:void(0)">Products</a>
                <ul class="sub-menu">
                  <?php
                  $ret=mysqli_query($con,"select * from tblproducts order by rand() limit 6");
                  while ($row=mysqli_fetch_array($ret)) 
                  {
                    ?>
                    <li><a href="product.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo substr($row['ProductName'],0,30);?></a></li>
                    <?php
                  }?>

                </ul>
              </li>
              <li><a href="#">Hot Offers</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Ec Main Menu End -->
  <!-- shop Menu Start -->
  <div class="ec-mobile-menu-overlay"></div>
  <div id="ec-mobile-menu" class="ec-side-cart ec-mobile-menu">
    <div class="ec-menu-title">
      <span class="menu_title">My Menu</span>
      <button class="ec-close">×</button>
    </div>
    <div class="ec-menu-inner">
      <div class="ec-menu-content">
        <ul>
          <li><a href="index.php">Home</a></li>

          <li><a href="javascript:void(0)">Categories</a>
            <ul class="sub-menu">
              <li>
                <a href="javascript:void(0)">Laptops</a>
                <ul class="sub-menu">
                  <?php
                  $ret6=mysqli_query($con,"select * from tblproducts where CategoryName='60' order by rand() limit 4");
                  while ($row6=mysqli_fetch_array($ret6)) 
                  {
                    ?>
                    <li><a href="product.php?pid=<?php echo htmlentities($row6['id']);?>"><?php echo substr($row6['ProductName'],0,25);?></a>
                    </li>
                    <?php
                  }?>
                </ul>
              </li>
              <li>
                <a href="javascript:void(0)">Phones</a>
                <ul class="sub-menu">
                  <?php
                  $ret7=mysqli_query($con,"select * from tblproducts where CategoryName='57' order by rand() limit 4");
                  while ($row7=mysqli_fetch_array($ret7)) 
                  {
                    ?>
                    <li><a href="product.php?pid=<?php echo htmlentities($row7['id']);?>"><?php echo substr($row7['ProductName'],0,25);?></a></li>
                    <?php
                  }?>
                </ul>
              </li>
              <li>
                <a href="javascript:void(0)">Desktops & Laptop Bags</a>
                <ul class="sub-menu">
                  <?php
                  $ret8=mysqli_query($con,"select * from tblproducts where CategoryName='72' order by rand() limit 4");
                  while ($row8=mysqli_fetch_array($ret8)) 
                  {
                    ?>
                    <li><a href="product.php?pid=<?php echo htmlentities($row8['id']);?>"><?php echo substr($row8['ProductName'],0,25);?></a></li>
                    <?php
                  }?>
                </ul>
              </li>
              <li>
                <a href="javascript:void(0)">Printers & Tablets</a>
                <ul class="sub-menu">
                  <?php
                  $ret9=mysqli_query($con,"select * from tblproducts where CategoryName='61' || CategoryName='17' order by rand() limit 4");
                  while ($row9=mysqli_fetch_array($ret9)) 
                  {
                    ?>
                    <li><a href="product.php?pid=<?php echo htmlentities($row9['id']);?>"><?php echo substr($row9['ProductName'],0,25);?></a></li>
                    <?php
                  }?>
                </ul>
              </li>
              <li><a class="p-0" href="shop-left-sidebar-col-3.html"><img class="img-responsive"
                src="assets/images/menu-banner/1.jpg" alt=""></a>
              </li>
            </ul>
          </li>
          <li><a href="javascript:void(0)">Products</a>
            <ul class="sub-menu">

              <?php
              $ret1=mysqli_query($con,"select * from tblproducts order by rand() limit 6");
              while ($row1=mysqli_fetch_array($ret1)) 
              {
                ?>
                <li><a href="product.php?pid=<?php echo htmlentities($row1['id']);?>"><?php echo substr($row1['ProductName'],0,30);?></a></li>
                <?php
              }?>
            </ul>
          </li>
          <li><a href="#">Hot Offers</a></li>
        </ul>
      </div>
      <div class="header-res-lan-curr">
        <div class="header-top-lan-curr">
          <!-- Language Start -->
          <div class="header-top-lan dropdown">
            <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">Language <i
              class="ecicon eci-caret-down" aria-hidden="true"></i>
            </button>
            <ul class="dropdown-menu">
              <li class="active"><a class="dropdown-item" href="#">English</a></li>
              <li><a class="dropdown-item" href="#">French</a></li>
            </ul>
          </div>
          <!-- Language End -->
          <!-- Currency Start -->
          <div class="header-top-curr dropdown">
            <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">Currency <i
              class="ecicon eci-caret-down" aria-hidden="true"></i>
            </button>
            <ul class="dropdown-menu">
              <li class="active"><a class="dropdown-item" href="#">USD $</a></li>
              <li><a class="dropdown-item" href="#">EUR €</a></li>
            </ul>
          </div>
          <!-- Currency End -->
        </div>
        <!-- Social Start -->
        <div class="header-res-social">
          <div class="header-top-social">
            <ul class="mb-0">
              <li class="list-inline-item"><a href="#"><i class="ecicon eci-facebook"></i></a></li>
              <li class="list-inline-item"><a href="#"><i class="ecicon eci-twitter"></i></a></li>
              <li class="list-inline-item"><a href="#"><i class="ecicon eci-instagram"></i></a></li>
              <li class="list-inline-item"><a href="#"><i class="ecicon eci-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
        <!-- Social End -->
      </div>
    </div>
  </div>
  <!-- shop Menu End -->
</header>