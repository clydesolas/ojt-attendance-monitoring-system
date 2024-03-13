<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM faculty where id=".$_GET['id'])->fetch_array();
	foreach($qry as $k =>$v){
		$$k = $v;
	}
}

// Get the current academic year (e.g., A.Y. 2023-2024)
$current_year = date('Y');
$next_year = $current_year + 1;
$last_year = $current_year - 1;
$academic_year = "A.Y. $current_year-$next_year";
$academic_year2 = "A.Y. $last_year-$current_year";


// Get the current semester (first, second, summer)
$semester_options = array('First', 'Second', 'Summer');
$current_month = date('n');
$current_semester = ($current_month >= 6 && $current_month <= 10) ? 'Second' : 'First';
$semester_options_html = '';
foreach ($semester_options as $option) {
    $selected = ($option == $current_semester) ? 'selected' : '';
    $semester_options_html .= "<option $selected>$option</option>";
}
?>

<div class="container-fluid">
    <form action="" id="manage-faculty">
        <div id="msg"></div>
        <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id']:'' ?>" class="form-control">
        <div class="row form-group">
            <div class="col-md-4">
                <label class="control-label">Student No.</label>
                <input type="text" name="id_no" class="form-control" value="<?php echo isset($id_no) ? $id_no:'' ?>" required>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <label class="control-label">Last Name</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo isset($lastname) ? $lastname:'' ?>" required>
            </div>
            <div class="col-md-4">
                <label class="control-label">First Name</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo isset($firstname) ? $firstname:'' ?>" required>
            </div>
            <div class="col-md-4">
                <label class="control-label">Middle Name</label>
                <input type="text" name="middlename" class="form-control" value="<?php echo isset($middlename) ? $middlename:'' ?>">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <label class="control-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo isset($email) ? $email:'' ?>" required>
            </div>
            <div class="col-md-4">
                <label class="control-label">Contact #</label>
                <input type="text" name="contact" class="form-control" value="<?php echo isset($contact) ? $contact:'' ?>" required>
            </div>
            <div class="col-md-4">
                <label class="control-label">Gender</label>
                <select name="gender" required="" class="custom-select" id="">
                    <option <?php echo isset($gender) && $gender == 'Male' ? 'selected' : '' ?>>Male</option>
                    <option <?php echo isset($gender) && $gender == 'Female' ? 'selected' : '' ?>>Female</option>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <label class="control-label">Supervisor</label>
                <input type="text" name="supervisor" class="form-control" value="<?php echo isset($supervisor) ? $supervisor:'' ?>"></input>
            </div>
        </div>
        <!-- Additional Inputs -->
        <div class="row form-group">
            <div class="col-md-4">
                <label class="control-label">Academic Year</label>
                <select name="academic_year" required="" class="custom-select" id="">
                    <option <?php echo isset($academic_year) && $academic_year == '2023-2024' ? 'selected' : '' ?>>2023-2024</option>
                    <option <?php echo isset($academic_year) && $academic_year == '2024-2025' ? 'selected' : '' ?>>2024-2025</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="control-label">Semester</label>
                <select name="semester" required class="custom-select">
                    <?php echo $semester_options_html; ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="control-label">Program Code</label>
                <input type="text" name="program_code" class="form-control" value="<?php echo isset($program_code) ? $program_code:'' ?>" required>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <label class="control-label">Total No. of Hours to be Completed</label>
                <input type="number" name="total_hours" class="form-control" value="<?php echo isset($total_hours) ? $total_hours:'' ?>" required>
            </div>
        </div>
    </form>
</div>

<script>
    $('#manage-faculty').submit(function(e){
        e.preventDefault()
        start_load()
        $.ajax({
            url:'ajax.php?action=save_faculty',
            method:'POST',
            data:$(this).serialize(),
            success:function(resp){
                if(resp == 1){
                    alert_toast("Data successfully saved.",'success')
                    setTimeout(function(){
                        location.reload()
                    },1000)
                } else if(resp == 2){
                    $('#msg').html('<div class="alert alert-danger">ID No. already existed.</div>')
                    end_load();
                }
            }
        })
    })
</script>
