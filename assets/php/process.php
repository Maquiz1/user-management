<?php
    require_once 'session.php';


    //Handle Add new Ajax Request
    if(isset($_POST['action']) && $_POST['action'] == 'add_note'){
        $title  = $cuser->test_input($_POST['title']);
        $note   = $cuser->test_input($_POST['note']);

        $cuser->add_new_note($cid,$title,$note);

    }


    //Handle ajax display all notes of an user
    if(isset($_POST['action']) && $_POST['action'] == 'display_notes'){

        $output = '';

        $notes = $cuser->get_notes($cid);

        if($notes){
            $output .= ' <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Note</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>'; 

            foreach($notes as $row){
                $output .= '<tr>
                <td>' .$row['id']. '</td>
                <td>' .$row['title']. '</td>
                <td>' .substr($row['note'],0,75). '...</td>
                <td>
                    <a href="#" id="'.$row['id'].'" title="View Detal" class="text-success infoBtn">
                        <i class="fas fa-info-circle fa-lg"></i>
                    </a>&nbsp;
                    <a href="#" id="'.$row['id'].'" title="Edit Note" class="text-primary editBtn">
                        <i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editNoteModal"></i>
                    </a>&nbsp;
                    <a href="#" id="'.$row['id'].'" title="Delete Note" class="text-danger deleteBtn">
                        <i class="fas fa-trash-alt fa-lg"></i>
                    </a>
                </td>
                </tr>';
            }

            $output .= '</tbody></table>';

            echo $output;
        }else {
            echo '<h3 class="text-center text-secondary">:(You have not written any note yet! Write your first note now!)</h3>';
        }
    }



    //HANDLE EDIT NOTE OF A USER AJAX REQUEST
    if(isset($_POST['edit_id'])){
        $id = $_POST['edit_id'];

        $row = $cuser->edit_note($id);

        echo json_encode($row);
    }


    //HANDLE UPDATE NOTE OF A USER AJAX REQUEST
    if(isset($_POST['action']) && $_POST['action'] == 'update_note'){
        $title  = $cuser->test_input($_POST['title']);
        $note   = $cuser->test_input($_POST['note']);
        $id     = $cuser->test_input($_POST['id']);

        $cuser->update_note($id,$title,$note);
    }


    //HANDLE DELETE NOTE OF A USER AJAX REQUEST
    if(isset($_POST['del_id'])){
        $id     =  $_POST['del_id'];

       $cuser->delete_note($id);

    }


    //HANDLE  NOTE in detail OF A USER AJAX REQUEST
    if(isset($_POST['info_id'])){
        $id = $_POST['info_id'];

        $row = $cuser->edit_note($id);

        echo json_encode($row);
    }
?>