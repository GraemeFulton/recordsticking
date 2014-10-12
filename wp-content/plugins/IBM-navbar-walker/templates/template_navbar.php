<div class="navbar-wrapper">
<nav class="navbar navbar-default" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      
    <!--Mobile Navigation-->
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    <!--Mobile Navigation-->

        <a class="navbar-brand" href="<?php bloginfo('url')?>"><img class="navbar-logo"src="<?php echo plugins_url('images/logo.png', __FILE__);?>"/></a>        
    </div>
 
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-collapse">
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

      <ul class="nav navbar-nav navbar-right">
          
        <li class="dropdown">
            <a href="#" class="dropdown-toggle user-profile-nav" data-toggle="dropdown"><div style="margin-right: 19px;margin-top:9px;float:left">Log In</div> 
                <div style="float:left; margin-top:-4px;">  <?php global $userdata;  get_currentuserinfo(); echo get_avatar( $userdata->ID, 46 ); ?></div>

              <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
       
        
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>