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
			<div class="col-md-5 col-sm-5 contact" data-right-height-content>
				<h3>Contact</h3>
				<h4>Paul Belanger, Founder</h4>
					<p>paul.belanger@woodfordadvisors.com</p>
					<a class="contact-button" href="mailto:paul.belanger@woodfordadvisors.com">Contact Me</a>
			</div>
			<div class="col-md-7 col-sm-7 estimate" data-right-height-content>
				<h3>Request a quote</h3>
				<?php echo do_shortcode( '[contact-form-7 id="4" title="Contact form 1"]' ); ?>
			</div>
	</div>
</section>

<script>
function initMap() {
        var mapDiv = document.getElementById("ny-map");
        var map = new google.maps.Map(mapDiv, {
          center: {lat: 42.360, lng: -71.058},
          zoom: 9
        });
        var andover = {lat: 42.653, lng: -71.143};
        var marker1 = new google.maps.Marker({
          position: andover,
          map: map,
          title: 'Andover, Merrimack Valley'
        });
     }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdKNvCuxd3k3ikHAvBdRUtlASg5QJKs6E&amp;callback=initMap" async="" defer="defer"></script>




	<?php get_footer(); ?>
