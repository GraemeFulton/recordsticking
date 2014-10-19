<div class="navbar-wrapper">
<nav class="navbar navbar-default" role="navigation">
  <div class="container menu-container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header col-md-3">
        <a class="navbar-brand" href="<?php bloginfo('url')?>"><img class="navbar-logo"src="<?php echo plugins_url('images/logo.png', __FILE__);?>"/></a>        
         <!--Mobile Navigation-->
       <div class="container-fluid" style="text-align:center">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
       </div>
    <!--Mobile Navigation-->
 
    </div>
  
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse col-md-8" id="navbar-collapse">
                 <?php /* Primary navigation */
   wp_nav_menu( array(
        'menu'              => 'top_menu',
        'theme_location'    => 'primary',
        'depth'             => 2,
        'container'         => false,
        'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
        'menu_class'        => 'nav navbar-nav',
        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
        'walker'            => new wp_bootstrap_navwalker())
    );?>
       
        
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>