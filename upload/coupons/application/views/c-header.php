<div class="container">
  <div class="row shadow-sm pb-2 pt-3 mb-3 border-bottom">
        <div class="col-lg-3 text-center mb-2">
            <h3>UnsaidStuff</h3>
        </div>
        
        <div class="col-lg-5 mb-2">
            <form class="form-inline" action="<?php echo base_url('company/search') ?>">
                <div class="input-group col-12 pl-md-0">
                    <input type="text" class="form-control" placeholder="Search companies by name" name="search">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search fa-lg"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4 mb-2">
            <ul class="nav justify-content-center">
            <?php if(!empty($_SESSION['user'])) { ?>
            
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url("/company") ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url("company/".$_SESSION['user']['company_id']) ?>" data-toggle="tooltip" title="This is how your page will be visible to public">Company's Page</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url("home/logout") ?>">Sign out</a>
                </li>
            <?php } else { ?> 
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('login') ?>">Login</a>
                </li>        
            <?php } ?>
            </ul>
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
            <?php echo $_SESSION['msg'] ?>
        </div>
      </div>
  </div>
  <?php
  $_SESSION['msg']='';    
  }
  ?>
