<?php 
/*
 * Section Clients Trainer
 *
 */

	$clients_small_text = get_post_meta(get_the_ID(), '_BookmeMB_clients_small_text',true);
	$clients_title = get_post_meta(get_the_ID(), '_BookmeMB_clients_title',true);
	$clients_content = get_post_meta(get_the_ID(), '_BookmeMB_clients_content',true);
	if ( $clients_small_text || $clients_title || $clients_content ) { ?>

		<section id="clients">
			<div class="container wow fadeInDown">
					<div class="clients-header">
						<div class="header-section text-center">
							<?php if ( $clients_small_text ) : ?>
								<div class="small-title">
									<h3><?php echo esc_attr( $clients_small_text ); ?></h3>
								</div>
							<?php endif; ?>
							<?php if ( $clients_title ) : ?>
								<div class="title">
									<h2><?php echo esc_attr( $clients_title ); ?></h2>
								</div>
							<?php endif; ?>
							<?php if ( $clients_content ) : ?>
								<p><?php echo esc_attr( $clients_content ); ?></p>
							<?php endif; ?>
						</div>
					</div>
				
				<?php 
					$client_cat = get_post_meta(get_the_ID(), '_BookmeMB_clients_cat', true);
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
					$row = 1;									
					if ( $client->have_posts() ) : ?>
						<?php $count = '0'; ?>
						<?php 		
							while ( $client->have_posts() ) : $client->the_post(); ?>
								<div class="col-md-2 col-sm-2 col-xs-6 ">
									<div class="clients-item">
										<?php 
											$client_url = get_post_meta(get_the_ID(), '_BookmeMB_clients_url_detil', true);
											if ( $client_url ) 
												echo '<a href="' . esc_url( $client_url ) . '">';
											if ( has_post_thumbnail() )
												the_post_thumbnail();
											if ( $client_url ) 
												echo '</a>';
										?>
									</div>
								</div>
								<?php $count = $count+0.3; ?>
						<?php endwhile; ?>
					<?php 
						endif;
						wp_reset_postdata();  
					?>
			</div>
		</section>
<?php } ?>
