<?php
/**
 * Template Name: Accounting Template
 *
 */
get_header();
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();

				get_template_part('template-parts/section/slider');
				get_template_part('template-parts/section/about');
				get_template_part('template-parts/section/services');
				get_template_part('template-parts/section/parallax');
				get_template_part('template-parts/section/news');
				get_template_part('template-parts/section/facts');
				get_template_part('template-parts/section/testi');
				get_template_part('template-parts/section/about', 'details');
				get_template_part('template-parts/section/clients');

			endwhile;
		else :
			get_template_part( 'content', 'none' );
		endif;

	?>

<a name="contact-estimate" />
<section id="contact-estimate">
		<div class="row wow fadeInUp" data-right-height>
			<div class="col-md-5 col-sm-6 contact" data-right-height-content>
				<h3>Contact</h3>
				<h4>Paul Belanger, Founder</h4>
					<p>paul.belanger@woodfordadvisors.com</p>
					<?php echo do_shortcode( '[contact-form-7 id="64" title="Contact 2"]' ); ?>

			</div>
			<div class="col-md-7 col-sm-6 estimate" data-right-height-content>
				<h3>Request a quote</h3>
				<?php echo do_shortcode( '[contact-form-7 id="4" title="Contact form 1"]' ); ?>
			</div>
	</div>
</section>



	<?php get_footer(); ?>
