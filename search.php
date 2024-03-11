<?php
	if(ISSET($_POST['search'])){
		$keyword = $_POST['keyword'];
?>
	<head>
	<style>
.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>
	</head>
<div class="dropdown">
	<h2>Result</h2>
	<?php
		require 'conn.php';
		$query = mysqli_query($conn, "SELECT * FROM `blog` WHERE `content` LIKE '%$keyword%' ORDER BY `title`") or die(mysqli_error());
		while($fetch = mysqli_fetch_array($query)){
	?>
	<div style="word-wrap:break-word;">
	<span><a href="mainpage.php"<?php echo $fetch['blog_id']?>"><h4><?php echo $fetch['title']?></h4></a></span>
	<div class="dropdown-content">
			<?php echo substr($fetch['content'], 0, 100)?>
  	</div>
	</div>
	</div>
	<hr style="border-bottom:1px solid #ccc;"/>
	<?php
		}
	?>
</div>
<?php
	}
?>