<?php 
/*
 * Clients Architect
 *
 */
$architect_clients = get_post_meta(get_the_ID(), '_BookmeMB_architect_clients');
if ( $architect_clients == true ) :
	$client_cat = get_post_meta(get_the_ID(), '_BookmeMB_architect_clients_cat', true);
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
	if ( $client->have_posts() ) : ?>
		<div id="clients">
			<div class="container">
				<div class="row">
					<?php 
						$count = '0';
						while ( $client->have_posts() ) : $client->the_post();
							if ( has_post_thumbnail() ) : ?>
								<div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp" data-wow-delay="<?php echo $count.'s'; ?>">
									<div class="clients-item">
										<?php the_post_thumbnail(); ?>
									</div>
								</div><?php
								$count = $count+0.5;
							endif;
						endwhile;
					?>
				</div>
			</div>
		</div><?php
	endif; wp_reset_postdata(); 
endif;
