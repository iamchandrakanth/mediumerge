<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
	<meta charset="<?php bloginfo('charset') ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>
	<title><?php wp_title(); ?></title>
</head>
<body <?php body_class() ?>>
	
<!-- Begin Nav
================================================== -->

<nav class="navbar navbar-toggleable-md navbar-light bg-white fixed-top mediumnavigation min-height: 32px;">

<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="container">
	<!-- Begin Logo -->
	
	
	
	<!--End Logo -->
	  
	<a class="navbar-brand" href="<?php echo get_site_url(); ?>">
	<?php 
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
		echo '<img src="' . esc_url( $custom_logo_url ) . '" alt="logo">'; 
	?></a>

	<div class="collapse navbar-collapse" id="navbarsExampleDefault">
		<ul class="navbar-nav ml-auto">
			<?php
      	wp_nav_menu( array(
        'theme_location'  => 'topnav',
        'menu'            =>'topnav',
        'container'       => 'div', 
        'container_class' => 'collapse navbar-collapse', 
        'container_id'    => 'navbarsExampleDefault',
        'menu_class'      => 'menu', 
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'items_wrap'      => '<ul class="nav justify-content-end w-100 %2$s">%3$s</ul>',
        'depth'           => 0
      ) );
    ?>
 
		 </ul>		


		<!-- Begin Search -->
		<form class="form-inline my-2 my-lg-0">
			<input class="form-control mr-sm-2" type="text" placeholder="Search" method="get" id="searchform" value="" name="s" id="s" action="<?php echo home_url( '/' ); ?>">

			<span class="search-icon"><svg class="svgIcon-use" width="25" height="25" ><path d="M20.067 18.933l-4.157-4.157a6 6 0 1 0-.884.884l4.157 4.157a.624.624 0 1 0 .884-.884zM6.5 11c0-2.62 2.13-4.75 4.75-4.75S16 8.38 16 11s-2.13 4.75-4.75 4.75S6.5 13.62 6.5 11z"></path></svg></span>
		</form>
		<!-- End Search -->
	</div>
</div>
</nav>
<!-- End Nav
================================================== -->

<!-- Begin Site Title
================================================== -->
<div class="container">
	<!--
	<div class="mainheading">
		<h1 class="sitetitle"><a href="<?php echo get_site_url(); ?>"> <?php echo bloginfo( 'name' ); ?> </a></h1>
		<p class="lead">
			 <?php echo get_bloginfo( 'description' ); ?>
		</p>
	</div>
	-->
<!-- End Site Title
================================================== -->

</body>
</html>