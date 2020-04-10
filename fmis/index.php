<?php get_header(); ?>
<section class="container">
	<div class="row">
		<div class="col-md-12">
			<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
							the_content();
					} // end while
				} // end if
			?>
		</div>
	</div>
	<!-- <p>Index</p> -->
</section>
<?php get_footer(); ?>
