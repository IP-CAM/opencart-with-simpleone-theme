<input type="hidden" id="user_id" value="<?php echo $userId ?>" />
<div class="container">
    <div class="row" style="padding-top:10px">
        <div class="col-md-3 text-center">
            <img src="<?php echo $userData['image'] ? $userData['image'] : base_url()."public/images/nouser.png"  ?>" class="img-circle img-responsive" alt="Cinque Terre" >
            <h2><?php echo ucfirst($userData['first_name']), " ", ucfirst($userData['last_name']) ?></h2>

        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <li><a href="<?php echo base_url()."user/".$userData['user_id'] ?>">Add Tags</a></li>
                        <li class="active"><a href="<?php echo base_url()."user/thoughts/".$userData['user_id'] ?>"><b>Thoughts about me</b></a></li>
                    </ul>
                    <br />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                        <form id="frmAddTag" action="<?php echo base_url()."user/add_tag" ?>" method="post">
                            <div class="form-group">
                                <textarea class="form-control" rows="5" id="comment"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary input-lg" type="submit" id="btnAddTag">
                                    Tag
                                </button>

                            </div>
                            <input type="hidden" value="<?php echo $userId ?>" name="user_id"/>
                        </form>
                        <hr> 
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