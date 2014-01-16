<?php
if ( is_single() ) {
get_template_part('entry','content');
} else {
get_template_part('entry','summary');
}
?>
<?php 
if ( is_single() ) {
get_template_part( 'entry-footer', 'single' ); 
} else {
get_template_part( 'entry-footer' ); 
}
?>