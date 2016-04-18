<?php
/*
Template Name: Proyects
*/

$authors = Array();
$authorsName = array();

?>

<?php get_header(); ?>
<section id="projects">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<h1 class="sectionTitle"><?=get_the_title();?></h1>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-9 border">
				<?php 
					$args = array(
						'category'         => 21,
						'orderby'          => 'date',
						'order'          => 'DESC',
						'numberposts'       => -1,
						'suppress_filters' => 0 
					);
					$posts = get_posts( $args );
					foreach ( $posts as $post ) : setup_postdata( $post );
						$reference = get_post_meta($post->ID,"Proyecto - Referencia");
						$period = get_post_meta($post->ID,"Proyecto - Ambito y periodo");

						$project = $post;

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
						$post = $project;
				?>	
					<article>
						<a href="<?=the_permalink()?>">
							<div class="project">
								<div class="fleft">
									<?php the_post_thumbnail(); ?>
								</div>
								<div class="project-content">
									<?php if($reference){?>
										<span class="reference"><?=$reference[0]?></span>
									<?php } ?>
									<h3><?=$post->post_title?></h3>
									<p><?=get_the_excerpt()?></p>
									<?php if($period){?>
										<span class="period"><?=$period[0]?></span>
									<?php } ?>
								</div>
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
							$args = array('categories' => '21');
						}else{
							$args = array('categories' => '22');
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
					<h3><?echo __('Participantes','gis')?></h3>
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