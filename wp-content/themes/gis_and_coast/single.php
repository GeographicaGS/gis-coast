<?php
$post = $wp_query->post;
if (in_category('4') || in_category('5')) {
   include(TEMPLATEPATH . '/single_new.php');
} else if (in_category('16') || in_category('17')) {
   include(TEMPLATEPATH . '/single_member.php');
} else if (in_category('21') || in_category('22')) {
   include(TEMPLATEPATH . '/single_project.php');
} else if (in_category('23') || in_category('24')) {
   include(TEMPLATEPATH . '/single_publication.php');
}else if (in_category('25') || in_category('26')) {
   include(TEMPLATEPATH . '/single_viewers.php');
}
?>