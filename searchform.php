<?php
/**
 * The template for displaying search forms in Revista Mirall Premium
 *
 * @package Revista Mirall Premium
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" class="form-inline <?php //echo bootstrap_searchform_class( debug_backtrace() ); ?>">
        <div class="form-group form-group-sm">
            <input type="text" class="form-control" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Cerca &hellip;', 'revista_mirall_premium' ); ?>" />
        </div>
        <button type="submit" class="btn btn-link btn-xs"><span class="glyphicon glyphicon-search"></span></button>
	</form>

