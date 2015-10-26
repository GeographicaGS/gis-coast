<?php 
get_header(); 

$email = get_post_meta($post->ID,"Miembro - email");
$tlf = get_post_meta($post->ID,"Miembro - Teléfono");
$subTitle = get_post_meta($post->ID,"Subtítulo");
$sisius = get_post_meta($post->ID,"Miembro - Perfil de SISIUS");

$connected = p2p_type( 'posts_to_posts' )->get_connected( $post->ID );
?>
<section id="post" class="singleMember">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="header maxWidth">
					<div class="authorInfo">
						<span style="color: #76777b; font-size:13px;"><?echo __('Contacto','gis')?>:</span>
						<?php if($email){ ?>
							<a class="author" href="mailto:$email[0]"><?=$email[0]?></a>
						<?php } ?>
						<?php if($email && $tlf){ ?>
							<span class="separator">.</span>
						<?php } ?>
						<?php if($tlf){ ?>
							<a class="author" href="tel:$tlf[0]"><?=$tlf[0]?></a>
						<?php } ?>
					</div>
					<h1><?=$post->post_title?></h1>
					<h3><?=$post->post_excerpt?></h3>
				</div>
				<div class="member-contact">
					<?php if($email){
						echo get_avatar( $email[0], 144 );
					} ?>
				</div>
				<div class="clear"></div>
				<div class="selectors">
					<?php if($sisius){?>
					<a target="_blank" href="<?=$sisius[0]?>"><?echo __('Perfil de SISIUS · Curriculum','gis')?></a>
					<?php } ?>
					<span class="proyect active"><?echo __('Proyectos','gis')?></span>
					<span class="publication"><?echo __('Publicaciones','gis')?></span>
					
				</div>
				<!-- <?php the_content(); ?> -->
				<div class="proyectList">
					<?php 
						if ( $connected->have_posts() ) :
							while ( $connected->have_posts() ) : $connected->the_post();
								$cat = get_the_category()[0]->term_id;
								if($cat == 21 || $cat == 22){
					?>
									<a href="<?=the_permalink()?>">
										<br>
										<h4><?=the_title()?></h4>
										<p><?=$post->post_excerpt?></p>
									</a>
					<?php 
								}
							endwhile;
							wp_reset_postdata();
						endif;
					?>

				</div>
				<div class="publicationList">
					<?php 
						if ( $connected->have_posts() ) :
							while ( $connected->have_posts() ) : $connected->the_post();
								$cat = get_the_category()[0]->term_id;
								if($cat == 23 || $cat == 24){
					?>
									<a href="<?=the_permalink()?>">
										<br>
										<h4><?=the_title()?></h4>
										<p><?=$post->post_excerpt?></p>
									</a>
					<?php 
								}
							endwhile;
							wp_reset_postdata();
						endif;
					?>

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
	$(".selectors .proyect").click(function() {
		$(".selectors .active").removeClass('active');
		$(this).addClass('active');
		$(".proyectList").fadeIn();
		$(".publicationList").hide();
	});
	$(".selectors .publication").click(function() {
		$(".selectors .active").removeClass('active');
		$(this).addClass('active');
		$(".proyectList").hide();
		$(".publicationList").fadeIn();
	});
</script>
<?php get_footer(); ?>