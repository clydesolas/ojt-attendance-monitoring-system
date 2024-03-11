<?php 
include('auditconn.php');
?>
<div class="container py-5">
    <hr>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                <?php include('header.php'); ?>
                    <tr>
                        <th class="py-1 px-2">#</th>
                        <th class="py-1 px-2">DateTime</th>
                        <th class="py-1 px-2">Faculty ID</th>
                        <th class="py-1 px-2">Action Made</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php 
                    $qry = $conn->query("SELECT l.*,f.id_no FROM `logs` l inner join faculty f on l.user_id = f.id_no order by unix_timestamp(l.`date_created`) asc");
                    $i = 1;
                    while($row=$qry->fetch_assoc()):
                    ?>
                    <tr>
                        <td class="py-1 px-2"><?php echo $i++ ?></td>
                        <td class="py-1 px-2"><?php echo date("M d, Y H:i",strtotime($row['date_created'])) ?></td>
                        <td class="py-1 px-2"><?php echo $row['id_no'] ?></td>
                        <td class="py-1 px-2"><?php echo $row['action_made'] ?></td>
                    </tr>
                    <?php endwhile; ?>
                    <?php if($qry->num_rows <=0): ?>
                        <tr>
                            <th class="tex-center"  colspan="4">No data to display.</th>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
