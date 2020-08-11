<div class="container">

    <div class="row">
        <div class="col-md-6 text-left" style="padding-top:30px">
            <h1 class="display-4">What is Critic's Web</h1>
            <br>
            <h3>
                <small>Anonymous messaging, feedback and review platform.</small>
            </h3>
            <br>
            <h3>
                <small>Take anonymous feedback, review or complaints from people you know.</small>
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
        
        <div class="col-md-6" style="padding-top:30px">
            <h1 class="display-4">Sign Up</h1>
            <br>
            <form action="<?php echo base_url("home/signup") ?>" method="post">
                <div class=" form-group form-row">
                    <div class="col-sm-5">
                        <input type="text" class="form-control input-lg mb-2" id="first_name" name="first_name" placeholder="First Name">
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control input-lg" id="last_name" name="last_name" placeholder="Last Name">
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
                        <!--<label class="radio-inline input-lg">
                            <input type="radio" name="gender" value="M">Male
                        </label>
                        <label class="radio-inline input-lg">
                            <input type="radio" name="gender" value="F">Female
                        </label>--> 
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="gender" value="M">Male
                            </label>
                            </div>
                            <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="gender" value="F">Female
                            </label>
                        </div>
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
            Critic's Web@2020
        </div>
      </div> 
    </div>
</div>