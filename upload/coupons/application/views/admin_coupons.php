<div class="container-fluid">
  <div class="row shadow-sm pb-2 pt-3 mb-5 border-bottom">
        <div class="col-lg-3 text-center mb-2">
            <h3>Localsquare</h3>
        </div>
        <div class="col-lg-3 text-center mb-2"><a href="<?php echo base_url("emp/logout") ?>">Logout</a></div>
        
  </div>  
  <br>
  <?php
  if(!empty($_SESSION['msg'])) {
  ?>
  <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger text-center lead font-weight-bold">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $_SESSION['msg'] ?>
        </div>
      </div>
  </div>
  <?php
  $_SESSION['msg']='';    
  }
  ?>
</div>

<div class="container">
  <div class="row">
    <div class="col-md"><h3>Add Coupon</h3><hr></div>
  </div>
  <div class="row">
    <div class="col-md">
        <form action="<?php echo base_url('admin/insertcoupon') ?>" method="post">
            
            <div class="form-group">
                <input type="text" class="form-control form-control-lg" id="business_name" name="business_name" placeholder="Business/store Name" required>    
            </div>

            <div class="form-group">
                <input type="text" class="form-control form-control-lg" id="business_contact" name="title" placeholder="Coupon offer Description" required>    
            </div>
            
            <div class="form-group">
                <input type="text" class="form-control form-control-lg" id="business_email" name="discount" placeholder="Discount" >    
            </div>

            <div class="form-group form-row">
                <div class="col-sm-10"> 
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="type" value="P">Percent
                        </label>
                        </div>
                        <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="type" value="F">Flat
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <input type="text" class="form-control form-control-lg" id="business_address" name="business_address" placeholder="Business/store Address" required>    
            </div>

            <button type="submit" class="btn btn-primary form-control-lg">Submit</button>
        </form> 
    </div>
  </div>

</div>
