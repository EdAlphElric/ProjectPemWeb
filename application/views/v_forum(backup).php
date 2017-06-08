<?php
include 'header.php';
$username = 'FRANS';
?>
<!DOCTYPE html>
<html>
<head>
<title>Forum</title>
</head>
<body >
<div class="base-grid forum fade1">
<div class="layer fade2 layer-forum" >
		<div class="nothing" ></div>
		<div class="col-sm-1"></div>
		<div class="list col-sm-10 " style="animation: fadein08 5s;">
			<div class="col-sm-8 ">
				<span class="fontForum">
					<a href="#forum">FORUM</a>
				</span>
			</div>
			<div class="col-sm-1 ">
				<span class="fontForum ">
					<a href="#forum/member">Anggota</a>
				</span>
			</div>
			<div class="dropdown col-sm-2 fontForum">
				<button class="dropbtn fontForum"><?php echo $username; ?>
				</button>
			<?php 
				if($username=="Guest"){
			?>
				<div class="dropdown-content">
					<a href="#login">Masuk</a>
					<a href="#register">Daftar</a>
				</div>
			<?php
				}else{
			?>
				<div class="dropdown-content">
					<a href="#account">My Profile</a>
					<a href="#logout">Logout</a>
				</div>
			<?php
				}
			?>
			</div>
			<div class="dropdown col-sm-1">
					<img class="img-circle" src="images/fff.png" width="50px" height="50px">
				<div class="dropdown-content">
					<a href="#forum/account">Ganti Foto Profile</a>
				</div>
			</div><br>
			<div class="col-sm-12">
				<ul class="nav navbar-nav trending-menu col-sm-12">
					<li class="col-sm-2" ><a class="week" href="#">TRENDING:</a></li>
				<?php
				$i=0;
				while ($i <= 0) {
				?>
					<li class="col-sm-2"><a href="#">TOP TRENDING</a></li>
				<?php
				$i++; 
				}
				?>
				</ul>
			</div><br>
 			<div class="col-sm-12" style="height:150px">			
			<div class="col-sm-3">
				<form class="navbar-form" role="search">
    			<div class="input-group add-on">
      				<input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">
      				<div class="input-group-btn">
        				<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
      				</div>
    			</div>
 				</form>

			</div>
			<button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Add Person</button>
			<!--<div class="col-sm-9" style="margin-top: 10px">
				<a class="abtn" href="#forum/create" >
					<button type="button" class="btn btn-default btn-s">
		  				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Tulis Ulasan
					</button>	
				</a>
			</div>
			</div>-->
			<div class="col-sm-12">
		<?php
	 		//kalo data tidak ada didatabase
			if(empty($query)){
				echo "<tr><td colspan=\"6\" class='fontForum'>Data tidak tersedia</td></tr>";
			}else{
				$no = $this->uri->segment('3') + 1;
				foreach($user as $u){
		?>
			</div>
			<a href="#"><div class="col-sm-12 thread" style="padding:0px">
				<div class="col-sm-2">
				<center>
					<img src="images/fff.png" class="img-circle" width="100px" height="100px">
				</center>
				</div>
				<div class="col-sm-7">
					<h1 class="fontForum">
						<?php echo $thread_name; ?> 
					</h1>
					<div class="fontForum">by <?php echo $thread_started_by_username; ?></div>
					<p class="fontForum" align="justify">
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula 
					</p>					
				</div></a>
				<div class="col-sm-3">
				<a href="" style="padding:0px" style="padding:0px">
					<button type="button" class="btn btn-default btn-s">
						<span class="glyphicon glyphicon-star" aria-hidden="true"></span>Kasih Like
					</button>
				</a>
				<a href="#" style="padding:0px" style="padding:0px">
					<button type="button" class="btn btn-default btn-s">
						<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>Buang Ulasan
					</button>
				</a>
				</div>
			</div><br>
			<div class="col-sm-12" style="border-bottom: 1px solid #ddd;"></div>
		<?php
				$no++;
			}}
		?>
			<!---->
			<nav aria-label="Page navigation example col-sm-12">
				<ul class="pagination col-sm-12" style="padding-left: 40px">
	    			<li class="page-item"><a class="page-link" ><?php echo $this->pagination->create_links();?></a></li>
	    			<!-- <li class="page-item"><a class="page-link" href="#">1</a></li>
	    			<li class="page-item"><a class="page-link" href="#">2</a></li>
	    			<li class="page-item"><a class="page-link" href="#">3</a></li>
	    			<li class="page-item"><a class="page-link" href="#">Next</a></li> -->
	  			</ul>
			</nav>
		</div>
	</div>
</div>
<script type="text/javascript">

</script>
</body>
</html>
<?php
include 'footer.php';
?>
