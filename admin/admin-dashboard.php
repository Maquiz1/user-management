<?php
    require_once 'assets/php/admin-header.php';
    require_once 'assets/php/admin-db.php';


    $count = new Admin();
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card-deck mt-3 text-light text-center font-weight-bold">
            <div class="card bg-primary">
                <div class="card-header">
                    Total Users
                </div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?= $count->totalCount('users'); ?>
                    </h1>
                </div>
            </div>
            <div class="card bg-info">
                <div class="card-header">
                    Verified users
                </div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?= $count->verified_users(1); ?>
                    </h1>
                </div>
            </div>
            <div class="card bg-success">
                <div class="card-header">
                    Unverified users
                </div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?= $count->verified_users(0); ?>
                    </h1>
                </div>
            </div>
            <div class="card bg-danger">
                <div class="card-header">
                    Website Hits
                </div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?php $data = $count->site_hits(); echo $data['hits']; ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card-deck mt-3 text-light text-center font-weight-bold">
            <div class="card bg-primary">
                <div class="card-header">
                    Total notes
                </div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?= $count->totalCount('notes'); ?>
                    </h1>
                </div>
            </div>
            <div class="card bg-info">
                <div class="card-header">
                    Total Feedback
                </div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?= $count->totalCount('feedback'); ?>
                    </h1>
                </div>
            </div>
            <div class="card bg-success">
                <div class="card-header">
                    Total Notifications
                </div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?= $count->totalCount('notification'); ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card-deck my-3">
            <div class="card border-success">
                <div class="card-header bg-success text-center text-white lead">
                    Male/Female User's Percentage
                </div>
                <div id="chartOne" style="width:99%; height: 400px;">
                </div>
            </div>
            <div class="card border-info">
                <div class="card-header bg-success text-center text-white lead">
                    Verified/Unverified User's Percentage
                </div>
                <div id="chartTwo" style="width: 99%; height: 400px;">
                </div>
            </div>
        </div>
    </div>
</div>




<!-- FOOTER AREA  -->
</div>

</div>
</div>

<!-- google charts  -->

<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

// Load the Visualization API and the corechart package.
google.charts.load('current', {
    'packages': ['corechart']
});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(pieChart);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function pieChart() {

// Create the data table.
var data = google.visualization.arrayToDataTable(
    [
        ['Gender', 'Number'],
        <?php 
            $gender = $count->genderPer();
            foreach($gender as $row){
                echo '["'.$row['gender'].'",'.$row['number'].'],';
            }
        ?>
    ]
);

var options = {
    'title':'Percentages',
    is3D: false
};

// Instantiate and draw our chart, passing in some options.
var chart = new google.visualization.PieChart(document.getElementById('chartOne'));
chart.draw(data, options);
}




// verified and unverified 
google.charts.load("current", {
    packages: ["corechart"]
});
google.charts.setOnLoadCallback(colChart);

function colChart() {
    var data = google.visualization.arrayToDataTable([
        ['Verified', 'Number'],
        <?php 
            $verified = $count->verifiedPer();
            foreach($verified as $row){
                if($row['verified'] == 0){
                    $row['verified'] = "Unverified";
                }else{
                    $row['verified'] = "Verified";
                }
                echo '["'.$row['verified'].'",'.$row['number'].'],';
            }
            ?>

    ]);
    var options = {
        'title':'Percentages',
        pieHole: 0.4,

    };

    var chart = new google.visualization.PieChart(document.getElementById(
        'chartTwo'
    ));
    chart.draw(data, options);
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

</script>
</body>

</html>








