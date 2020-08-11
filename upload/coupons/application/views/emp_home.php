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
    <div class="col-md"><h3>Customers</h3><hr></div>
  </div>
  <div class="row">
    <div class="col-md">
        <table class="table table-striped">
            <tr>
                <th>Business/Store Name</th>
                <th>Business/Store Contact</th>
                <th>Not Interested</th>
            </tr>
            <?php foreach($custData as $cust) { ?>
            <tr>
                <td><?php echo $cust['business_name']; ?></td>
                <td><?php echo $cust['business_name']; ?></td>
                <td><a class="btn btn-danger text-light">X</a></td>
            </tr>
            <?php } ?>
        </table>
    </div>
  </div>

</div>
