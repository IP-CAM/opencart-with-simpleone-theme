<?php
if(isset($_SESSION['msg']) && $_SESSION['msg']) {
?>
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo $_SESSION['msg']['body']; ?>
    </div>
    <?php
    unset($_SESSION['msg']);
    }   
?>
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header col-md-2">
      <a class="navbar-brand" href="<?php echo base_url() ?>" style="color:#FFF">Tagged</a>
    </div>
    
    <form class="navbar-form navbar-left col-md-4" action="<?php echo base_url('home/search') ?>" method="get">
        <div class="input-group col-md-12">
            <input type="text" class="form-control" placeholder="Search" id="txtSearch" name="search">
            <div class="input-group-btn">
            <button class="btn btn-default" type="submit">
                <i class="glyphicon glyphicon-search"></i>
            </button>
            </div>
        </div>
    </form> 

    <ul class="nav navbar-nav navbar-right">
      <li><a href="<?php echo base_url('home/logout') ?>">Home</a></li>
      <li><a href="<?php echo base_url('home/logout') ?>">Notifications</a></li>
      <li><a href="<?php echo base_url('home/logout') ?>">Sign Out</a></li>
    </ul>

  </div>
</nav>