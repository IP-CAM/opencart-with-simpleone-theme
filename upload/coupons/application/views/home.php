<div class="container">
    <div class="row" style="padding-top:10px">
        <div class="col-md-3 text-center">
            <img src="<?php echo $_SESSION['user']['image'] ? $_SESSION['user']['image'] : base_url()."public/images/nouser.png"  ?>" class="img-circle img-responsive" alt="Cinque Terre" >
            <h2><?php echo $_SESSION['user']['first_name'], " ", $_SESSION['user']['last_name'] ?></h2>

        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="<?php echo base_url()."user/".$userData['user_id'] ?>">Add Tags</a></li>
                        <li><a href="<?php echo base_url()."user/thoughts/".$userData['user_id'] ?>">Thoughts about me</a></li>
                    </ul>
                    <br />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                        <form id="frmAddTag" action="<?php echo base_url()."home/add_tag" ?>" method="post">
                            <div class="input-group">
                                <input type="text" class="form-control input-lg" placeholder="Add Tags" id="txtTag" name="txtTag">
                                <div class="input-group-btn">
                                <button class="btn btn-primary input-lg" type="submit" id="btnAddTag">
                                    Tag
                                </button>
                                </div>
                            </div>
                            <span class="help-block">Add tags on which you want to take the vote</span>
                        </form>
                        <hr> 
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 divTags">
                    <?php 
                    foreach($tagsData as $tagData) {
                    ?>
                        <h3><a class="btn btn-default" href="#" data-tagid="<?php echo $tagData['tag_id'] ?>"><?php echo $tagData['tag_name'] ?> &nbsp;<span class="badge"><?php echo !empty($tagsCountData[$tagData['tag_id']]) ? $tagsCountData[$tagData['tag_id']] : 0 ?></span></a></h3>
                    <?php    
                    }
                    ?>
                    <!--<a class="btn btn-default">#genious <span class="badge">10</span></a><a class="btn btn-default">#Intelligent</a><a class="btn btn-default">#Smart <span class="badge">10</span></a><a class="btn btn-default">#hot</a><a class="btn btn-default">#handsome</a><a class="btn btn-default">#beautiful <span class="badge">10</span></a><a class="btn btn-default">#java</a><a class="btn btn-default">#genious <span class="badge">10</span></a><a class="btn btn-default">#Intelligent <span class="badge">10</span></a><a class="btn btn-default">#Smart <span class="badge">10</span></a><a class="btn btn-default">#hot</a><a class="btn btn-default">#handsome <span class="badge">10</span></a><a class="btn btn-default">#beautiful</a><a class="btn btn-default">#java</a><a class="btn btn-default">#genious</a><a class="btn btn-default">#Intelligent <span class="badge">10</span></a><a class="btn btn-default">#Smart</a><a class="btn btn-default">#hot</a><a class="btn btn-default">#handsome</a><a class="btn btn-default">#beautiful <span class="badge">10</span></a><a class="btn btn-default">#java</a>-->
                </div>
            </div>

        </div>
    </div> 
</div>