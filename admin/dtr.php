<?php include('db_connect.php');?>

<div class="container-fluid">
<style>
    input[type=checkbox]
    {
        /* Double-sized Checkboxes */
        -ms-transform: scale(1.5); /* IE */
        -moz-transform: scale(1.5); /* FF */
        -webkit-transform: scale(1.5); /* Safari and Chrome */
        -o-transform: scale(1.5); /* Opera */
        transform: scale(1.5);
        padding: 10px;
    }
</style>
    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                
            </div>
        </div>
        <div class="row">
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Daily Time Record</b>
                        <span class="">
                            <!-- Add a button to toggle the table -->
                            <!-- <button class="btn btn-sm btn-outline-primary" id="toggleTableBtn">Toggle Table</button> -->
                        </span>
                    </div>
                    <div class="card-body">
                        <?php 
                        // Fetch distinct academic years and semesters from the database
                        $grouped_data = $conn->query("SELECT DISTINCT academic_year, semester FROM faculty ORDER BY academic_year desc, semester desc");
                        while($group = $grouped_data->fetch_assoc()):
                              
   ?>
                        <div class="group-label" data-academic-year="<?php echo $group['academic_year']; ?>" data-semester="<?php echo $group['semester']; ?>">
                            <h5>
                                <?php echo 'A.Y. '.$group['academic_year'] . ' - ' . $group['semester'].' Semester'; ?>
                                <span class="toggle-indicator">+</span>
                            </h5>
                        </div>
                        <table class="table table-bordered table-condensed table-hover grouped-table" data-academic-year="<?php echo $group['academic_year']; ?>" data-semester="<?php echo $group['semester']; ?>" style="display: none;">
                            <colgroup>
                                <col width="5%">
                                <col width="20%">
                                <col width="30%">
                                <col width="15%">
                                <col width="20%">
                                <col width="10%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="">ID No</th>
                                    <th class="">Name</th>
                                    <th class="">Hours</th>
                                    <th class="">Program Code</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $faculty =  $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name from faculty WHERE academic_year = '{$group['academic_year']}' AND semester = '{$group['semester']}' ORDER BY concat(lastname,', ',firstname,' ',middlename) ASC");
                                while($row = $faculty->fetch_assoc()):
                                    $id_no = $row['id_no'];
                                    $sql = "SELECT
                                    employee_id,
                                    log_date,
                                    COALESCE(DATE_FORMAT(
                                        CASE
                                            WHEN am_in IS NOT NULL THEN am_in
                                            ELSE pm_in
                                        END, '%h:%i %p'), '-') as time_in,
                                    COALESCE(DATE_FORMAT(
                                        CASE
                                            WHEN pm_out IS NOT NULL THEN pm_out
                                            ELSE am_out
                                        END, '%h:%i %p'), '-') as time_out,
                                    am_work_hours,
                                    pm_work_hours,
                                    am_work_hours + pm_work_hours as total_work_hours
                                FROM (
                                    SELECT
                                        employee_id,
                                        DATE(datetime_log) as log_date,
                                        MIN(CASE WHEN HOUR(datetime_log) < 12 AND log_type =  1 THEN datetime_log END) as am_in,
                                        MAX(CASE WHEN HOUR(datetime_log) < 13  AND log_type =  4 THEN datetime_log END) as am_out,
                                        MIN(CASE WHEN HOUR(datetime_log) >= 12  AND log_type =  1 THEN datetime_log END) as pm_in,
                                        MAX(CASE WHEN HOUR(datetime_log) >= 12  AND log_type =  4 THEN datetime_log END) as pm_out,
                                        COALESCE(TIMESTAMPDIFF(HOUR, 
                                            MIN(CASE WHEN HOUR(datetime_log) < 12 AND log_type =  1  THEN datetime_log END), 
                                            MAX(CASE WHEN HOUR(datetime_log) < 13 AND log_type =  4  THEN datetime_log END)
                                        ), 0) as am_work_hours,
                                        COALESCE(TIMESTAMPDIFF(HOUR, 
                                            MIN(CASE WHEN HOUR(datetime_log) >= 12 AND log_type =  1  THEN datetime_log END), 
                                            MAX(CASE WHEN HOUR(datetime_log) >= 12 AND log_type =  4 THEN datetime_log END)
                                        ), 0) as pm_work_hours
                                    FROM
                                        attendance
                                    WHERE
                                        employee_id = '$id_no'
                                        AND log_type IN (1, 4)
                                    GROUP BY
                                        employee_id,
                                        log_date
                                ) AS subquery;
                                ";
                                
                                    $result = $conn->query($sql);
                                    if (!$result) {
                                        die("Error: " . $conn->error);
                                    }
                                    $average_hour = 0;
                                    while ($row_data = $result->fetch_assoc()) {
                                        $sumHours = $row_data['total_work_hours'];
                                        $average_hour = $average_hour + $sumHours;
                                    }
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td class="">
                                         <p><b><?php echo $row['id_no'] ?></b></p>
                                    </td>
                                    <td class="">
                                         <p><b><?php echo ucwords($row['name']) ?></b></p>
                                    </td>
                                    
                                    <td class="">
                                         <p><b><?php echo $average_hour.'/'.$row['total_hours'] ?></b></p>
                                    </td>
                                    <td class="">
                                         <p><b><?php echo ucwords($row['program_code']) ?></b></p>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-success view_faculty" type="button" data-id="<?php echo $row['id_no'] ?>" >Generate</button>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>  

</div>
<style>
    
    td{
        vertical-align: middle !important;
    }
    td p{
        margin: unset
    }
    img{
        max-width:100px;
        max-height: 150px;
    }
    .group-label {
        cursor: pointer;
        padding: 10px;
        background-color: #f0f0f0;
        margin-bottom: 5px;
    }

    /* Hide search, entries, and pagination of DataTable by default */
    .dataTables_info,
    .dataTables_paginate,
    .dataTables_filter {
        display: none;
    }

    .toggle-indicator {
        float: right;
        font-size: 20px;
        cursor: pointer;
    }
</style>
<script>
    
    $(document).ready(function(){
        // Initialize DataTable
        var dataTable = $('table').DataTable({
            paging: false,  // Disable pagination by default
            searching: false,  // Disable search by default
            info: false  // Disable info by default
        });

        // Toggle the visibility of the tables when clicking on the label
        $('.group-label').click(function(){
            var academicYear = $(this).data('academic-year');
            var semester = $(this).data('semester');
            var groupedTable = $('.grouped-table[data-academic-year="'+academicYear+'"][data-semester="'+semester+'"]');
            var indicator = $(this).find('.toggle-indicator');

            // Toggle the table visibility
            groupedTable.toggle();

            // Change the indicator based on visibility
            indicator.text(groupedTable.is(':visible') ? '-' : '+');
        });
    })

    // Toggle the visibility of the tables when the button is clicked
    $('#toggleTableBtn').click(function(){
        $('.grouped-table').toggle();
        $('.toggle-indicator').text($('.grouped-table:visible').length > 0 ? '-' : '+');
    });

    $('#new_faculty').click(function(){
        uni_modal("New Entry","manage_faculty.php",'mid-large')
    })
    $('.view_faculty').click(function(){
        window.location.href = 'generate_pdf.php?id=' + $(this).attr('data-id');
    })
    $('.edit_faculty').click(function(){
        uni_modal("Manage Job Post","manage_faculty.php?id="+$(this).attr('data-id'),'mid-large')
        
    })
    $('.delete_faculty').click(function(){
        _conf("Are you sure to delete this topic?","delete_faculty",[$(this).attr('data-id')],'mid-large')
    })

    function delete_faculty($id){
        start_load()
        $.ajax({
            url:'ajax.php?action=delete_faculty',
            method:'POST',
            data:{id:$id},
            success:function(resp){
                if(resp==1){
                    alert_toast("Data successfully deleted",'success')
                    setTimeout(function(){
                        location.reload()
                    },1500)

                }
            }
        })
    }
</script>
