<!DOCTYPE html>
<html lang="en">
	<head>
	  <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
	  <title>
		<?php if(is_front_page()) 
				bloginfo('name'); 
			else 
				wp_title(''); ?>
	  </title>
	  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css">
	  <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">
	  <link rel="stylesheet" type="text/css" media="print" href="<?php bloginfo('template_directory'); ?>/print.css">
	  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-1.10.2.min.js"></script>
	  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/bootstrap.min.js"></script>
	  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.columnizer.js"></script>
	  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/custom.js"></script>
	  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/respond.min.js"></script>
	  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/respond.matchmedia.addListener.min.js"></script>
	  <script type="text/javascript" src="//use.typekit.net/gfb2mjm.js"></script>
	  <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	  
		<?php wp_head();?>
		
	</head>


	<body>
		<div id="overflow-wrap">
			<div id="fixbar">
				<div id="mininav">
				
					<div class="iconblock">
						<a><span id="menuicon" class="glyphicon glyphicon-align-justify"></span>
						</a>
					</div> <!-- end menu iconblock -->
					
					<div id="neglogo">
						<a alt="CSUN Home Page" href="http://www.csun.edu/">
							<img alt="California State Univerity, Northridge" src="<?php bloginfo('template_directory'); ?>/img/negative-logo.png">
						</a> 
					</div> <!-- end neglogo -->
					
					<div class="iconblock">
						<a ><span id="searchicon" class="glyphicon glyphicon-search right"></span></a>
					</div><!-- end search iconblock -->
					
				</div> <!-- end mininav -->
				
				<div class="container" id="headerbar">
					<div class="row">
					
						<div class="col-sm-4 col-lg-4 headerbar-logo">
							<a alt="CSUN Home Page" href="http://www.csun.edu/"> 
								<img alt="California State Univerity, Northridge" src="<?php bloginfo('template_directory'); ?>/img/logo.png" id="logo">
							</a> 
						</div>
						
						<div class="col-xs-12 col-sm-8 col-lg-8">
						
							<div class="row" id="quicklinks">
								<ul class="right">
									<li><a href="#">Quicklinks</a><div class="arrow-down"></div></li>
								</ul>
							</div>
							
							<div class="row" id="quicklinks-lg">
								<ul class="right">
									<li ><a href="#skipstuff">Skip Nav</a></li>
									<li ><a href="http://www.csun.edu/universaldesigncenter">Accessibility</a></li>
									<li ><a href="http://www.csun.edu/calendar/">Calendar</a></li>
									<li ><a href="https://www.csun.edu/peoplefinder/">People Finder</a></li>
									<li ><a href="http://www.csun.edu/atoz/">A to Z</a></li>
									<li ><a href="https://www.csun.edu/webmail/">Webmail</a></li>
								</ul>
							</div>
							
							<div id ="search-div" class="hideme">
								<form class="navbar-form search-form clearfix" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
									<label for="s">Search Catalog:</label>
									<div id="csunsearch" class="input-group ">
										<input type="text" class="form-control" placeholder="Search Catalog" name="s" id="s">
										<div class="input-group-btn">
											<button id="searchsubmit" class="btn btn-default" type="submit"><span alt="Search the catalog" class="glyphicon glyphicon-search"></span> Search</button>
										</div>
									</div>
								</form>
							</div>
							
						</div>  <!-- end collumn -->
					</div>   <!-- end row -->
				</div> <!-- end container -->
				<div id="csunnav" class="hideme">
					<div class="container clearfix">
					<?php
						$defaults = array(
							'theme_location'  => '',
							'menu'            => '',
							'container'       => 'div',
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => 'menu',
							'menu_id'         => '',
							'echo'            => true,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'           => 0,
							'walker'          => ''
						);
						wp_nav_menu( $defaults );
					?>
					</div>
				</div> <!-- end csunnav -->
			</div> <!-- end fixbar -->

			<!-- Banner -->

			<?php if ( is_front_page() ) : ?>

				<div class="row" id="full-banner">
					<div class="banner-overlay">
						<div class="container">
						  <a href="<?php echo site_url(); ?>"><h1 class="banner-title"></br>UNIVERSITY CATALOG <span class="banner-title-small">2014-2015</span></h1></a>
						</div>
					</div>
				</div>

			<?php else : ?>

				<div class="row" id="full-banner-inner">
					<div class="banner-overlay">
						<div class="container">
							<a href="<?php echo site_url(); ?>"><h1 class="banner-title-inner">UNIVERSITY CATALOG <span class="banner-title-small">2014-2015</span></h1></a>
						</div>
					</div>
				</div>

			<?php endif; ?>
			
			<div id="skipstuff"></div>
