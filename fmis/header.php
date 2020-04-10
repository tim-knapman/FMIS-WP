<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
  <link href="<?php echo get_template_directory_uri(); ?>/favicon.ico" rel="shortcut icon">
  <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=3.0, minimum-scale=0.86">
  <meta name="description" content="<?php bloginfo('description'); ?>">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <header>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <?php
            $heading = get_field( 'heading_1', 'options' );
            $sub_heading = get_field( 'heading_2', 'options' );
          ?>
          <a href="<?php echo home_url(); ?>">
            <h1><?php echo $heading; ?></h1>
            <h2><?php echo $sub_heading; ?></h2>
          </a>
        </div>
        <div class="col-md-6 text-right">
          <?php

          if( have_rows('contact', 'options') ):

            while ( have_rows('contact', 'options') ) : the_row();
                $number = get_sub_field( 'contact_number' );
                $name = get_sub_field( 'contact_name' );
                $link = get_sub_field( 'linkable' );
                // display a sub field value
                echo $name . ": ";
                if( $link == true ):
                  echo "<a href='tel:" . $number . "'>";
                endif;
                echo $number;
                if( $link == true ):
                  echo "</a>";
                endif;
                echo "<br>";
            endwhile;

          else :

            // no rows found

          endif;
          ?>
        </div>
      </div>
    </div>
  </header>
  <nav>
    <div class="container">
      <div id="menu-btn" class="hamburger">
        <div class="hamburger-container">
          <span class="bar1"></span>
          <span class="bar2"></span>
          <span class="bar3"></span>
        </div>
        <span class="menu-word">Menu</span>
      </div>
      <div class="desktop">
        <ul>
          <li><a href="/">Home</a></li>
          <?php
          $args = array(
            'hide_empty' => false
          );
          $all_categories = get_categories( $args );

          foreach ($all_categories as $cat) {
            if($cat->category_parent == 0)  {
              $category_id = $cat->term_id;

              $args_machine = array(
                'post_type' => 'Machinery',
                'post_status' => 'publish',
                'category' => $category_id
              );
              $machines = get_posts( $args_machine );

              $args_sub = array(
                'child_of'  =>  $category_id,
                'hide_empty'  => false
              );
              $sub_cat = get_categories( $args_sub );

              ?>
              <li class="category cat-<?php echo $category_id; if( $machines || $sub_cat ) { echo ' has-children'; } ?>">
                <a href="<?php echo get_term_link( $cat ); ?>">
                  <?php
                    echo $cat->name;
                    if( $machines || $sub_cat ) {
                      echo ' <i class="fas fa-caret-down"></i>';
                    }
                    ?>
                </a>
                <?php
                  if( $sub_cat ) {
                    echo '<ul class="submenu sub-category">';
                      foreach ($sub_cat as $s_cat) {
                        $s_cat_id = $s_cat->term_id;
                        ?>
                        <li class="sub-category category-<?php echo $s_cat_id; ?>">
                          <a href="<?php echo get_term_link( $s_cat ); ?>">
                            <?php
                              echo $s_cat->name;
                              echo ' <i class="fas fa-caret-right"></i>';
                            ?>
                          </a>
                          <?php
                          $args_machine = array(
                            'post_type' => 'Machinery',
                            'post_status' => 'publish',
                            'category' => $s_cat_id
                          );
                          $machines = get_posts( $args_machine );
                          echo '<ul class="subcategory-machine machine">';
                            foreach ($machines as $machine) {
                              $machine_id = $machine->ID;
                              $title = get_the_title( $machine_id );
                              ?>
                              <li class="machine machine-<?php echo $machine_id; ?>">
                                <a href="<?php echo get_permalink( $machine_id ); ?>">
                                  <?php echo $title; ?>
                                </a>
                              </li>
                              <?php
                            }
                          echo '</ul>';
                          ?>
                        </li>
                        <?php
                      }
                    echo '</ul>';
                  } elseif( $machines ) {
                    echo '<ul class="submenu machine">';
                      foreach ($machines as $machine) {
                        $machine_id = $machine->ID;
                        $title = get_the_title( $machine_id );
                        ?>
                        <li class="machine machine-<?php echo $machine_id; ?>">
                          <a href="<?php echo get_permalink( $machine_id ); ?>">
                            <?php echo $title; ?>
                          </a>
                        </li>
                        <?php
                      }
                    echo '</ul>';
                  }
                ?>
              </li>
              <?php
            }
          }
        ?>
      </ul>
      </div>
    </div>
  </nav>
