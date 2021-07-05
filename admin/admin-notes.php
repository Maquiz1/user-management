<?php
    require_once 'assets/php/admin-header.php';
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card my-2 border-secondary">
            <div class="card-header bg-secondary text-white">
                <h4 class="m-0">Total Notes By All Users</h4>
            </div>
            <div class="table table-responsive" id="showAllNotes">
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

        //AJAX TO VIEW NOTES IN ADMIN
        fetchAllNotes();

        function fetchAllNotes() {
            $.ajax({
                url: 'assets/php/admin-action.php',
                 method: 'post',
                data: {
                    action: 'fetchAllNotes'
                },
                success: function(response) {
                    $("#showAllNotes").html(response);
                    //USING DATA TABLE 
                    $("table").DataTable({
                        order: [0, 'desc']
                    });
                }
            });
        }

        //DELETE A NOTE
        $("body").on("click", ".deleteNoteIcon", function(e) {
            e.preventDefault();

            note_id = $(this).attr('id');

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
                            note_id: note_id
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire(
                                'Deleted!',
                                'A User has been deleted.',
                                'success'
                            )
                            fetchAllNotes();
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