<?php
/*
Template Name: Viewers
*/
?>
<?php get_header(); ?>
<section id="viewers">
	
	<div class="container">
		<div class="row">
			<div class="col-sm-9 col-md-9 border">
					<?php 
						$args = array(
							'category'         => 25,
							'orderby'          => 'date',
							'order'          => 'DESC',
							'suppress_filters' => 0 
						);
						$posts = get_posts( $args );
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

			</div>
			<div class="col-sm-3 col-md-3">
				<div class="tags">
					<h3><?echo __('Etiquetas','gis')?></h3>
					<?php 
						if(ICL_LANGUAGE_CODE == "es"){
							$args = array('categories' => '25');
						}else{
							$args = array('categories' => '26');
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