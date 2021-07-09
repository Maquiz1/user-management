<?php
    require_once 'assets/php/admin-header.php';
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card my-2 border-warning">
            <div class="card-header bg-warning text-white">
                <h4 class="m-0">Total Total Feedback From Users</h4>
            </div>
            <div class="table table-responsive" id="showAllFeedback">
                <p class="text-center align-self-center lead">
                    Please Wait...
                </p>
            </div>
        </div>
    </div>
</div>


<!-- Reply Feedback Modal Start here -->

<div class="modal fade" id="showReplyModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Reply This Feedback</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" class="px-3" id="feedback-reply-form">
                    <div class="form-group">
                        <textarea name="message" id="message" rows="6" class="form-control"
                            placeholder="Write your message here.." required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Send Reply" class="btn btn-primary btn-block"
                            id="feedbackReplayBtn">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Reply Feedback Modal  End here-->



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

    //AJAX TO FETCH ALL FEEDBACK
    fetchAllFeedback();

    function fetchAllFeedback() {
        $.ajax({
            url: 'assets/php/admin-action.php',
            method: 'post',
            data: {
                action: 'fetchAllFeedback'
            },
            success: function(response) {
                $("#showAllFeedback").html(response);
                //USING DATA TABLE 
                $("table").DataTable({
                    order: [0, 'desc']
                });
            }
        });
    }

    //get the current row user id and feedback ID
    var uid;
    var fid;

    $("body").on("click",".replyFeedbackIcon",function(){
        uid = $(this).attr('id');
        fid = $(this).attr('fid');
    });

    //Send feedback reply to the User Ajax
    $("#feedbackReplayBtn").click(function(e){
        if($("#feedback-reply-form")[0].checkValidity()){
            let message = $("#message").val();
            e.preventDefault();
            $("#feedbackReplayBtn").val('Please Wait...');

            $.ajax({
                url:'assets/php/admin-action.php',
                method:'post',
                data:{ uid : uid, message : message, fid: fid },
                success:function(response){
                    $("#feedbackReplayBtn").val('Send Reply');
                    $("#showReplyModal").modal('hide');
                    $("#feedback-reply-form")[0].reset();
                    Swal.fire(
                        'Sent!',
                        'Reply sent Successfully to a user.',
                        'success'
                    )
                    fetchAllFeedback();
                }
            });
        }
    });

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
});
</script>

</body>

</html>