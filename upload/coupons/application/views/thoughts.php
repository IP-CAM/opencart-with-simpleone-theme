<input type="hidden" id="user_id" value="<?php echo $_SESSION['user']['user_id'] ?>" />
<div class="container">
    <div class="row" style="padding-top:10px">
        <div class="col-md-3 text-center">
            <a href="#" data-toggle="tooltip" title="Upload Profile Photo" id="btnUPP" data-placement="top">
                <img src="<?php echo $_SESSION['user']['image'] ? $_SESSION['user']['image'] : base_url()."public/images/nouser.png"  ?>" class="img-circle img-responsive" alt="Cinque Terre" >
            </a>
            
            <h2><?php echo ucfirst($_SESSION['user']['first_name']), " ", ucfirst($_SESSION['user']['last_name']) ?></h2>

        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <li ><a href="<?php echo base_url() ?>">Add Tags</a></li>
                        <li class="active"><a href="<?php echo base_url()."home/thoughts" ?>"><b>Thoughts about me</b></a></li>
                    </ul>
                    <br />
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 divTags">
                    <?php 
                    foreach($thoughtsData as $thoughts) {
                    ?>
                        <h3>
                        <?php echo $thoughts['first_name'] . " " . $thoughts['last_name'] ?>
                        
                        </h3>
                        <p><?php echo $thoughts['feedback'] ?></p>
                        <p><?php echo $thoughts['like_count'] ?></p>
                        <hr/>
                    <?php    
                    }
                    ?>
                   
                </div>
            </div>

        </div>
    </div> 
</div>

<div id="modalVoteDetails" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">People who voted</h4>
      </div>
      <div class="modal-body" id="modalVoteDetailsBody">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="modalUPP" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Profile Photo</h4>
      </div>
      <div class="modal-body" id="modalVoteDetailsBody">
            <form action="<?php echo base_url()."home/upp" ?>" method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <input type="file" class="form-control input-lg" placeholder="Add Tags" id="upp" name="upp" required>
                    <div class="input-group-btn">
                    <button class="btn btn-primary input-lg" type="submit" id="btnAddTag">
                        Upload
                    </button>
                    </div>
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
