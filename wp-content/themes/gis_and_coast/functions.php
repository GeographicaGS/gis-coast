<?php
// Registro del menú de WordPress


if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus(
        array(
          'main' => 'Main'
        )
    );
}
add_theme_support( 'nav-menus' );

add_theme_support( 'post-thumbnails' );

function my_connection_types() {
    p2p_register_connection_type( array(
        'name' => 'posts_to_posts',
        'from' => 'post',
        'to' => 'post',
        'reciprocal' => true
    ) );
}
add_action( 'p2p_init', 'my_connection_types' );

function theme_enqueue_styles() {
	if (!is_admin()){
		wp_enqueue_style('reset', get_stylesheet_directory_uri().'/css/reset.css');
		wp_enqueue_style('base', get_stylesheet_directory_uri().'/css/base.less');
		wp_enqueue_style('gis', get_stylesheet_directory_uri().'/css/gis.less');
	}
}
add_action('init', 'theme_enqueue_styles');

function theme_enqueue_scripts() {
	if (!is_admin()){
		wp_enqueue_script('jqueryGis', get_stylesheet_directory_uri().'/js/lib/jquery-2.1.4.min.js');
		wp_enqueue_script( 'myscript', get_template_directory_uri() . '/js/myscript.js', array( ), false, 'all' );

	}
}
add_action('init', 'theme_enqueue_scripts');

function short_time_diff( $from, $to = '' ) {

    $diff = human_time_diff($from,$to);

    $replace = array(
        'hour'  => __('hora','gis'),
        'hours' => __('horas','gis'),
        'day'   => __('día','gis'),
        'days'  => __('días','gis'),
        'min'   => __('minuto','gis'),
        'mins'  => __('minutos','gis'),
        'week'  => __('semana','gis'),
        'weeks'  => __('semanas','gis')
    );

    return strtr($diff,$replace);
}


function get_category_tags($args) {
	global $wpdb;
	$tags = $wpdb->get_results
	("
		SELECT DISTINCT terms2.term_id as tag_id, terms2.name as tag_name, null as tag_link
		FROM
			wp_posts as p1
			LEFT JOIN wp_term_relationships as r1 ON p1.ID = r1.object_ID
			LEFT JOIN wp_term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
			LEFT JOIN wp_terms as terms1 ON t1.term_id = terms1.term_id,

			wp_posts as p2
			LEFT JOIN wp_term_relationships as r2 ON p2.ID = r2.object_ID
			LEFT JOIN wp_term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
			LEFT JOIN wp_terms as terms2 ON t2.term_id = terms2.term_id
		WHERE
			t1.taxonomy = 'category' AND p1.post_status = 'publish' AND terms1.term_id IN (".$args['categories'].") AND
			t2.taxonomy = 'post_tag' AND p2.post_status = 'publish'
			AND p1.ID = p2.ID
		ORDER by tag_name
	");
	$count = 0;
	foreach ($tags as $tag) {
		$tags[$count]->tag_link = get_tag_link($tag->tag_id);
		$count++;
	}
	return $tags;
}

///////Shortcodes//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function proyect_list_func($attr,$content){
	return '<div class="proyectList">'.do_shortcode($content).'</div>';
}
add_shortcode( 'lista_proyectos', 'proyect_list_func' );

function proyect_func($attr){
	$a = shortcode_atts( array(
        'titulo' => '',
        'contenido' => '',
    ), $attr );

	return '<h4>' . $a['titulo'] . '</h4>' . '<p>' . $a['contenido'] . '</p>';
}
add_shortcode( 'proyecto', 'proyect_func' );

function publication_list_func($attr,$content){
	return '<div class="publicationList">'.do_shortcode($content).'</div>';
}
add_shortcode( 'lista_publicaciones', 'publication_list_func' );

function publication_func($attr){
	$a = shortcode_atts( array(
        'titulo' => '',
        'contenido' => '',
    ), $attr );

	return '<h4>' . $a['titulo'] . '</h4>' . '<p>' . $a['contenido'] . '</p>';
}
add_shortcode( 'publicacion', 'publication_func' );

?>