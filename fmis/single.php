<?php
	get_header();
	$page_id = get_the_ID();
?>
<section class="container">
	<div class="row title">
    <div class="col-md-12">
      <h2><?php the_title(); ?></h2>
    </div>
  </div>
	<div class="row no-gutters slider">
    <div class="col-md-12">
			<div class="slider-container">
				<div class="swiper-wrapper">
					<?php
						if( have_rows( 'image', $page_id ) ) {
							while( have_rows( 'image', $page_id ) ) {
								the_row();

								$image = get_sub_field( 'image' );

								?>
								<div class="swiper-slide">
									<img src="<?php echo $image; ?>">
								</div>
								<?php
							}
						}
					?>
				</div>
				<div class="swiper-pagination"></div>
				<div class="swiper-button-next"></div>
    		<div class="swiper-button-prev"></div>
			</div>
    </div>
  </div>
	<div class="row content">
		<div class="col-md-8 col-lg-10">
			<div class="row about">
				<div class="col-md-12">
					<?php
						echo get_field( 'about', $page_id );
					?>
				</div>
			</div>
			<div class="row features">
				<div class="col-md-10">
					<h2>Features:</h2>
					<?php
						the_field( 'feature', $page_id );
					?>
				</div>
			</div>
			<div class="row specifications">
				<div class="col-md-12">
					<h2>Specifications:</h2>
						<?php
							$dimensions = get_field( 'dimensions', $page_id );
							$tires = get_field( 'tires', $page_id );
							$engine = get_field( 'engine_group', $page_id );
							$tanks = get_field( 'tank_capacities', $page_id );
							$other = get_field( 'other_specifications', $page_id );
							$torque = get_field( 'ground_drive', $page_id );
							$tunnel = get_field( 'tunnel_dimensions', $page_id );
							$shipping = get_field( 'shipping_dimensions', $page_id );
							$drive_train = get_field( 'drive_train', $page_id );
							$solution = get_field( 'solution_system', $page_id );
							$precision = get_field( 'precision_equipment', $page_id );
							$applicator = get_field( 'applicator_options', $page_id );

							if( count(array_filter($dimensions) ) != 0 ) {
							  ?>
							  <div class="row">
							    <div class="col-md-12">
							      <h3>Dimensions</h3>
							    </div>
							  </div>
							  <?php
							  foreach ($dimensions as $key => $value) {
							    if( !empty( $value ) ):
							      echo "<div class='row'>";
							        echo "<div class='col-md-6'>";
							          $title = str_replace( '_', ' ', $key );
							          echo ucwords( $title );
							        echo "</div>";
							        echo "<div class='col-md-6'>";
							          echo $value;
							        echo "</div>";
							      echo "</div>";
							    endif;
							  }
							}

							if( count(array_filter($tires) ) != 0 ) {
							  ?>
							  <div class="row">
							    <div class="col-md-12">
							      <h3>Tires</h3>
							    </div>
							  </div>
							  <?php
							  foreach ($tires as $key => $value) {
							    if( !empty( $value ) ):
							      echo "<div class='row'>";
							        echo "<div class='col-md-6'>";
							          $title = str_replace( '_', ' ', $key );
							          echo ucwords( $title );
							        echo "</div>";
							        echo "<div class='col-md-6'>";
							          echo $value;
							        echo "</div>";
							      echo "</div>";
							    endif;
							  }
							}


							if( count(array_filter($engine) ) != 0 ) {
							  ?>
							  <div class="row">
							    <div class="col-md-12">
							      <h3>Engine</h3>
							    </div>
							  </div>
							  <?php
							  foreach ($engine as $key => $value) {
							    if( !empty( $value ) ):
							      echo "<div class='row'>";
							        echo "<div class='col-md-6'>";
							          $title = str_replace( '_', ' ', $key );
							          echo ucwords( $title );
							        echo "</div>";
							        echo "<div class='col-md-6'>";
							          echo $value;
							        echo "</div>";
							      echo "</div>";
							    endif;
							  }
							}

							if( count(array_filter($tanks) ) != 0 ) {
							  ?>
							  <div class="row">
							    <div class="col-md-12">
							      <h3>Tank Capacities</h3>
							    </div>
							  </div>
							  <?php
							  foreach ($tanks as $key => $value) {
							    if( !empty( $value ) ):
							      echo "<div class='row'>";
							        echo "<div class='col-md-6'>";
							          $title = str_replace( '_', ' ', $key );
							          echo ucwords( $title );
							        echo "</div>";
							        echo "<div class='col-md-6'>";
							          echo $value;
							        echo "</div>";
							      echo "</div>";
							    endif;
							  }
							}

							if( count(array_filter($other) ) != 0 ) {
							  ?>
							  <div class="row">
							    <div class="col-md-12">
							      <h3>Other Specifications</h3>
							    </div>
							  </div>
							  <?php
							  foreach ($other as $key => $value) {
							    if( !empty( $value ) ):
							      echo "<div class='row'>";
							        echo "<div class='col-md-6'>";
							          $title = str_replace( '_', ' ', $key );
							          echo ucwords( $title );
							        echo "</div>";
							        echo "<div class='col-md-6'>";
							          echo $value;
							        echo "</div>";
							      echo "</div>";
							    endif;
							  }
							}

							if( count(array_filter($torque) ) != 0 ) {
							  ?>
							  <div class="row">
							    <div class="col-md-12">
							      <h3>Ground Drive</h3>
							    </div>
							  </div>
							  <?php
							  foreach ($torque as $key => $value) {
							    if( !empty( $value ) ):
							      echo "<div class='row'>";
							        echo "<div class='col-md-6'>";
							          $title = str_replace( '_', ' ', $key );
							          echo ucwords( $title );
							        echo "</div>";
							        echo "<div class='col-md-6'>";
							          echo $value;
							        echo "</div>";
							      echo "</div>";
							    endif;
							  }
							}

							if( count(array_filter($tunnel) ) != 0 ) {
							  ?>
							  <div class="row">
							    <div class="col-md-12">
							      <h3>Tunnel Dimensions</h3>
							    </div>
							  </div>
							  <?php
							  foreach ($tunnel as $key => $value) {
							    if( !empty( $value ) ):
							      echo "<div class='row'>";
							        echo "<div class='col-md-6'>";
							          $title = str_replace( '_', ' ', $key );
							          echo ucwords( $title );
							        echo "</div>";
							        echo "<div class='col-md-6'>";
							          echo $value;
							        echo "</div>";
							      echo "</div>";
							    endif;
							  }
							}

							if( count(array_filter($shipping) ) != 0 ) {
							  ?>
							  <div class="row">
							    <div class="col-md-12">
							      <h3>Shipping Dimensions</h3>
							    </div>
							  </div>
							  <?php
							  foreach ($shipping as $key => $value) {
							    if( !empty( $value ) ):
							      echo "<div class='row'>";
							        echo "<div class='col-md-6'>";
							          $title = str_replace( '_', ' ', $key );
							          echo ucwords( $title );
							        echo "</div>";
							        echo "<div class='col-md-6'>";
							          echo $value;
							        echo "</div>";
							      echo "</div>";
							    endif;
							  }
							}

							if( count(array_filter($drive_train) ) != 0 ) {
							  ?>
							  <div class="row">
							    <div class="col-md-12">
							      <h3>Drive Train</h3>
							    </div>
							  </div>
							  <?php
							  foreach ($drive_train as $key => $value) {
							    if( !empty( $value ) ):
							      echo "<div class='row'>";
							        echo "<div class='col-md-6'>";
							          $title = str_replace( '_', ' ', $key );
							          echo ucwords( $title );
							        echo "</div>";
							        echo "<div class='col-md-6'>";
							          echo $value;
							        echo "</div>";
							      echo "</div>";
							    endif;
							  }
							}

							if( count(array_filter($solution) ) != 0 ) {
							  ?>
							  <div class="row">
							    <div class="col-md-12">
							      <h3>Solution System</h3>
							    </div>
							  </div>
							  <?php
							  foreach ($solution as $key => $value) {
							    if( !empty( $value ) ):
							      echo "<div class='row'>";
							        echo "<div class='col-md-6'>";
							          $title = str_replace( '_', ' ', $key );
							          echo ucwords( $title );
							        echo "</div>";
							        echo "<div class='col-md-6'>";
							          echo $value;
							        echo "</div>";
							      echo "</div>";
							    endif;
							  }
							}

							if( count(array_filter($precision) ) != 0 ) {
							  ?>
							  <div class="row">
							    <div class="col-md-12">
							      <h3>Precision Equipment</h3>
							    </div>
							  </div>
							  <?php
							  foreach ($precision as $key => $value) {
							    if( !empty( $value ) ):
							      echo "<div class='row'>";
							        echo "<div class='col-md-6'>";
							          $title = str_replace( '_', ' ', $key );
							          echo ucwords( $title );
							        echo "</div>";
							        echo "<div class='col-md-6'>";
							          echo $value;
							        echo "</div>";
							      echo "</div>";
							    endif;
							  }
							}

							if( count(array_filter($applicator) ) != 0 ) {
							  ?>
							  <div class="row">
							    <div class="col-md-12">
							      <h3>Applicator Options</h3>
							    </div>
							  </div>
							  <?php
							  foreach ($applicator as $key => $value) {
							    if( !empty( $value ) ):
							      echo "<div class='row'>";
							        echo "<div class='col-md-6'>";
							          $title = str_replace( '_', ' ', $key );
							          echo ucwords( $title );
							        echo "</div>";
							        echo "<div class='col-md-6'>";
							          echo $value;
							        echo "</div>";
							      echo "</div>";
							    endif;
							  }
							}
				?>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-lg-2 brochures">
			<?php
			$brochures = get_field( 'brochures', $page_id );
			if( have_rows('brochures') ):
				echo "<div class='row'>";
				while ( have_rows('brochures') ) : the_row();
					$brochure = get_sub_field( 'brochure' );
					// $image = wp_get_attachment_thumb_url( $brochure['ID'] );
					$image = $brochure['icon'];
					// var_dump($brochure);
					$link = $brochure['url'];
					?>
					<div class="col-sm-6 col-md-12 brochure">
						<a href="<?php echo $link; ?>" target="blank">
							<img src="<?php echo $image; ?>">
							<p><?php echo $brochure['title'] ; ?></p>
						</a>
					</div>
					<?php
				endwhile;
				echo "</div>";
			endif;
			?>
		</div>
	</div>

	<!-- <p>Single</p> -->
</section>
<script>
var swiper = new Swiper('.slider-container', {
	loop: true,
	autoplay: {
		delay: 3000,
		disableOnInteraction: false,
	},
	pagination: {
		el: '.swiper-pagination',
	},
	navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});
</script>
<?php get_footer(); ?>
