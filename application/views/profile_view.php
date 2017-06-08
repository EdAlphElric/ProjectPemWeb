<?php
        if($this->session->userdata('user_nama')!=null){
            $user_nama = $this->session->userdata('user_nama');
        }else{
            $user_nama = "Guest";
        }
?>
<div class="base-grid account fade1">
	<div class="layer fade2 layer-forum"  >
		<div class="nothing" ></div>
		<div class="col-sm-1"></div>
		<div class="list col-sm-10 " style="animation: fadein08 5s;">
			<div class="col-sm-9 ">
				<span class="fontForum">
					<a href="#forum"> Forum</a>
				</span>
			</div>
			<div class="col-sm-1 ">
				<span class="fontForum ">
					<a href="#member"> Anggota</a>
				</span>
			</div>
			<div class="dropdown col-sm-2 fontForum">
				<button class="dropbtn fontForum"><?php echo $user_nama; ?>
				</button>
			<?php 
				if($user_nama=="Guest"){
			?>
				<div class="dropdown-content">
					<a href="<?php echo base_url(); ?>user/login_page">Masuk</a>
					<a href="<?php echo base_url(); ?>user/login">Daftar</a>
				</div>
			<?php
				}else{
			?>
				<div class="dropdown-content">  
					<a href="<?php echo base_url(); ?>user/login_page">My Profile</a>
					<a href="<?php echo base_url(); ?>user/logout">Logout</a>
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
			<div class="coverimage">
				<div class="coverimage">
			    	<img class="profilePicture" src="images/fff.png" style="width: 100%; height: 400px" />
				</div>
			  <img class="profilePicture displayPicture img-circle " src="images/fff.png" />
			</div><br>
			<div class="col-sm-12" style="height: 75px">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<a class="abtn" href="#">
					<button type="button" class="btn btn-default btn-s">
		  				<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Kirim Pesan
					</button>
					</a>
					<a class="abtn" href="#">
					<button type="button" class="btn btn-default btn-s">
		  				<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Keranjang Belanja
					</button>
					</a>
					<a class="abtn" href="#forum/create">
					<button type="button" class="btn btn-default btn-s">
		  				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Tulis Ulasan
					</button>	
					</a>
				</div>
			</div>
			<div class="col-sm-9">
			<?php
			$i=0;
			while ($i <= 5) {
			?>
				<div class="col-sm-12" style="height: 90px">
					<div class="col-sm-2">
						<img class="picturePost img-circle " src="images/fff.png" />
					</div>
					<a  href="#">
						<div class="col-sm-10 fontForum">
								LOREM IPSUM 
							<p class="fontForum" align="justify">
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
							</p>	
						</div>
					</a>
				</div><br>
			<?php 
			$i++; 
			}
			?>
			</div>
			<div class="col-sm-3 ">
				<div class="col-sm-12 infoAccount info">
					<div class="col-sm-12"><h2><?php echo $user_nama; ?></h2></div>
					<div class="col-sm-12"><H2>Informasi</H2></div>
					<h4><div class="col-sm-4">Lokasi</div><div class="col-sm-8"><?php echo $user_kota; ?></div><br>
					<div class="col-sm-4">Saldo</div><div class="col-sm-8"><?php echo $user_saldo; ?></div><br>
					<h4><div class="col-sm-4">Date</div><div class="col-sm-8"><?php echo $user_join; ?></div></h4>
					<h4><div class="col-sm-4">Logged?</div><div class="col-sm-8">
						<?php 
							if($logged_in != 'TRUE'){
						?>
								<div class="glyphicon glyphicon-check">Online</div>
						<?php
							}else{
						?>
								<div class="glyphicon glyphicon-unchecked">Offline</div> 
						<?php
							}
						?>
					</div></h4>
					<h4><div class="col-sm-4">Status</div><div class="col-sm-8">
						<?php 
							if($user_status != 'Active'){
						?>
								<div class="glyphicon glyphicon-remove">Banned</div>
						<?php
							}else{
						?>
								<div class="glyphicon glyphicon-ok">Active</div> 
						<?php
							}
						?>
					</div></h4>
				</div>
				</div>

				
				</div>
			</div>
		</div>
	</div>
</div>