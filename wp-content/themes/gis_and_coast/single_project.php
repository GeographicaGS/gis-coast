<?php 

get_header(); 

$reference = get_post_meta($post->ID,"Proyecto - Referencia");
$period = get_post_meta($post->ID,"Proyecto - Ambito y periodo");
$web = get_post_meta($post->ID,"Proyecto - Web");

?>
<section id="post" class="singleProject">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="header <?if(has_post_thumbnail()){echo "maxWidth";}?>">
					<div class="authorInfo">
						<?php if($reference){?>
							<span class="size_13"><?=$reference[0]?></span>
						<?php } ?>
					</div>
					<h1><?=$post->post_title?></h1>
					<h3><?=$post->post_excerpt?></h3>
				</div>
				<div class="thumbnail">
					<?php the_post_thumbnail(); ?>
				</div>
				<div class="clear"></div>
				<div class="tags">
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
					<?php if($period || $web){?>
						<div class="extra">
							<?php if($period){?>
								<span class="period"><?=$period[0]?></span>
							<?php } ?>
							<?php if($web){?>
								<a target="_blank" href="<?=$web[0]?>"><?echo __('Web del proyecto','gis')?></a>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
				<div class="content">
					<?php the_content(); ?>
					<div class="authors">
						<?php 
							// $connected = p2p_type( 'posts_to_posts' )->get_connected( $post->ID );
							$connected = new WP_Query( array(
							  'connected_type' => 'posts_to_posts',
							  'connected_items' =>  $post->ID,
							  'nopaging' => true,
							));
							if ( $connected->have_posts() ) :
						?>
								<h4><?echo __('Participantes en el proyecto','gis')?></h4>
						<?php 
								while ( $connected->have_posts() ) : $connected->the_post();
									$email = get_post_meta($post->ID,"Miembro - email");
						?>
									<a href="<?=the_permalink()?>">
										<?php if($email){
											echo get_avatar( $email[0], 32 );
										}?>
										<?=the_title();?>
										<span class="clear"></span>
									</a>
						<?php 
								endwhile;
								wp_reset_postdata();
							endif;
						?>
					</div>
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