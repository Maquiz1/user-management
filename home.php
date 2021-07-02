<?php 
require_once 'assets/php/header.php'; 
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php if($verified == 'Not Verified!'): ?>
            <div class="alert alert-danger alert-dismissible  text-center mt-2 m-0">
                <button class="close" type="button" data-dsimiss="alert">
                    &times;
                </button>
                <strong>Your E-mail is not verified! We've sent you an E-mail Verification link on your E-mail,check and
                    verify now!</strong>
            </div>
            <?php endif; ?>
            <h4 class="text-center text-primary mt-2">
                Write Your Notes Here and Acces Any time!
            </h4>
        </div>
    </div>
    <div class="card border-primary">
        <h5 class="card-header bg-primary d-flex justify-content-between">
            <span class="text-light lead align-self-center">
                All Notes
            </span>
            <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addNoteModal">
                <i class="fas fa-plus-circle fa-lg"></i>
                &nbsp;Add New Notes
            </a>
        </h5>
        
        <div class="card-body">
            <div class="table-responsive" id="showNote">              
                <p class="text-center lead mt-5">Please wait...</p>

            </div>
        </div>
    </div>
</div>


<!-- ADD NEW MODEL START HERE  -->
<div class="modal fade" id="addNoteModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">
                    Add New Note
                </h4>
                <button type="button" class="close text-light" data-dismiss="modal">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="add-note-form" class="px-3">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg" name="title" placeholder="Enter Title"
                            required>
                    </div>
                    <div class="form-group">
                        <textarea type="textarea" class="form-control form-control-lg" name="note"
                            placeholder="Write your Note Here... " rows="6" required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success btn-block btn-lg" name="addNote" id="addNoteBtn"
                            value="Add Note">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ADD NEW MODEL END HERE  -->


<!-- EDIT MODEL START HERE  -->
<div class="modal fade" id="editNoteModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">
                    Edit Note
                </h4>
                <button type="button" class="close text-light" data-dismiss="modal">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="edit-note-form" class="px-3">
                    <input type="hidden" name="id" id="id" class="">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg" id="title" name="title"
                            placeholder="Enter Title" required>
                    </div>
                    <div class="form-group">
                        <textarea type="textarea" class="form-control form-control-lg" name="note" id="note"
                            placeholder="Write your Note Here... " rows="6" required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-info btn-block btn-lg" name="editNote" id="editNoteBtn"
                            value="Update Note">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- EDIT MODEL END HERE  -->



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

<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.25/datatables.min.js"></script>

<!-- sweet alert FROM  https://sweetalert2.github.io/#download -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    $(document).ready(function() {

        //ADD NEW NOTE AJAX REQUEST
        $("#addNoteBtn").click(function(e){
            if($("#add-note-form")[0].checkValidity()){
                e. preventDefault();
                $("#addNoteBtn").val('Please Wait...');

                $.ajax({
                    url : 'assets/php/process.php',
                    method: 'post',
                    data: $("#add-note-form").serialize()+'&action=add_note',
                    success:function(response){
                        $("#addNoteBtn").val('Add Note');
                        $("#add-note-form")[0].reset();
                        $("#addNoteModal").modal('hide');
                        //SWEET ALERT SUCCES MESSAGE
                        Swal.fire({
                            title: 'Note added successfully!',
                            type: 'success'
                        });

                        displayAllNotes();
                    }
                });
            }
        });

        //EDIT NOTE OF A USER
        $("body").on("click",".editBtn",function(e){
            e.preventDefault();

            edit_id = $(this).attr('id');
            
            $.ajax({
                url: 'assets/php/process.php',
                method: 'post',
                data: { edit_id: edit_id },
                success:function(response){
                    data = JSON.parse(response);
                    $("#id").val(data.id);
                    $("#title").val(data.title);
                    $("#note").val(data.note);
                }

            });
        });


        //UPDATE NOTE OF A USER AJAX REQUEST
        $("#editNoteBtn").click(function(e){
            if($("#edit-note-form")[0].checkValidity()){
                e.preventDefault();

                $.ajax({
                    url: 'assets/php/process.php',
                    method: 'post',
                    data: $("#edit-note-form").serialize()+"&action=update_note",
                    success:function(response){
                    //SWEET ALERT SUCCES MESSAGE
                    Swal.fire({
                        title: 'Note updated successfully!',
                        type:  'success'
                    });
                    $("#edit-note-form")[0].reset();
                    $("#editNoteModal").modal('hide');
                    displayAllNotes();
                    }

                });
            }
           
        });


        //DELETE NOTE OF A USER
        $("body").on("click",".deleteBtn",function(e){
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
        url: 'assets/php/process.php',
        method: 'post',
        data: { del_id: del_id },
        success:function(response){
            console.log(response);
            Swal.fire(
            'Deleted!',
            'Your Note has been deleted.',
            'success'
            )
            displayAllNotes();
        }       

        });
        }

        })

        });



        //DISPLAY NOTE IN A DETAIL OF A USER
        $("body").on("click",".infoBtn",function(e){
            e.preventDefault();

            info_id = $(this).attr('id');
            
            $.ajax({
                url: 'assets/php/process.php',
                method: 'post',
                data: { info_id: info_id },
                success:function(response){
                    data = JSON.parse(response);
                    //SWEET ALERT SUCCES MESSAGE
                    Swal.fire({
                    title: '<strong>Note : ID('+data.id+')</strong>',
                    type:  'info',
                    html: '<b>Title : </b>'+data.title+'<br><br><b>Note : </b>'+data.note+
                    '<br><br><b>Written on : </b>'+data.created_at+'<br><br><b>Updated on : </b>'+data.updated_at,
                    showCloseButton: true,
                    });
                    $("#edit-note-form")[0].reset();
                    $("#editNoteModal").modal('hide');
                    $("#id").val(data.id);
                    $("#title").val(data.title);
                    $("#note").val(data.note);
                }

            });
        });

        displayAllNotes();
        //Display all note of an user
        function displayAllNotes(){
            $.ajax({
                url: 'assets/php/process.php',
                method: 'post',
                data: {action: 'display_notes'},
                success:function(response){
                   $("#showNote").html(response);
                   //USE DATA TABLE TO SHOW NOTES
                   $("table").DataTable(
                       {
                       order: [0,'desc']
                       }
                   );
                }
            });
        }

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