<div class="padding-wrapper">
    <div class="container rounded" id ="profileContainer">
        <h3 id="headTitle" class="font-italic">Add Event</h3>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <form id="editProfileForm" action="" class="form-group">
                    <div class="row">
                        <div class="col-12 col-lg-6 mt-3">
                            <label>First Name</label>
                            <input type="text" name="firstname" class="form-control" placeholder="Enter your First name!" value="<??>">
                        </div>
                        <div class="col-12 col-lg-6 mt-3">
                            <label>Last Name</label>
                            <input type="text" name="lastname" class="form-control" placeholder="Enter your Last name!" value="<??>">
                        </div>
                        <div class="col-12 mt-3">
                            <label>E-mail</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter your E-mail!" value="<??>">
                        </div>
                        <div class="col-12 col-lg-6 mt-3">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Enter your Address!" value="<??>">
                        </div>
                        <div class="col-12 col-lg-3 mt-3">
                            <label>City</label>
                            <input type="text" name="city" class="form-control" placeholder="Enter your City!" value="<??>">
                        </div>
                        <div class="col-12 col-lg-3 mt-3">
                            <label>Postcode</label>
                            <input type="text" name="postcode" class="form-control" placeholder="Enter your Postcode!" value="<??>">
                        </div>
                        <div class="col-12 col-lg-6 mt-3">
                                <label for="SelectGender">Gender</label>
                                <select type="text" name="gender" class="form-control custom-select mr-sm-2" id="SelectGender">
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                    <option value="3">Others</option>
                                </select>
                        </div>
                        <div class="col-12 col-lg-6 mt-3">
                            <label>Old Password</label>
                            <input type="password" name="oldpass" class="form-control" placeholder="Enter your old password!">
                        </div>
                        <div class="col-12 col-lg-6 mt-3">
                            <label>New Password</label>
                            <input type="password" name="pass" class="form-control" placeholder="Enter your password!">
                        </div>
                        <div class="col-12 col-lg-6 mt-3">
                            <label>Re-type Password</label>
                            <input type="password" name="pass-repeat" class="form-control" placeholder="Enter your new password again!">
                        </div>
                        <div class="col mt-4">
                            <button type="submit" name="submit" value="submit" class="w-100 btn btn-primary btn-lg">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="text-center mt-3" id="imgDiv">
                    <img class="rounded-circle img-thumbnail" id="img" src="./images/profil.png" alt="Login">
                </div>
            </div>
        </div>
    </div>
</div>