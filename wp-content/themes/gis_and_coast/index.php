<?php get_header(); ?>

  <section id="home">
	
	<?php putRevSlider("slider_" . ICL_LANGUAGE_CODE) ?>

	<div class="container-fluid init">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	
	<div class="news">
		<div class="container news">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<h3><?echo __('Últimas novedades','gis')?></h3>
				</div>
			</div>

			<div class="row articleList">
				<?php 
					$args = array(
						'category'         => 4,
						'orderby'          => 'date',
						'order'          => 'DESC',
						'posts_per_page' => 4,
						'suppress_filters' => 0 
					);
					$posts = get_posts( $args );
					foreach ( $posts as $post ) : setup_postdata( $post );
				 ?>
				<div class="col-sm-6 col-md-4 col-lg-3">
					<a href="<?=the_permalink()?>">
						<article>
							<div class="img" style="background-image:url(<?=wp_get_attachment_url( get_post_thumbnail_id($post->ID))?>)"></div>
							<h2><?=$post->post_title?></h2>
							<p><?=get_the_excerpt()?></p>
							<?php 
								$connected = p2p_type( 'posts_to_posts' )->get_connected( $post->ID );
								if ( $connected->have_posts() ) :
									while ( $connected->have_posts() ) : $connected->the_post();
							?>
										<a href="<?=the_permalink()?>">
											<span class="author"><?=the_title();?></span>
										</a>
							<!-- <span class="author"><?=get_the_author_meta("first_name") . " " . get_the_author_meta("last_name")?></span> -->
							<?php 
									endwhile;
									wp_reset_postdata();
								endif;
							?>
							<span class="time"><?= short_time_diff( get_the_time('U'), current_time('timestamp')) ?></span>
						</article>
					</a>
				</div>
				<?php 
					endforeach;
					wp_reset_postdata();
				?>
			</div>

			<div class="row moreNews">
				<div class="col-sm-12 col-md-12">
					<?php if(ICL_LANGUAGE_CODE == "es"){ ?>
						<a href="<?=get_page_link(9)?>"><?echo __('Más novedades','gis')?></a>
					<?php }else if(ICL_LANGUAGE_CODE == "en"){ ?>
						<a href="<?=get_page_link(57)?>"><?echo __('Más novedades','gis')?></a>
					<?php } ?>
				</div>		
			</div>

		</div>
	</div>

  </section> 

  <?php get_footer(); ?>
