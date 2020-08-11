<input type="hidden" id="user_id" value="<?php echo $_SESSION['user']['user_id'] ?>" />

<div class="row">
      <div class="col-md-3 text-center">

            <div class="card ">
            <img class="card-img-top" src="<?php echo $userData['image'] ?>" alt="<?php echo $userData['first_name'], " ", $userData['last_name']?>" style="width:100%">
            <div class="card-body">
                <h4 class="card-title"><?php echo $userData['first_name'], " ", $userData['last_name']?></h4>
                <p class="card-text">Share profile on social network and ask your friends/colleague/relatives to give your review anonymously</p>
                <a href="#" class="btn btn-primary">Share Profile</a>
            </div>
            </div>

      </div>
        <div class="col-md-6">
            
            <div class="row">
                <div class="col-md-6">
                    <h3>People's Comments</h3>
                </div>
                <div class="col-md-6 text-right">
                <button class="btn btn-primary input-lg" type="submit" id="btnAddTag">
                    Add Comments
                </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                <hr />
                </div>
            </div>
            <?php
                foreach($thoughtsData as $thought) { 
            ?>
            <div class="row" id="thoughtPost<?php echo $thought['thought_id'] ?>">
                <div class="col-md-12 ">
                <span class="lead font-weight-normal"><?php echo $thought['thought_text'] ?></span>
                <br>
                <em class="text-muted small"><?php echo date('M j Y g:i A', strtotime($thought['created']))  ?></em>
                <br>
                
                <?php if($thought['comment']) {?>
                
                <div class="row" style="padding:10px">
                  <div class="col-md-12 ">
                  <b><?php echo $userData['first_name'], " ", $userData['last_name']?>'s reply </b> <br/>
                    My reply is my reply some example text My reply is my reply some example text My reply is my reply some example text
                  </div>
                </div>
                <?php } ?>
                
                <hr/>
            </div>
            </div>
            <?php
                }
            ?>
            <div class="row">
                <div class="col-md-12 ">
                      Nilesh You are very smart and very few people can identify it.
                      <br>
                      <em class="text-muted">Posted: 17 Jan 2020 8 AM</em>
                      <br>
                      <a href="#">30 Likes</a> &nbsp; <a href="#">Publish</a> &nbsp; <a href="#">share</a>  
                      <hr/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                      Some example text some example text. John Doe is an architect and engineer
                      <br>
                      <em class="text-muted">Posted: 17 Jan 2020 8 AM</em>
                      <br>
                      <a href="#">30 Likes</a> &nbsp; <a href="#">Publish</a> &nbsp; <a href="#">share</a>  
                      <hr/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                      Nilesh You are very smart and very few people can identify it.
                      <br>
                      <em class="text-muted">Posted: 17 Jan 2020 8 AM</em>
                      <br>
                      <a href="#">30 Likes</a> &nbsp; <a href="#">Publish</a> &nbsp; <a href="#">share</a>  
                      <hr/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                      Some example text some example text. John Doe is an architect and engineerSome example text some example text. John Doe is an architect and engineer
                      <br>
                      <em class="text-muted">Posted: 17 Jan 2020 8 AM</em>
                      <br>
                      <a href="#">30 Likes</a> &nbsp; <a href="#">Publish</a> &nbsp; <a href="#">share</a>  
                      <hr/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                      Nilesh You are very smart and very few people can identify it.
                      <br>
                      <em class="text-muted">Posted: 17 Jan 2020 8 AM</em>
                      <br>
                      <a href="#">Publish</a> &nbsp; <a href="#">share</a>  
                      <hr/>
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
