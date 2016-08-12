<?php 
/*
 * Search Form
 *
 */
?>

<form method="get" id="searchform" action="<?php echo esc_url(home_url()); ?>/">
	<div class="search-field">
		<input type="text" value="<?php esc_attr_e( 'Search here', 'bookme' ); ?>" onfocus="if ( this.value == '<?php esc_attr_e( 'Search here', 'bookme' ); ?>' ) { this.value = ''; }" onblur="if ( this.value == '' ) { this.value = '<?php esc_attr_e( 'Search here', 'bookme' ); ?>'; }" name="s" id="s" />
		<input type="submit" id="searchsubmit" />
	</div>
</form>