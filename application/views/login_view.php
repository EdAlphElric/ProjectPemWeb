<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/login.css">
<?php echo form_open('user/login');?>
<div class="base-grid forum fade1">
  <div class="layer fade2 layerdiv" >
    <div class="nothing" ></div>
    <div class="col-sm-1"></div>
    <div class="login-page">
      <div class="form">
        <form class="login-form" method="GET">
            <input type="text" name="user_nama" placeholder="nama user"/>
            <input type="password" name="user_pass" placeholder="kata sandi"/>
            <input type="submit" class="button" value="Sign in" />
            <p class="message">Not registered? <a href="<?php echo base_url();?>user">Create an account</a></p>

        </form>
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>
