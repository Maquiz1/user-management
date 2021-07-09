<?php
    require_once 'assets/php/admin-header.php';
?>

<div class="row justify-content-center my-2">
    <div class="col-lg-6 mt-4" id="showNotification">
        <h4 class="m-0">Total Notification</h4>
        <p class="text-center align-self-center lead">
            Please Wait...
        </p>
    </div>
</div>



<!-- FOOTER AREA  -->
</div>

</div>
</div>

<!-- to use data table  -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.25/datatables.min.js"></script>

<!-- sweet alert FROM  https://sweetalert2.github.io/#download -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
$(document).ready(function() {

    //AJAX TO FETCH NOTIFICATION IN ADMIN
    fetchAllNotification();

    function fetchAllNotification() {
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: {
                action: 'fetchAllNotification'
            },
            success: function(response) {
                $("#showNotification").html(response);
                
            }
        });
    }

    //check if notification exists
    checkNotification();
    function checkNotification(){
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: {
                action: 'checkNotification'
            },
            success: function(response) {
                $("#checkNotification").html(response);
            }
        });

    }

    //remove notification ajax request
    $("body").on("click",".close",function(e){
        e.preventDefault();

        notification_id = $(this).attr('id');

        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: {
                notification_id : notification_id
            },
            success: function(response) {
                fetchAllNotification();
                checkNotification();
            }
        });
    });
});

</script>


</body>

</html>