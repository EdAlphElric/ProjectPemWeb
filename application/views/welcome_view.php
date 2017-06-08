<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/login.css">
  <div class="base-grid forum fade1">
    <div class="layer fade2 layerdiv" style="height: 800px" >
      <div class="nothing" ></div>
      <div class="col-sm-1"></div>
      <div class="login-page">
        <div class="col-sm-12 fontForum">
          <div class="content">
            <h2>Welcome Back, <?php echo $this->session->userdata('user_nama'); ?>!</h2>
            <p>This section represents the area that only logged in members can access.</p>
            <h4><?php echo anchor('user/logout', 'Logout'); ?></h4>
          </div><!--<div class="content">-->
        </div>
    </div>
  </div>
</div><!--<div class="reg_form">-->
</div><!--<div id="content">-->