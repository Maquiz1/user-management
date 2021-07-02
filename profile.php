<?php include 'assets/php/header.php'; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card rounded-0 mt-3 border-primary">
                <div class="card-header border-primary">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a href="#profile" class="nav-link active font-weight-bold" data-toggle="tab">
                                Pofile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#editProfile" class="nav-link font-weight-bold" data-toggle="tab">
                                Edit Pofile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#changePass" class="nav-link font-weight-bold" data-toggle="tab">
                                Change Password
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">

                        <!-- profile TAB start here  -->
                        <div class="tab-pane container active" id="profile">
                        <div id="verifyEmailAlert"></div>
                            <div class="card-deck">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary text-light text-center lead">
                                        User ID : <?= $cid; ?>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-body p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                            <b>Name : </b><?= $cusername; ?>
                                        </p>
                                        <p class="card-body p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                            <b>First Name : </b><?= $cfirstname; ?>
                                        </p>
                                        <p class="card-body p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                            <b>Last Name : </b><?= $clastname; ?>
                                        </p>
                                        <p class="card-body p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                            <b>Email : </b><?= $cemail; ?>
                                        </p>
                                        <p class="card-body p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                            <b>Gender : </b><?= $cgender; ?>
                                        </p>
                                        <p class="card-body p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                            <b>Phone : </b><?= $cphone; ?>
                                        </p>
                                        <p class="card-body p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                            <b>Registered On : </b><?= $reg_on; ?>
                                        </p>

                                        <p class="card-body p-2 m-1 rounded" style="border:1px solid #0275d8;">
                                            <b>E-mail Status : </b><?= $verified; ?>

                                            <?php if($verified == 'Not Verified!') : ?>
                                            <a href="#" id="verify-email" class="float-light">Verify Now</a>
                                            <?php endif; ?>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="card border-primary align-self-center">
                                    <?php if(!$cphoto) : ?>
                                    <img src="assets/img/avatar.jpg" alt="" class="img-thumbnail img-fluid"
                                        width="408px">
                                    <?php else: ?>
                                    <img src=<?= 'assets/php/'.$cphoto; ?> alt="" class="img-thumbnail img-fluid"
                                        width="408px">

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- prifile end here  -->





                        <!-- edit profile TAB start here  -->
                        <div class="tab-pane container fade" id="editProfile">
                            <div class="card-deck">
                                <div class="card border-danger align-self-center">
                                    <?php if(!$cphoto) : ?>
                                    <img src="assets/img/avatar.jpg" alt="" class="img-thumbnail img-fluid"
                                        width="408px">
                                    <?php else: ?>
                                    <img src=<?= 'assets/php/'.$cphoto; ?> alt="" class="img-thumbnail img-fluid"
                                        width="408px">

                                    <?php endif; ?>
                                </div>
                                <div class="card border-danger">
                                    <form action="" id="profile-update-form" method="post" class="px-3 mt-2"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="oldimage" value="<?= $cphoto; ?>">
                                        <div class="form-group m-0">
                                            <label for="profilePhoto" class="m-1">Upload Profile Image</label>
                                            <input type="file" name="image" id="profilePhoto">
                                        </div>
                                        <div class="form-group m-0">
                                            <label for="username" class="m-1">Username</label>
                                            <input type="text" name="username" id="username" class="form-control"
                                                value="<?= $cusername; ?>">
                                        </div>
                                        <div class="form-group m-0">
                                            <label for="firstname" class="m-1">First Name</label>
                                            <input type="text" name="firstname" id="firstname" class="form-control"
                                                value="<?= $cfirstname; ?>">
                                        </div>
                                        <div class="form-group m-0">
                                            <label for="lastname" class="m-1">Last Name</label>
                                            <input type="text" name="lastname" id="lastname" class="form-control"
                                                value="<?= $clastname; ?>">
                                        </div>
                                        <div class="form-group m-0">
                                            <label for="gender" class="m-1">Gender</label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="" disabled
                                                    <?php if($cgender == null) { echo 'selected'; } ?>>Select</option>
                                                <option value="Male"
                                                    <?php if($cgender == 'Male') { echo 'selected'; } ?>>Male</option>
                                                <option value="Female"
                                                    <?php if($cgender == 'Female') { echo 'selected'; } ?>>Female
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group m-0">
                                            <label for="dob" class="m-1">Date of birth</label>
                                            <input type="date" name="dob" id="dob" class="form-control"
                                                value="<?= $cdob; ?>">
                                        </div>
                                        <div class="form-group m-0">
                                            <label for="phone" class="m-1">Phone</label>
                                            <input type="tel" name="phone" id="phone" placeholder="phone"
                                                class="form-control" value="<?= $cphone; ?>">
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="submit" name="profile_update" value="Update Profile"
                                                class="btn btn-danger btn-block" id="ProfileUpdateBtn">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- edit profile end here  -->


                        <!-- change password tab start here  -->
                        <div class="tab-pane container fade" id="changePass">
                            <div class="card-deck">
                                <div class="card border-success">
                                    <div class="card-header bg-success text-white text-center lead">
                                        Change Password
                                    </div>
                                    <form action="#" class="px-3 mt-2" method="post" id="change-pass-form">

                                        <!-- Fail change passowrd alaert   -->
                                        <div id="changePassAlert"></div>

                                        <div class="form-group">
                                            <label for="curpass">Enter Your Current Password</label>
                                            <input type="password" name="curpass" placeholder="Current Password"
                                                class="form-control form-control-lg" id="curpass" required
                                                minlength="5">
                                        </div>
                                        <div class="form-group">
                                            <label for="newpass">Enter Your New Password</label>
                                            <input type="password" name="newpass" placeholder="New Password"
                                                class="form-control form-control-lg" id="newpass" required
                                                minlength="5">
                                        </div>
                                        <div class="form-group">
                                            <label for="cnewpass">Confirm Your New Password</label>
                                            <input type="password" name="cnewpass" placeholder="Cornfirm New Password"
                                                class="form-control form-control-lg" id="cnewpass" required
                                                minlength="5">
                                        </div>
                                        <div class="form-group">
                                            <p class="text-danger" id="changepassError"></p>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="changepass" value="Change Password"
                                                class="btn btn-success btn-block btn-lg" id="changePassBtn">
                                        </div>
                                    </form>
                                </div>
                                <div class="card boreder-success align-self-center">
                                    <img src="assets/img/changpass.jpeg" alt="" class="img-thumbnail img-fluid"
                                        width="408px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- change password tab end here  -->
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"
    integrity="sha512-wV7Yj1alIZDqZFCUQJy85VN+qvEIly93fIQAN7iqDFCPEucLCeNFz4r35FCo9s6WrpdDQPi80xbljXB8Bjtvcg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
    integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
$(document).ready(function() {

    //PROFILE UPDATE AJAX REQUEST
    $("#profile-update-form").submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: 'assets/php/process.php',
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            //use FormData class since you send Image
            data: new FormData(this),
            success: function(response) {
                // console.log(response);
                location.reload();
            }
        });
    });

    //CHANGE PASSWORD AJAX REQUEST
    $("#changePassBtn").click(function(e) {
        if ($("#change-pass-form")[0].checkValidity()) {
            e.preventDefault();
            $("#changePassBtn").val('Please wait...');

            if ($("#newpass").val() != $("#cnewpass").val()) {
                $("#changepassError").text('* Password did not matched');
                $("#changePassBtn").val('Change Password');
            } else {
                $.ajax({
                    url: 'assets/php/process.php',
                    method: 'post',
                    data: $("#change-pass-form").serialize() + '&action=change_pass',
                    success: function(response) {
                        $("#changePassAlert").html(response);
                        $("#changePassBtn").val('Change Password');
                        $("#changepassError").text('');
                        $("#change-pass-form")[0].reset();

                    }
                });
            }
        }
    });


    //VERIFY EMAIL AJAX REQUEST
    $("#verify-email").click(function (e){
        e.preventDefault();
        $(this).text('Please wait...');

        $.ajax({
            url: 'assets/php/process.php',
            method:'post',
            data:{ action:'verify_email' },
            success:function(response) {
                $("#verifyEmailAlert").html(response); 
                $("#verify_email").text('Verify now');               
            }
        });
        
    });

        //CHECK NOTIFICATION OF A USER
        checkNotification();
        function checkNotification(){
            $.ajax({
            url: 'assets/php/process.php',
            method:'post',
            data:{ action:'checkNotification' },
            success:function(response) {
                    $("#checkNotification").html(response);  //selct the id(checkNotification) from notification header
                }
            });
        };
});
</script>

</body>

</html>