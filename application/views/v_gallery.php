<?php
	include 'header.php';
?>
<!DOCTYPE html>
  <head>
    <title>Gallery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="<?php echo base_url(); 
   ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); 
   ?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); 
   ?>assets/css/templatemo_misc.css">
    <link href="<?php echo base_url(); 
   ?>assets/css/templatemo_style.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,600' rel='stylesheet' type='text/css'>
    <script src="<?php echo base_url(); 
   ?>assets/js/jquery-1.10.2.min.js"></script> 
    <script src="<?php echo base_url(); 
   ?>assets/js/jquery.lightbox.js"></script>
    <script src="<?php echo base_url(); 
   ?>assets/js/templatemo_custom.js"></script>
  </head>
  <body>
  	<div class="site-header fade1">
      <div id="menu-container">
      <!-- gallery start -->
        <div class="content gallery" id="menu-1">
        <div class="layer fade2">
          <div class="container fade3">
            <div class="row templatemorow">
              <div class="col-md-12" style="height: 250px"></div>

        <?php
          for ($j=1; $j <= 3; $j++) { 
        ?>
          <?php 
            for ($i=1; $i <= 5; $i++) { 
          ?>
              <div class="hex col-sm-6">
                <div>
                  <div class="hexagon hexagon2 gallery-item">
                    <div class="hexagon-in1">
                      <div class="hexagon-in2" style="background-image: url(images/fff.png);">
             	 	        <div class="overlay">
						              <a href="images/gallery/<?php echo $i;?>.png" ></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          <?php
            }
          ?>

              <div class="hex col-sm-6 hex-offset templatemo-hex-top1 templatemo-hex-top1">
                <div>
                  <div class="hexagon hexagon2 gallery-item">
                    <div class="hexagon-in1">
                      <div class="hexagon-in2" style="background-image: url(images/fff.png);">
              		      <div class="overlay">
						              <a href="images/gallery/6.jpg" ></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          
          <?php
            for ($i=7; $i <=9  ; $i++) { 
          ?>
              <div class="hex col-sm-6 templatemo-hex-top1 templatemo-hex-top2">
                <div>
                  <div class="hexagon hexagon2 gallery-item">
                    <div class="hexagon-in1">
                      <div class="hexagon-in2" style="background-image: url(images/fff.png);">
              		      <div class="overlay">
						              <a href="images/fff.png" ></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          <?php
            }
          ?>
          <div class="col-md-12 nothingGallery"></div>
        <?php
          }
        ?>
            </div> 
          </div>
        </div>
        </div>
      </div>
    </div>
  </body>
</html>
<?php
	include 'footer.php';
?>