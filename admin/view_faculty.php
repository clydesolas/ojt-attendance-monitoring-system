<?php include('db_connect.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $faculty =  $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name from faculty where id = $id");
    foreach($faculty->fetch_assoc() as $k => $v){
        $$k = $v;
    }
}
?>

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Faculty Details</b>
                        <span class=""></span>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <!-- Display Faculty Details Here -->
                                        <p><b>ID No:</b> <?php echo $id_no ?></p>
                                        <p><b>Name:</b> <?php echo ucwords($name) ?></p>
                                        <p><b>Email:</b> <?php echo $email ?></p>
                                        <p><b>Contact:</b> <?php echo $contact ?></p>
                                        <!-- Add more details as needed -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
