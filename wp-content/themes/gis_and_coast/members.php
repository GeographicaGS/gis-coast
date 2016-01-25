<?php
/*
Template Name: members
*/
?>

<?php get_header(); ?>
<section id="members">
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<h1 class="sectionTitle"><?=get_the_title();?></h1>
			</div>
		</div>
	</div>	

	<div class="memberList">
		<div class="container">
			<div class="row memberList-inner">
				<!-- <div class="col-sm-12 col-md-12"> -->
					<?php 
						$args = array(
							'category'         => 16,
							'meta_key'			=> 'Miembro - Orden',
							'orderby'          => 'meta_value_num',
							'order'          => 'ASC',
							'numberposts'       => -1,
							'suppress_filters' => 0 
						);
						$posts = get_posts( $args );
						foreach ( $posts as $post ) : setup_postdata( $post );
							$email = get_post_meta($post->ID,"Miembro - email");
						?>
						<div class="col-sm-12 col-md-3">
							<a href="<?=get_permalink();?>">
								<?php
									if($email){
										echo get_avatar( $email[0], 140 );
									} ?>
								<h3><?=$post->post_title?></h3>
								<p><?=$post->post_excerpt?></p>
								<?php if($email){ ?>
									<a class="mail" href="mailto:<?=$email[0]?>"><?=$email[0]?></a>
								<?php } ?>
							</a>
						</div>
					<?php 
						endforeach;
						wp_reset_postdata();
					?>
				<!-- </div> -->
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="tags">
					<?php if(ICL_LANGUAGE_CODE == "es"){ ?>
						<a class="line" href="<?=get_page_link(171)?>"><?echo __('Líneas de investigación','gis')?></a>
					<?php }else if(ICL_LANGUAGE_CODE == "en"){ ?>
						<a class="line" href="<?=get_page_link(173)?>"><?echo __('Líneas de investigación','gis')?></a>
					<?php } ?>
					
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>