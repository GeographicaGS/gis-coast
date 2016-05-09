<?php 

get_header(); 

$moreInfo = get_post_meta($post->ID,"Publicación - Más información");
$pdf = get_post_meta($post->ID,"Publicación - PDF");

?>

<section id="post" class="singleProject singlePublication">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="header <?if(has_post_thumbnail()){echo "maxWidth";}?>">
					<div class="authorInfo">
					</div>
					<h1><?=$post->post_title?></h1>
					<h3><?=$post->post_excerpt?></h3>
				</div>
				
				<?php if(has_post_thumbnail()){ ?>
				<div class="thumbnail">
					<?php the_post_thumbnail(); ?>
				</div>
				<?php } ?>
				
				<div class="clear"></div>
				
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
							<h4><?echo __('Autores','gis')?></h4>
					<?php 
							while ( $connected->have_posts() ) : $connected->the_post();
								$email = get_post_meta($post->ID,"Miembro - email");
					?>	
								<div class="author_p">
									<a href="<?=the_permalink()?>">
										<?php if($email){
											echo get_avatar( $email[0], 32 );
										}?>
										<?=the_title();?>
										<span class="clear"></span>
									</a>
								</div>
					<?php 
							endwhile;
							wp_reset_postdata();
						endif;
					?>
				</div>

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
					<?php if($moreInfo || $pdf){?>
						<div class="extra">
							<?php if($pdf){?>
								<a class="pdf" target="_blank" href="<?=wp_get_attachment_url($pdf[0]);?>"><?echo __('Publicación en PDF','gis')?></a>
							<?php } ?>
							<?php if($moreInfo){?>
								<a class="more <?if($pdf){echo 'boderRight';} ?>" target="_blank" href="<?=$moreInfo[0]?>"><?echo __('Vínculo web','gis')?></a>
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
<script>
	$('#menu-item-23, #menu-item-161').addClass('current_page_item')
</script>
<?php get_footer(); ?>