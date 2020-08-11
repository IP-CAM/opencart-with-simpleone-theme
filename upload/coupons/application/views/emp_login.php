<div class="container-fluid">
  <div class="row shadow-sm pb-2 pt-3 mb-5 border-bottom">
        <div class="col-lg-3 text-center mb-2">
            <h3>Localsquare</h3>
        </div>
        
  </div>  
  <br>
  <?php
  if(!empty($_SESSION['msg'])) {
  ?>
  <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger text-center lead font-weight-bold">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $_SESSION['msg']['body'] ?>
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
        <div class="col-md">
            <h3>Employee Login</h3>
            <hr>
            <form action="<?php echo base_url('emp/signin') ?>" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">username</label>
                    <input type="text" class="form-control form-control-lg" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter Username" required>
                   
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password" required>
                </div>
               
                <button type="submit" class="btn btn-primary form-control-lg">Submit</button>
            </form>
        </div>
    </div>
</div>