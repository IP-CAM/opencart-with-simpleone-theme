


<div class="container pl-2 pr-2">
    <div class="row">
        <div class="col-md">
            <div class="jumbotron text-center">
                <h1>Get best deals coupons on whatsapp or email from the shop near you</h1> 
                
            </div>
            <h1>Best Deals</h1>
            <hr />
        </div>
    </div>
    
    <div class="row mb-2">
    <?php
    
    $i=1;
    foreach($couponsData as $coupon) {
    ?>
    <div class="col-md-4 " >
        <div class="p-1 mb-2" style="border:1px dashed #CCC">
            <p><h6 class=" font-weight-bold text-center "><?php echo $coupon['business_name'] ?></h6></p>
            <hr>
            <div class=" text-center d-flex align-items-center" style="height:300px" >
                <div>
                    <h4 class="display-4 text-danger"><?php echo $coupon['type'] == "F" ? "Rs " : "", $coupon['discount'] , $coupon['type'] == "P" ? "%" : "" ?> off</h4>
                    <p class=""><?php echo $coupon['title'] ?></p>
                    <p class=""><b>Address: </b><?php echo $coupon['business_address'] ?></p>
                    <button class="btn btn-large btn-success btnGetCoupon" data-toggle="modal" data-target="#addUserCoupon" data-couponid="<?php echo $coupon['coupon_id'] ?>">Get Coupon</button>
                </div>
            </div> 
        </div>
    </div>

    <?php
        if($i % 3 == 0 )
        echo '</div><div class="row mb-2">';
        $i++;
    }
    ?>
    </div>
    
</div>

<!-- The Modal -->
<div class="modal" id="modalAddUserCoupon">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Get this coupon on whatsapp or email</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="<?php echo base_url("home/addusercoupon") ?>" method="post">
            <div class=" form-group form-row">
                <div class="col-md">
                    <input type="text" class="form-control input-lg mb-2" id="mobile" name="mobile" placeholder="Mobile">
                </div>
            </div>
            <div class=" form-group form-row">
                <div class="col-md">
                    <input type="text" class="form-control input-lg" id="email" name="email" placeholder="Email">
                </div>
            </div>
            <div class="form-group form-row"> 
                <div class="col-md">
                <button type="submit" class="btn btn-success input-lg">Get Coupon</button>
                </div>
            </div>
            <input type="hidden" name="coupon_id" id="coupon_id"/>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>