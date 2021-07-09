<?php include 'assets/php/header.php'; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 mt-3">
            <?php if($verified == 'Verified!') : ?>
            <div class="card border-primary">
                <div class="card-header lead text-center bg-primary text-white">
                    Send Feedback to Admin!
                </div>
                <div class="card-bord">
                    <form action="#" class="px-4 mt-2" method="post" id="feedback-form">

                        <div class="form-group">
                            <input type="text" name="subject" placeholder="Write your Subject"
                                class="form-control-lg form-control rounded-0" required>
                        </div>

                        <div class="form-group">
                            <textarea type="text" name="feedback" placeholder="Write your Feedback Here....."
                                class="form-control-lg form-control rounded-0" rows="8"></textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="feedbackBtn" id="feedbackBtn" value="Send Feedback"
                                class="btn btn-primary btn-block btn-lg rounded-0">
                        </div>
                    </form>
                </div>
            </div>
            <?php else : ?>
            <h1 class="text-center text-secondary mt-5">Verify Your E-mail First to Send Feedback to Admin!</h1>
            <?php endif; ?>
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
<!-- sweet alert  -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script type="text/javascript">
$(document).ready(function() {
    $("#feedbackBtn").click(function(e){
        if($("#feedback-form")[0].checkValidity()){
            e.preventDefault();

            $(this).val('Please Wait...');

            $.ajax({
                url:'assets/php/process.php',
                method: 'post',
                data: $("#feedback-form").serialize()+'&action=feedback',
                success:function(response){
                    $("#feedback-form")[0].reset();
                    $("#feedbackBtn").val('Send Feedback');
                    //SWEET ALERT SUCCES MESSAGE
                    Swal.fire({
                            title: 'Feedback successfully sent to admin!',
                            type: 'success'
                        });
                }
            });
        }
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