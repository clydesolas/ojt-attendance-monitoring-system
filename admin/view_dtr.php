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
                    <form method="post" id="form">
                    <button class="btn btn btn-success" type="submit" id="btn" onclick="thisBtn()" name="pdf">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-file-earmark-arrow-down-fill"
                                    viewBox="0 0 16 16">
                                        <path
                                            d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z"/>
                                </svg>
                                Pdf
                            </button>
                            </form>
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
<script>
     function thisBtn(){
               btn =  document.getElementById("btn"); 
               form =  document.getElementById("form"); 
               if(btn){
                form.setAttribute('action', 'generate_pdf.php');
               }
            }
</script>