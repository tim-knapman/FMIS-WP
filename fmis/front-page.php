<?php get_header(); ?>
<section class="cont">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
								the_content();
						} // end while
					} // end if
				?>
			</div>
			<div class="col-md-6">
				<?php
					echo get_the_post_thumbnail();
				?>
				<figcaption><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></figcaption>
			</div>
		</div>
	</div>
</section>
<section class="suppliers">
	<div class="container">
		<h2>Proud suppliers of:</h2>
		<div class="row">
		<?php
			$suppliers = get_field( 'suppliers' );
			if( have_rows('suppliers') ):

				while ( have_rows('suppliers') ) : the_row();
					$logo = get_sub_field( 'logo' );
					$link = get_sub_field( 'website' );

					echo "<div class='col-md-3'>";
						echo "<a href='" . $link . "' target='blank'>";
							echo "<img src='" . $logo . "'>";
						echo "</a>";
					echo "</div>";

				endwhile;

			endif;
		?>
		</div>
	</div>
</section>
<section class="about">
	<div class="container">
		<?php
			$about_image = get_field( 'about_image' );
		?>
		<div class="row">
			<div class="col-md-6">
				<?php the_field( 'about_fmis' ); ?>
			</div>
			<div class="col-md-6 order-sm-first order-md-last">
				<?php
					echo wp_get_attachment_image( $about_image['ID'], 'full' );
				?>
				<figcaption><?php echo $about_image['caption']; ?></figcaption>
			</div>
		</div>
	</div>
</section>
	<!-- <p>Front Page</p> -->
</section>
<?php get_footer(); ?>
