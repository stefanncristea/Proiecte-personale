<style type="text/css">
  #form_status span {
  color: #fff;
  font-size: 14px;
  font-weight: normal;
  background: #E74C3C;
  width: 100%;
  text-align: center;
  display: inline-block;
  padding: 10px 0px;
  border-radius: 3px;
  margin-bottom: 18px;
}

#form_status span.loading {
  color: #333;
  background: #eee;
  border-radius: 3px;
  padding: 18px 0px;
}

</style>
<footer class="ec-footer">
  <div class="footer-container">
    <div class="footer-top section-space-footer-p">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-lg-3 ec-footer-contact">
            <div class="ec-footer-widget">
              <div class="ec-footer-logo"><a href="javascript:void(0)"><img
                src="assets/images/logo/logo-10.png" alt="">
              </div>
              <h4 class="ec-footer-heading">Location</h4>
              <div class="ec-footer-links">
                <ul class="align-items-center">
                  <li class="ec-footer-link">12 Plainfield Guilford, Township
                  IN, USA</li>
                </ul>
                <div class="col-sm-12 col-lg-3 ec-footer-social">
                  <div class="ec-footer-widget">
                    <div class="ec-footer-links">
                      <ul class="align-items-center">
                        <li class="list-inline-item"><a href="#"><i class="ecicon eci-facebook"></i></a>
                        </li>
                        <li class="list-inline-item"><a href="#"><i class="ecicon eci-twitter"></i></a>
                        </li>
                        <li class="list-inline-item"><a href="#"><i
                          class="ecicon eci-instagram"></i></a>
                        </li>
                        <li class="list-inline-item"><a href="#"><i class="ecicon eci-linkedin"></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-lg-3 ec-footer-news">
            <div class="ec-footer-widget">
              <h4 class="ec-footer-heading">Newsletter</h4>
              <div class="ec-footer-links">
                <ul class="align-items-center">
                  <li class="ec-footer-link">Get instant updates about our new products and
                  special promos!</li>
                </ul>
                <div class="ec-subscribe-form">
                  <div id="form_status"></div>
                  <form  method="post" id="subscribe-form" onSubmit="return valid_datas( this );" enctype="multipart/form-data">
                  <div id="ec_news_signup" class="ec-form">
                    <input class="ec-email" type="email" 
                    placeholder="Enter your email here..." name="email" id="email" value="" />
                    <button  class="button btn-secondary" type="submit" name="subscribe" value=""><i class="ecicon eci-paper-plane-o" aria-hidden="true"></i>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-lg-2 ec-footer-account">
          <div class="ec-footer-widget">
            <h4 class="ec-footer-heading">Account</h4>
            <div class="ec-footer-links">
              <ul class="align-items-center">
                <li class="ec-footer-link"><a href="user-profile.php">My Account</a></li>
                <li class="ec-footer-link"><a href="user-history.php">Order History</a></li>
                <li class="ec-footer-link"><a href="wishlist.php">Wish List</a></li>
                <li class="ec-footer-link"><a href="product.php?pid=70">Specials</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-lg-2 ec-footer-service">
          <div class="ec-footer-widget">
            <h4 class="ec-footer-heading">Services</h4>
            <div class="ec-footer-links">
              <ul class="align-items-center">
                <li class="ec-footer-link"><a href="#">Discount Returns</a></li>
                <li class="ec-footer-link"><a href="#">Policy & policy </a>
                </li>
                <li class="ec-footer-link"><a href="#">Customer Service</a></li>
                <li class="ec-footer-link"><a href="#">Term & condition</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-lg-2 ec-footer-info">
          <div class="ec-footer-widget">
            <h4 class="ec-footer-heading">Information</h4>
            <div class="ec-footer-links">
              <ul class="align-items-center">
                <li class="ec-footer-link"><a href="#">About us</a></li>
                <li class="ec-footer-link"><a href="#">FAQ</a></li>
                <li class="ec-footer-link"><a href="user-history.php">Delivery Information</a>
                </li>
                <li class="ec-footer-link"><a href="contactus.php">Contact us</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row align-items-center">
        <!-- Footer Copyright Start -->
        <div class="col footer-copy">
          <div class="footer-bottom-copy ">
            <div class="ec-copy">Copyright © 2022 <a class="site-name text-upper"
              href="index.php">Code4berry</a>. All Rights Reserved</div>
            </div>
          </div>
          <!-- Footer Copyright End -->
          <!-- Footer payment -->
          <div class="col footer-bottom-right">
            <div class="footer-bottom-payment d-flex justify-content-end">
              <div class="payment-link">
                <img src="assets/images/icons/payment.png" alt="">
              </div>

            </div>
          </div>
          <!-- Footer payment -->
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- SweetAlert2 -->

<script src="assets/js/form-validate.js"></script>
