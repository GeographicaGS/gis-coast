<?php
/*
Template Name: Investigation
*/
?>

<?php get_header(); ?>

  <section id="investigation">
  	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<h1 class="sectionTitle"><?=get_the_title();?></h1>
			</div>
		</div>
	</div>	

  	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<?php the_content(); ?>
				
				<div class="clear"></div>
				<div class="tags">
					<?php if(ICL_LANGUAGE_CODE == "es"){ ?>
						<a class="group" href="<?=get_page_link(211)?>"><?echo __('Miembros del grupo','gis')?></a>
					<?php }else if(ICL_LANGUAGE_CODE == "en"){ ?>
						<a class="group" href="<?=get_page_link(213)?>"><?echo __('Miembros del grupo','gis')?></a>
					<?php } ?>
					
				</div>

				<div class="share">
					<span><?echo __('Compartir en','gis')?></span>
					<a target="_blank" class="twitter" href="http://www.twitter.com/share?url=<?=get_permalink( $post->ID );?>">
						<img src="<?=get_stylesheet_directory_uri().'/images/share_tw.svg'?>" alt="">
					</a>
					<a target="_blank" class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?=get_permalink( $post->ID );?>">
						<img src="<?=get_stylesheet_directory_uri().'/images/share_fb.svg'?>" alt="">
					</a>
					<a target="_blank" class="google" href="https://plus.google.com/share?url=<?=get_permalink( $post->ID );?>">
						<img src="<?=get_stylesheet_directory_uri().'/images/share_gp.svg'?>" alt="">
					</a>
				</div>

			</div>
		</div>
	</div>
  </section>

<?php get_footer(); ?>