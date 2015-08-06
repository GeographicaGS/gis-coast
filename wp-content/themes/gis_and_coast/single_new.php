<?php get_header(); ?>
<section id="post">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="authorInfo">
					<?php
						$connected = p2p_type( 'posts_to_posts' )->get_connected( $post->ID );
						if ( $connected->have_posts() ) :
							while ( $connected->have_posts() ) : $connected->the_post();
								$email = get_post_meta($post->ID,"Miembro - email");
					?>
									<a href="<?=the_permalink()?>">
										<?php if($email){
											echo get_avatar( $email[0], 32 );
										}?>
										<span class="author"><?=the_title()?></span>
									</a>
					<?php
							endwhile;
							wp_reset_postdata();
						endif;
					?>



					<?php //echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
					<!-- <span class="author"><?=get_the_author()?></span>-->
					<span class="time">
						<?= short_time_diff(get_the_time('U'),current_time('timestamp')) ?>
					</span>
				</div>
				<h1><?=$post->post_title?></h1>
				<?php
					$subTitle = get_post_meta($post->ID,"Subtítulo");
					if($subTitle){
				?>
					<h3><?=$subTitle[0]?></h3>
				<?php } ?>
			
				<?php 
					$tags = wp_get_post_tags($post->ID);
					if($tags){
					?>
					<div class="tags">
						<span><?echo __('Etiquetado en','gis')?></span>
					<?php
						foreach ( $tags as $tag ) :
					?>
						<a href="<?=get_tag_link($tag->term_id)?>">
							<?=$tag->name?>
						</a>
					<?php endforeach;?>
					</div>
					<div class="clear"></div>
					<?php } ?>
				
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