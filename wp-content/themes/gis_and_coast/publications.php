<?php
/*
Template Name: Publications
*/
?>
<?php get_header(); 

$authors = Array();
$authorsName = array();

?>
<section id="publications">
	
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-9 border">
					<?php 
						$args = array(
							'category'         => 23,
							'orderby'          => 'date',
							'order'          => 'DESC',
							'numberposts'       => -1,
							'suppress_filters' => 0 
						);
						$posts = get_posts( $args );
						foreach ( $posts as $post ) : setup_postdata( $post );
							$publicaton = $post;

							// $connected = p2p_type( 'posts_to_posts' )->get_connected( $post->ID );
							$connected = new WP_Query( array(
							  'connected_type' => 'posts_to_posts',
							  'connected_items' =>  $post->ID,
							  'nopaging' => true,
							));
							if ( $connected->have_posts() ) :
								while ( $connected->have_posts() ) : $connected->the_post();
									if(!in_array(get_the_title(),$authorsName)){
										array_push($authors,array('title' => get_the_title(), 'permalink' => get_the_permalink(), 'email' => get_post_meta($post->ID,"Miembro - email")));
										array_push($authorsName,get_the_title());
									}
								endwhile;
								// wp_reset_postdata();
							endif;
							$post = $publicaton;
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

			</div>
			<div class="col-sm-12 col-md-3">
				<div class="tags">
					<h3><?echo __('Etiquetas','gis')?></h3>
					<?php 
						if(ICL_LANGUAGE_CODE == "es"){
							$args = array('categories' => '23');
						}else{
							$args = array('categories' => '24');
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
									echo get_avatar( $author["email"][0], 32 );
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