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
                                <?php echo $group['academic_year'] . ' - ' . $group['semester']; ?>
                                <span class="toggle-indicator">+</span>
                            </h5>
                        </div>
                        <table class="table table-bordered table-condensed table-hover grouped-table" data-academic-year="<?php echo $group['academic_year']; ?>" data-semester="<?php echo $group['semester']; ?>" style="display: none;">
                            <colgroup>
                                <col width="5%">
                                <col width="20%">
                                <col width="30%">
                                <col width="20%">
                                <col width="10%">
                                <col width="15%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="">ID No</th>
                                    <th class="">Name</th>
                                    <th class="">Email</th>
                                    <th class="">Contact</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $faculty =  $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name from faculty WHERE academic_year = '{$group['academic_year']}' AND semester = '{$group['semester']}' ORDER BY concat(lastname,', ',firstname,' ',middlename) ASC");
                                while($row = $faculty->fetch_assoc()):
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
                                         <p><b><?php echo $row['email'] ?></b></p>
                                    </td>
                                    <td class="text-right">
                                         <p><b><?php echo $row['contact'] ?></b></p>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary view_faculty" type="button" data-id="<?php echo $row['id_no'] ?>" >Generate</button>
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
