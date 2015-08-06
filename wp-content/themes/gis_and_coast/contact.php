<?php
/*
Template Name: Contact
*/
?>

<?php get_header(); ?>

<?php
        $email = null;
        if(isset($_POST['sent'])){
                $error = "";
                if(!trim($_POST['tu_nombre'])){
                        $error .= __('Por favor, tu nombre es…','gis');
                }
                if(!filter_var(trim($_POST['tu_email']),FILTER_VALIDATE_EMAIL)){
                        $error .= "<p>" . __('El email no es válido','gis') . "</p>";
                }
                if(!trim($_POST['tu_mensaje'])){
                        $error .= "<p>" . __('Quizá olvidaste el mensaje…','gis') . "</p>";
                }
                if(!trim($_POST['el_telefono'])){
                        $error .= "<p>" . __('Indique un número de teléfono','gis') . "</p>";
                }
                if(!$error){
                        // $email = wp_mail(get_option("admin_email"),trim($_POST['tu_nombre'])." Se ha enviado un mensaje desde ".get_option("blogname"),stripslashes(trim($_POST['tu_mensaje'])),"De: ".trim($_POST['tu_nombre'])." <".trim($_POST['tu_email']).">\r\nReply-To:".trim($_POST['tu_email']));
                        $message = __('Se ha enviado un mensaje desde','gis'). get_site_url(). "\nDe:" . trim($_POST['tu_nombre']) . "\nEmail: " . trim($_POST['tu_email']) . "\nTeléfono:" . trim($_POST['el_telefono'] . "\n\n" . stripslashes(trim($_POST['tu_mensaje'])));

                        $email = wp_mail(get_option("admin_email"), "Notificación", $message);
                }
        }
?>


<section id="contact">
	<iframe width="100%" height="468" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?hl=es&q=Universidad+de+Sevilla+Facultad+de+Geografia+e+Historia&amp;aq=&amp;sll=37.6046745,-5.6679935&hq=&amp;hnear=Universidad de Sevilla Facultad de Geografia e Historia&amp;ll=37.6046745,-5.6679935&ie=UTF8&t=k&z=7&iwloc=B&output=embed&sll=37.6046745,-5.6679935"></iframe>
	
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-md-4 border">
				<?php the_content(); ?>
			</div>
			<div class="col-sm-8 col-md-8">
				
				<?php if($email){ ?>
					<div class="info">
					        <h3><?echo __('Mensaje enviado. Te responderemos lo antes posible','gis')?></h3>
					</div>

				<?php }else {

					if($error){ ?>
					        <div class="info">
					                <h3><?echo __('Tu mensaje NO ha sido enviado','gis')?></h3>
					                <?php echo $error; ?>
					        </div>
					<?php } ?>


				    <form action="<?php the_permalink(); ?>" id="contacto" method="post">
				            <input type="hidden" name="sent" id="sent" value="1" />
				            <div id="form">
				            	<h3><?echo __('Formulario de contacto','gis')?></h3>
					            <div class="fleft" style="width: calc(50% - 20px);">
					                
				                	<input type="text" name="tu_nombre" id="tu_nombre" placeholder="<?echo __('Nombre y apellidos','gis')?>" value="<?php if(isset($_POST['tu_nombre'])) echo $_POST['tu_nombre'];?>" />
					               
				                    <input type="text" name="tu_email" id="tu_email" placeholder="<?echo __('Correo electrónico','gis')?>" value="<?php if(isset($_POST['tu_email'])) echo $_POST['tu_email'];?>" />
					                

					                
				                    <input type="text" name="el_telefono" id="el_telefono" placeholder="<?echo __('Teléfono de contacto','gis')?>" value="<?php if(isset($_POST['el_telefono'])) echo $_POST['el_telefono'];?>" />

					            </div>

				                <div id="input-field">
				                	<textarea name="tu_mensaje" id="tu_mensaje"  placeholder="<?echo __('Mensaje','gis')?>"><?php if(isset($_POST['tu_mensaje'])) echo stripslashes($_POST['tu_mensaje']); ?></textarea>
				                </div>

				            </div>

				            <div class="fright" id="input-field">
				            	<input class="button" type="submit" name = "send" value = "<?echo __('Enviar formulario','gis')?>" />
				            </div>
				    </form>

				<?php } ?>
           
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>