<div class="container">

    <div class="row">
        <div class="col-md-5 text-left" style="padding-top:30px">
            <h1 class="display-4">Critic's Web for companies</h1>
            <br>
            <h3>
                <small>Anonymous messaging, feedback and review platform for companies.</small>
            </h3>
            <br>
            <h3>
                <small>Take anonymous feedback, review or complaints from your employees.</small>
            </h3>
            <br>
            <h3>
                <small>Give reply on the feedback.</small>
            </h3>
            <br>
            <h3>
                <small>Publish the appropriate feedback to the world.</small>
            </h3>
        </div>
        <div class="col-md-1 text-left" ></div>
        <div class="col-md-6  justify-content-end" style="padding-top:30px">
            <h1 class="display-4">Sign Up</h1>
            <br>
            <form action="<?php echo base_url("company/signup") ?>" method="post">
                <div class="form-group form-row">
                    <div class="col-sm-10">
                        <input type="text" class="form-control input-lg" id="company_name"  name="company_name" placeholder="Company Name">
                    </div>
                </div>
                <div class="form-group form-row">
                    <div class="col-sm-10">
                        <input type="email" class="form-control input-lg" id="email"  name="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-group form-row">
                    <div class="col-sm-10"> 
                        <input type="password" class="form-control input-lg" id="password" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group form-row"> 
                    <div class="col-sm-10">
                    <button type="submit" class="btn btn-success input-lg">Sign Up</button>
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