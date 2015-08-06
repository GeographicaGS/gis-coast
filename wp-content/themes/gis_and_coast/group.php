<?php
/*
Template Name: Group
*/
?>

<?php get_header(); ?>
<section id="post" class="group">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<h1><?echo __('Grupo de investigación','gis')?> <span class="text_italic">GIS and Coast</span></h1>
				<?php
					$subTitle = get_post_meta($post->ID,"Subtítulo");
					if($subTitle){
				?>
					<h3><?=$subTitle[0]?></h3>
				<?php } ?>
				
				<div class="tags">
					<?php if(ICL_LANGUAGE_CODE == "es"){ ?>
						<a class="line" href="<?=get_page_link(171)?>"><?echo __('Líneas de investigación','gis')?></a>
						<a class="group" href="<?=get_page_link(211)?>"><?echo __('Miembros del grupo','gis')?></a>
					<?php }else if(ICL_LANGUAGE_CODE == "en"){ ?>
						<a class="line" href="<?=get_page_link(173)?>"><?echo __('Líneas de investigación','gis')?></a>
						<a class="group" href="<?=get_page_link(213)?>"><?echo __('Miembros del grupo','gis')?></a>
					<?php } ?>
					
				</div>


				<div class="content">
					<?php the_content(); ?>
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