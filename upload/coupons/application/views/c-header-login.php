<?php
if(isset($_SESSION['msg']) && $_SESSION['msg']) {
?>
    <div class="alert alert-danger alert-dismissible text-center" style="font-size:18px">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo $_SESSION['msg']['body']; ?>
    </div>
    <?php
    unset($_SESSION['msg']);
    }   
?>

<div class="container-fluid">
  <div class="row shadow-sm p-md-4 mb-4 border ">
        <div class="col-md-1 text-center">&nbsp;</div>
        <div class="col-md-3 text-left">
            <h3>Critic's Web</h3>
        </div>
        
        <div class="col-md-7 ">
          <form class="form-inline d-flex justify-content-end" action="<?php echo base_url('company/signin') ?>" method="post">  
            <input type="email" class="form-control mb-2 mr-sm-2" id="email" placeholder="Email" name="email" required>
            
            <input type="password" class="form-control mb-2 mr-sm-2" id="pwd" placeholder="Password" name="password" required>
             
            <button type="submit" class="btn btn-primary mb-2 ml-sm-2">Login</button>
          </form>
        </div>
        <div class="col-md-1 text-center">&nbsp;</div>
  </div>  
</div>
