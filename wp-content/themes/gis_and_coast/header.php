<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset=	<?php bloginfo( 'charset' ); ?>">
	<title><?php wp_title(); ?></title>

	<!-- Definir viewport para dispositivos web móviles -->
	<meta name="viewport" content="width=device-width, minimum-scale=1">
	<link rel="stylesheet" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>

</head>

<body>
	<div class="wrapper">
		<header>
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<a href="<? echo esc_url( home_url( '/' ) ); ?>"><img class="logo" width="183px" src="<?=get_stylesheet_directory_uri().'/images/GaC_logo_cab.png'?>"></a>
						<div class="fright">
							<ul class="languageSelector visible-md-block">
								<?php if(ICL_LANGUAGE_CODE == "es"){ ?>
									<li>
										<?echo __('Idioma','gis')?>
									</li>
									<li>
										<a href="<?=site_url()?>/en/"> <?echo __('Inglés','gis')?></a>
									</li>
									<li class="active">
										<a href="<?=site_url()?>/"> <?echo __('Español','gis')?></a>
									</li>
								<?php }else if(ICL_LANGUAGE_CODE == "en"){ ?>
									<li>
										<?echo __('Idioma','gis')?>
									</li>
									<li class="active">
										<a href="<?=site_url()?>/en/"> <?echo __('Inglés','gis')?></a>
									</li>
									<li>
										<a href="<?=site_url()?>/"> <?echo __('Español','gis')?></a>
									</li>
								<?php } ?>
							</ul>
							<span class="fleft size_12 uds-caption"><?echo __('Grupo de investigación HUM-738','gis')?><br><?echo __('Universidad de Sevilla','gis')?><br><?echo __('PAIDI. Junta de Andalucía','gis')?></span>
							<img class="logoUni" width="53px" src="<?=get_stylesheet_directory_uri().'/images/GaC_logo_US_cab.png'?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-12 menu-wrapper">
						<button type="button" class="navbar-toggle visible-sm" data-toggle="collapse" data-target=".navbar-ex1-collapse">
	
							<div class="icon-bar-container">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</div>
							<span class="txtBtn">Menu</span>
						</button>
					
						<ul class="languageSelector visible-sm">
								<?php if(ICL_LANGUAGE_CODE == "es"){ ?>
									<li>
										<?echo __('Idioma','gis')?>
									</li>
									<li>
										<a href="<?=site_url()?>/en/"> <?echo __('Inglés','gis')?></a>
									</li>
									<li class="active">
										<a href="<?=site_url()?>/"> <?echo __('Español','gis')?></a>
									</li>
								<?php }else if(ICL_LANGUAGE_CODE == "en"){ ?>
									<li>
										<?echo __('Idioma','gis')?>
									</li>
									<li class="active">
										<a href="<?=site_url()?>/en/"> <?echo __('Inglés','gis')?></a>
									</li>
									<li>
										<a href="<?=site_url()?>/"> <?echo __('Español','gis')?></a>
									</li>
								<?php } ?>
							</ul>
							<?php wp_nav_menu( array('menu' => 'Main', 'container' => 'nav' )); ?>
					</div><!-- menu -->
				</div><!-- row -->
			</div>
		</header>

		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-66042906-1', 'auto');
		  ga('send', 'pageview');

		</script>
