<?php get_header(); 

$news = Array();
$projects = Array();
$publications = Array();
$viewers = Array();

foreach ( $posts as $post ):
	
	$category = get_the_category()[0]->term_id;
	if($category == 4 || $category == 5){
		array_push($news,$post);
	}else if($category == 21 || $category == 22){
		array_push($projects,$post);
	}else if($category == 23 || $category == 24){
		array_push($publications,$post);
	}else if($category == 25 || $category == 26){
		array_push($viewers,$post);
	}

endforeach;
wp_reset_postdata();
	
?>

<section id="tag">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-9 border">
				<?php if(count($news) > 0){ ?>
					<section id="news">
						<h2 class="title"><?echo __('Novedades para','gis')?> <span><?=single_tag_title()?></span></h2>
						<?php 
							foreach ( $news as $new ) : setup_postdata($post);
						?>
							<article>
								<a href="<?=get_the_permalink($new->ID)?>">
									<div class="img" style="background-image:url(<?=wp_get_attachment_url( get_post_thumbnail_id($new->ID))?>)"></div>

									<?php 
										$connected = p2p_type( 'posts_to_posts' )->get_connected( $new->ID );
										if ( $connected->have_posts() ) :
											while ( $connected->have_posts() ) : $connected->the_post();
											?>
												<a class="author" href="<?=the_permalink()?>">
													<?=the_title()?>
												</a>
											<?php
											endwhile;
											// wp_reset_postdata();
										endif;
										$post = $new;
									 ?>
									<span class="time">
										<?= short_time_diff( get_the_time('U'), current_time('timestamp')) ?>
									</span>
									<h2><?=$post->post_title?></h2>
									<p><?=get_the_excerpt()?></p>
									<span class="continue"><?echo __('Seguir leyendo','gis')?></span>
								</a>
							</article>
							
						<?php 
							endforeach;
							wp_reset_postdata();
						?>
					</section>
				<?php } ?>

				<?php if(count($projects) > 0){ ?>
					<section id="projects">
						<h2 class="title"><?echo __('Proyectos para','gis')?> <span><?=single_tag_title()?></span></h2>
						<?php 
							$posts = $projects;
							foreach ( $posts as $post ) : setup_postdata( $post );
								$reference = get_post_meta($post->ID,"Proyecto - Referencia");
								$period = get_post_meta($post->ID,"Proyecto - Ambito y periodo");
						?>
								<a href="<?=the_permalink()?>">
									<div class="project">
										<?php the_post_thumbnail(); ?>
										<div class="clear"></div>
										<?php if($reference){?>
											<span class="reference"><?=$reference[0]?></span>
										<?php } ?>
										<h3><?=$post->post_title?></h3>
										<p><?=get_the_excerpt()?></p>
										<?php if($period){?>
											<span class="period"><?=$period[0]?></span>
										<?php } ?>
									</div>
								</a>

						<?php 
							endforeach;
							wp_reset_postdata();
						?>
					</section>
					<div class="clear"></div>
				<?php } ?>

				<?php if(count($publications) > 0){ ?>
					<section id="publications">
						<h2 class="title"><?echo __('Publicaciones para','gis')?> <span><?=single_tag_title()?></span></h2>
						<?php 
							$posts = $publications;
							foreach ( $posts as $post ) : setup_postdata( $post );
						?>
							<article>
								<a href="<?=the_permalink()?>">
									<div class="thumbnailPublication">
										<?php the_post_thumbnail(); ?>
									</div>
									<div class="<?if(has_post_thumbnail()){echo "textPublication";}?>">
										<h2><?=$post->post_title?></h2>
										<p><?=get_the_excerpt()?></p>
										<span class="continue"><?echo __('Consultar publicación','gis')?></span>
									</div>
								</a>
							</article>
						<?php 
							endforeach;
							wp_reset_postdata();
						?>
					</section>
				<?php } ?>

				<?php if(count($viewers) > 0){ ?>
					<section id="viewers">
						<h2 class="title"><?echo __('Visores para','gis')?> <span><?=single_tag_title()?></span></h2>
						<?php 
							$posts = $viewers;
							foreach ( $posts as $post ) : setup_postdata( $post );
						?>
							<article>
								<a href="<?=the_permalink()?>">
									<h2><?=$post->post_title?></h2>
									<p><?=get_the_excerpt()?></p>
									<span class="continue"><?echo __('Consultar visor','gis')?></span>
								</a>
							</article>
						<?php 
							endforeach;
							wp_reset_postdata();
						?>
					<section></section>
				<?php } ?>
			</div>

			<div class="col-sm-12 col-md-3">
				<div class="tags">
					<h3><?echo __('Etiquetas','gis')?></h3>
					<?php 
						if(ICL_LANGUAGE_CODE == "es"){
							$args = array('categories' => '4,21,23,25');
						}else{
							$args = array('categories' => '5,22,24,26');
						}
						$tags = get_category_tags($args);
						foreach ( $tags as $tag ) :
					?>
						<a href="<?=$tag->tag_link?>">
							<?=$tag->tag_name?>
						</a>
					<?php 
						endforeach;
					?>
				</div>
			</div>

		</div>
	</div>
</section>

<?php get_footer(); ?>