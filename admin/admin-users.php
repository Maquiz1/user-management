<?php
    require_once 'assets/php/admin-header.php';
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card my-2 border-success">
            <div class="card-header bg-success text-white">
                <h4 class="m-0">Total Registered Users</h4>
            </div>
            <div class="table table-responsive" id="showAllUsers">
                <p class="text-center align-self-center lead">
                    Please Wait...
                </p>
            </div>
        </div>
    </div>
</div>


<!-- display user in detail modal start -->
<div class="modal fade" id="showUserDetailsModal">
    <div class="modal-dialog modal-dialog-centere mw-100 w-50">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="getName">
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </h4>
            </div>
            <div class="modal-body">
                <div class="card-deck">
                    <div class="card border-primary">
                        <div class="card-body">
                            <p id="getUsername"></p>
                            <p id="getFirstname"></p>
                            <p id="getLastname"></p>
                            <p id="getEmail"></p>
                            <p id="getPhoto"></p>
                            <p id="getDob"></p>
                            <p id="getGender"></p>
                            <p id="getCreated"></p>
                            <p id="getVerified"></p>
                        </div>
                    </div>
                    <div class="card align-slef-center" id="getImage"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="button" class="btn btn-seconadry" data-dismiss="modal">close</button>
            </div>
        </div>
    </div>
</div>

<!-- display user in detail modal end  -->


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

        //AJAX TO VIEW USERS IN ADMIN
        fetchAllUsers();

        function fetchAllUsers() {
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {
                    action: 'fetchAllUsers'
                },
                success: function(response) {
                    $("#showAllUsers").html(response);
                    //USING DATA TABLE 
                    $("table").DataTable({
                        order: [0, 'desc']
                    });
                }
            });
        }

        //DISPLAY USER IN DETAIL
        $("body").on("click", ".userDetailsIcon", function(e) {
            e.preventDefault();

            details_id = $(this).attr('id');
            $.ajax({
                url: 'assets/php/admin-action.php',
                type: 'post',
                data: {
                    details_id: details_id
                },
                success: function(response) {
                    response = response.substring(1, response.length - 1);
                    data = JSON.parse(response); //REMOVE THE SQURE BRACKETS FROM THE BEGINS AND END FORM THE JSON STRING
                    // console.log(response);  //see how java object seen 
                    $("#getName").text(data.firstname + '' + '(ID:' + data.id + ')');
                    $("#getUsername").text('Username   : ' + data.username);
                    $("#getFirstname").text('Firstname : ' + data.firstname);
                    $("#getEmail").text('Lastname      : ' + data.lastname);
                    $("#getPhoto").text('Photo         : ' + data.photo);
                    $("#getDob").text('Date of Birth   : ' + data.dob);
                    $("#getGender").text('Gender       : ' + data.gender);
                    $("#getCreated").text('Joined On   : ' + data.created_at);
                    $("#getVerified").text('Verified   : ' + data.verified);


                    if (data.photo != '') {
                        $("#getImage").html('<img src="../assets/php/' + data.photo +
                            '" class="img-thumbnail img-fluid align-self-center" width="280px">'
                            );
                    } else {
                        $("#getImage").html(
                            '<img src="../assets/img/avatar.jpg" class="img-thumbnail img-fluid align-self-center" width="280px">'
                            );
                    }
                }
            });
        });

        //DELETE A USER
        $("body").on("click", ".deleteUserIcon", function(e) {
            e.preventDefault();

            del_id = $(this).attr('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'

            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        url: 'assets/php/admin-action.php',
                        method: 'post',
                        data: {
                            del_id: del_id
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire(
                                'Deleted!',
                                'A User has been deleted.',
                                'success'
                            )
                            fetchAllUsers();
                        }

                    });
                }

            })

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


    }
);
</script>

</body>

</html>