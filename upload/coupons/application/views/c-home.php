<input type="hidden" id="company_id" value="<?php echo $_SESSION['user']['company_id'] ?>" />

<div class="row">
    <div class="col-md-3 text-center mb-4">
          <div class="card ">
          <img class="card-img-top border-bottom" src="<?php echo $_SESSION['user']['image'] ? $_SESSION['user']['image'] : base_url("public/images/nologo.png") ?>" alt="Card image" style="width:100%">
          <div class="card-body">
              <a href="#" class="card-link" id="btnUPP">Upload Photo</a><hr />
              <h4 class="card-title"><?php echo $_SESSION['user']['company_name'] ?></h4>
              <p class="card-text">Copy the below url and share with your employees to get the feedback.<br><span class="font-weight-bolder font-italic"><?php echo  base_url('company/'.$_SESSION['user']['company_id']) ?></span><br><h6>Or </h6> Share this page on social network to get the feedback anonymously.</p>
              <button href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalShareProfile">Share Profile</button>
          </div>
          </div>

    </div>
      <div class="col-md-6" id="divAllThoughts">
          <div class="row">
              <div class="col-md-12" id="divAddTag">
                    <h3>Comments</h3>
                    <hr>
              </div>
          </div>
          <?php
          if(!empty($thoughtsData)) {
          foreach($thoughtsData as $thought) { 
          ?>
          <div class="row" id="thoughtPost<?php echo $thought['thought_id'] ?>">
              <div class="col-md-12 text-left">
              <span class="lead font-weight-normal"><?php echo $thought['thought_text'] ?></span>
              <br>
              <em class="text-muted small"><?php echo date('M j Y g:i A', strtotime($thought['created']))  ?></em>
              <br>
              <br>
              <?php if($thought['is_published'] == 0) { ?><a href="<?php echo base_url("company/publish")."/".$thought['thought_id'] ?>" data-thoughtid="<?php echo $thought['thought_id'] ?>" class="publishThought">Publish</a><?php } else { ?><a href="<?php echo base_url("company/unpublish")."/".$thought['thought_id'] ?>" class="unpublishThought">Unpublish</a><?php } ?> &nbsp; <!--<a href="#" class="btnShareCmnt" data-socialshareurls='<?php echo $thought['socialShareUrls'] ?>'>Share</a> &nbsp; --><?php if(!$thought['comment']) {?><a href="#" data-thoughtid="<?php echo $thought['thought_id'] ?>" class="replyThought">Reply</a><?php } ?> &nbsp; <a href="<?php echo base_url("company/deletethought")."/".$thought['thought_id'] ?>" data-thoughtid="<?php echo $thought['thought_id'] ?>" class="deleteThought">Delete</a>  
              <br/>
              <?php if($thought['comment']) {?>
              
              <div class="row p-3">
                <div class="col-md-12 ">
                  <b>Your Reply</b><br/>
                  <?php echo $thought['comment'] ?><br>
                  <a href="<?php echo base_url("company/deletereply")."/".$thought['comment_id'] ?>" data-replyid = "<?php echo $thought['comment_id'] ?>"  class="deleteReply small">Delete Reply</a>
                </div>
              </div>
              <?php } else {?>
                <div class="row" style="padding:10px; display:None" id="divReplyThought<?php echo $thought['thought_id'] ?>">
                  <div class="col-md-12">
                  <form action="<?php echo base_url("company/replythought") ?>" method="post" class="frmReplyThought">
                    <div class="form-group">
                      <textarea class="form-control" rows="2" id="commentReply" name="comment" placeholder="Your Reply..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <input type="hidden" name="thoughtId" value="<?php echo $thought['thought_id'] ?>" />
                  </form>
                  </div>
                </div>
              <?php } ?>

              <hr/>
          </div>
          </div>
          <?php
          }
          } else {
          ?>
            <div class="row">
              <div class="col-md-12 text-danger">
                <h4>No comments yet. Copy the below url and share with your employees to get the feedback.<br><span class="font-weight-bolder font-italic"><?php echo  base_url('company/'.$_SESSION['user']['company_id']) ?></span></h4>
              </div>
            </div>
          <?php } ?>
          
      </div> 
</div>

<div id="modalShareProfile" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Share Your Profile </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="modalVoteDetailsBody">
      <a href="<?php echo $shareUrl['profile']['facebook'] ?>" class="fab fa-facebook-square fa-3x" target="_blank"></a> &nbsp; <a href="<?php echo $shareUrl['profile']['twitter'] ?>" class="fab fa-twitter-square fa-3x" target="_blank"></a> &nbsp; <a href="<?php echo $shareUrl['profile']['whatsapp'] ?>" class="fab fa-whatsapp-square fa-3x"></a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="modalShareCmnt" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Share Your Comment </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="modalVoteDetailsBody">
      <a href="" class="fab fa-facebook-square fa-3x" target="_blank"></a> &nbsp; <a href="" class="fab fa-twitter-square fa-3x" target="_blank"></a> &nbsp; <a href="" class="fab fa-whatsapp-square fa-3x"></a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="modalUPP" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Upload Company Logo</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="modalVoteDetailsBody">
            <form action="<?php echo base_url()."company/upp" ?>" method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <input type="file" class="form-control-file" placeholder="Add Tags" id="upp" name="upp" required />
                    <br/><br/>
                    <div class="input-group-btn">
                    <button class="btn btn-primary input-lg" type="submit" id="btnAddTag">
                        Upload
                    </button>
                    </div>
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
