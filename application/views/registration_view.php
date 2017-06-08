<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/login.css">
 <?php echo validation_errors('<p class="error">'); ?>
 <?php echo form_open("user/registration"); ?>
  <div class="base-grid forum fade1">
    <div class="layer fade2 layerdiv" style="height: 800px" >
      <div class="nothing" ></div>
      <div class="col-sm-1"></div>
      <div class="login-page">
        <div class="form">
          <form class="login-form" method="POST">
            <input type="text" name="user_nama" placeholder="nama user"/>
            <input type="password" name="user_pass" placeholder="Kata Sandi"/>
            <input type="text" name="user_email" placeholder="email"/>
            <input type="text" name="user_telp" placeholder="telepone"/>
            <input type="text" name="user_kota" placeholder="Kota"/>
            <input type="submit" class="button" value="Submit" />
            <p class="message">Already registered? <a href="user/login_page">Sign In</a></p>
          </form>
        </div>
    </div>
  </div>
 <?php echo form_close(); ?>
</div><!--<div class="reg_form">-->
</div><!--<div id="content">-->