<?php
/*
Template Name: News
*/
?>

<?php 

get_header(); 

$authors = Array();
$authorsName = array();
?>
<section id="news">
	
	<div class="container">
		<div class="row">
			<div class="col-sm-9 col-md-9 border">
					<?php 
						$args = array(
							'category'         => 4,
							'orderby'          => 'date',
							'order'          => 'DESC',
							'numberposts'       => -1,
							'suppress_filters' => 0 
						);
						$posts = get_posts( $args );
						foreach ( $posts as $post ) : setup_postdata( $post );
							$notice = $post;
					?>
						<article>
							<a href="<?=the_permalink()?>">
								<div class="img" style="background-image:url(<?=wp_get_attachment_url( get_post_thumbnail_id($post->ID))?>)"></div>
								<?php 
									$connected = p2p_type( 'posts_to_posts' )->get_connected( $post->ID );
									if ( $connected->have_posts() ) :
										while ( $connected->have_posts() ) : $connected->the_post();
											if(!in_array(get_the_title(),$authorsName)){
												array_push($authors,array('title' => get_the_title(), 'permalink' => get_the_permalink(), 'email' => get_post_meta($post->ID,"Miembro - email")));
												array_push($authorsName,get_the_title());
											}
										?>
											<a class="author" href="<?=the_permalink()?>">
												<?=the_title()?>
											</a>
										<?php
										endwhile;
										// wp_reset_postdata();
									endif;
									$post = $notice;
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

			</div>
			<div class="col-sm-3 col-md-3">
				<div class="tags">
					<h3><?echo __('Etiquetas','gis')?></h3>
					<?php 
						if(ICL_LANGUAGE_CODE == "es"){
							$args = array('categories' => '4');
						}else{
							$args = array('categories' => '5');
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
				<div class="clear"></div>
				<div class="authors">
					<h3><?echo __('Autores','gis')?></h3>
					<ul>
						<?php foreach ( $authors as $author ): ?>
							<li>
						<?php 
								if($author["email"]){
									echo get_avatar( $author["email"], 32 );
								}
						?>
								<a href="<?=$author["permalink"]?>">
									<?=$author["title"]?>
								</a>
							</li>
						<?php endforeach ?>
					 </ul>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>