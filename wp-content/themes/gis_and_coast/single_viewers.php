<?php 

get_header(); 

$urlViewer = get_post_meta($post->ID,"Visor - web");

?>
<section id="post" class="singleProject">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="header <?if(has_post_thumbnail()){echo "maxWidth";}?>">
					<div class="authorInfo">
					</div>
					<h1><?=$post->post_title?></h1>
					<h3><?=$post->post_excerpt?></h3>
				</div>
				
				<div class="clear"></div>
				<div class="tags pb">
					<?php 
						$tags = wp_get_post_tags($post->ID);
						foreach ( $tags as $tag ) :
					?>
						<a href="<?=get_tag_link($tag->term_id)?>">
							<?=$tag->name?>
						</a>
					<?php 
						endforeach;
					?>
					<?php if($urlViewer){?>
						<div class="extra">
							<?php if($urlViewer){?>
								<a class="pdf" target="_blank" href="<?=$urlViewer[0]?>"><?echo __('Acceder al visor','gis')?></a>
							<?php } ?>
						</div>
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