<?php
    require_once 'assets/php/admin-header.php';
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card my-2 border-danger">
            <div class="card-header bg-danger text-white">
                <h4 class="m-0">All Deleted Users</h4>
            </div>
            <div class="table table-responsive" id="showAllDeletedUsers">
                <p class="text-center align-self-center lead">
                    Please Wait...
                </p>
            </div>
        </div>
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
$(document).ready(
    function() {

        //AJAX TO VIEW A DELETED USERS IN ADMIN
        fetchAllDeletedUsers();

        function fetchAllDeletedUsers() {
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {
                    action: 'fetchAllDeletedUsers'
                },
                success: function(response) {
                    $("#showAllDeletedUsers").html(response);
                    // USING DATA TABLE 
                    $("table").DataTable({
                        order: [0, 'desc']
                    });
                }
            });
        }

        // RESTORE A USER
        $("body").on("click", ".restoreUserIcon", function(e) {
            e.preventDefault();

            res_id = $(this).attr('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "A user will been seen in the list again!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, restore it!'

            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        url: 'assets/php/admin-action.php',
                        method: 'post',
                        data: {
                            res_id: res_id
                        },
                        success: function(response) {
                            // console.log(response);
                            Swal.fire(
                                'Restored!',
                                'A User has been Restored Successfully.',
                                'success'
                            )
                            fetchAllDeletedUsers();
                        }

                    });
                }

            })

        });



        // check if notification exists
        checkNotification();

        function checkNotification() {
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