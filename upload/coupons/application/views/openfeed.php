<div class="container-fluid">
  <div class="row shadow-sm p-md-4 mb-4 border ">
        <div class="col-md-3 text-center  ">
            <h3>Unsaidstuff</h3>
        </div>
        
        <div class="col-md-7 ">
        </div>
        <div class="col-md-2 text-center pt-2"><a href="<?php echo base_url("login") ?>">Login | Signup</a></div>
  </div>  
</div>

<div class="container">

    <?php if(isset($_SESSION['msg'])) { ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><?php echo $_SESSION['msg'] ?></strong>
    </div>
    <?php } $_SESSION['msg']=""; ?>

    <div class="row">
        <div class="col-md text-left" style="padding-top:30px">
            <h1 class="display-4">Bringing your feedback in front of your company is our responsibility.</h1>
            
            <p class="lead">Send <b>Anonymous</b> feedback, review complanint to your company's management. No login required. Only 3 feedbacks are allowed.</p>
            <br>
            <form action="<?php echo base_url("home/addopenfeed") ?>" method="post">
                
                <div class="form-group form-row">
                    <div class="col-sm-10">
                        <input type="text" class="form-control input-lg" id="email"  name="company_name" placeholder="Company Name" required>
                    </div>
                </div>
                <div class="form-group form-row">
                    <div class="col-sm-10"> 
                        <textarea rows="4" class="form-control input-lg" placeholder="Your anonymous feedback" name="company_feedback" required></textarea>
                    </div>
                </div>
                
                <div class="form-group form-row"> 
                    <div class="col-sm-10">
                    <button type="submit" class="btn btn-success input-lg">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    

    <div class="row ">
        <div class="col-md-12 text-center p-2 mt-5 mb-0 p-md-2 border-top text-muted">
            Unsaidstuff.com@2020
        </div>
    </div>
</div>