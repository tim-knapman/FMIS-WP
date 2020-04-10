<?php get_header(); ?>
<section class="container">
  <div class="row title">
    <div class="col-md-12">
      <h2><?php echo single_cat_title( '', false ); ?></h2>
    </div>
  </div>

	<?php
  $category = get_queried_object();
  $cat_id = $category->term_id;

	$cat_args = array(
    'post_type'     => 'Machinery',
    'post_status'   => 'publish',
    'cat'           => $cat_id,
    'orderby'       => 'title',
    'order'         => 'DESC'
  );

  $cat_machine = new WP_Query($cat_args);
  if( $cat_machine->have_posts() ) :
    while( $cat_machine->have_posts() ) :
      $cat_machine->the_post();
      $machine_id = get_the_ID();
      $excerpt = wp_strip_all_tags( get_field( 'about', $machine_id ) );
      ?>
      <div class="row no-gutters machine">
        <div class="col-md-3">
          <?php echo get_the_post_thumbnail( $machine_id, 'full' ); ?>
        </div>
        <div class="col-md-9">
          <h2><?php the_title(); ?></h2>
          <p><?php echo $excerpt; ?> <a href="<?php the_permalink(); ?>">Read More...</a></p>
        </div>
      </div>
      <?php
    endwhile;
  endif;
	?>
	<!-- <p>Category</p> -->
</section>
<?php get_footer(); ?>
