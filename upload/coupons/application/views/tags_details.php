<div class="container">
    
    <div class="row">
        <div class="col-md-9">
            <h1><?php echo ucfirst($tagName) ?></h1>
            <hr />

            <?php 
                foreach($tagsData as $tagData) {
            ?>
            <div class="row">
                <div class="col-md-2">
                    <img src="<?php echo $tagData['image'] ? $tagData['image'] : base_url()."public/images/nouser.png"  ?>" class="img-circle img-responsive" alt="Cinque Terre" >
                </div>
                <div class="col-md">
                <h3><a href="<?php echo base_url('user/'.$tagData['user_id']) ?>"><?php echo $tagData['first_name'], " ", $tagData['last_name'] ?></a> &nbsp;<span class="badge"><?php echo $tagData['tag_count'] ?> Votes</span></h3>
                </div>
            </div>
            
            <?php } ?>
        </div>
    </div>

    
</div>