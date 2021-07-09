<?php include 'assets/php/header.php'; ?>

<div class="container">
    <div class="row justify-content-center my-2">
        <div class="col-lg-6 mt-4" id="showAllNotification">
            <!-- see on process  -->
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
    $(document).ready(function(){

        //FETCH NOTIFICATION OF A USER
        fetchNotification();
        function fetchNotification(){
            $.ajax({
            url: 'assets/php/process.php',
            method:'post',
            data:{ action:'fetchNotification' },
            success:function(response) {
                    $("#showAllNotification").html(response);
                }
            });
        };

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

        //REMOVE NOTIFICATION OF A USER
        $("body").on("click",".close",function(e){
            e.preventDefault();

            notification_id = $(this).attr('id');   //SELECT ID FROM PROCESS AND CLASS = close
            
            $.ajax({
                url: 'assets/php/process.php',
                method: 'post',
                data: { notification_id: notification_id },
                success:function(response) {
                checkNotification();
                fetchNotification();
            }

            });
        });

    });
</script>

</body>

</html>