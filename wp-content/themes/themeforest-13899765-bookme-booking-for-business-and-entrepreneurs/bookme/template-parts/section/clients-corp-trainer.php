<?php 
/*
 * Section Clients Corporate Trainer
 *
 */
 
$sect_title = get_post_meta(get_the_ID(), '_BookmeMB_corp_trainer_clients_title',true);
$client_cat = get_post_meta(get_the_ID(), '_BookmeMB_corp_trainer_clients_cat', true);
if ( $client_cat ) {
	$term_ids = array($client_cat);
} else {
	$terms = get_terms( 'client_category' ); 
	$term_ids = wp_list_pluck( $terms, 'term_id' );
}
$clients = array(
	'post_type' => 'bookme_client',
	'posts_per_page' => -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'client_category',
			'field' => 'term_id',
			'terms' => $term_ids,
		),
	),
);
$client = new WP_Query( $clients );
if ( $client->have_posts() ) :
	echo '<section id="clients"><div class="container wow fadeInUp">';
	if ( $sect_title ) echo '<div class="pull-left title-clients wow fadeInUp"><h5 class="title">' . esc_attr($sect_title) . '</h5></div>';
	$count = '0';

	while ( $client->have_posts() ) : $client->the_post();
		if ( has_post_thumbnail() ) { ?>
			<div class="clients-item"><?php the_post_thumbnail(); ?></div><?php
			$count = $count+0.3;
		}
	endwhile;

	echo '</div></section>';
endif; wp_reset_postdata();
