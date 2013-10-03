<?php
/**
 * The template for displaying search forms in _s
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
 */
?>

<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<input type="text" name="s" id="s" value="<?php _e('Recherche', 'framework') ?>" onfocus="if(this.value=='<?php _e('Recherche', 'framework') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Recherche', 'framework') ?>';" />
	<input type="hidden" name="search-query" value="side">
    <button type="submit">
    	<i class="icon-search"></i>
    </button>
</form>