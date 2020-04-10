<?php

function sasi_scripts() {
  wp_enqueue_script( 'menu', get_template_directory_uri() . '/assets/js/menu.js' );
  wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper.min.js' );

  wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.7.2/css/all.css' );
  wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper.min.css' );
  wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
  wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/main.min.css', array(), null );
  wp_enqueue_style( 'fonts', 'https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat:ital,wght@0,400;0,800;1,900&display=swap', array(), null );
}
add_action( 'wp_enqueue_scripts', 'sasi_scripts' );

// Allow customiser to include a Logo
function sasi_theme_setup() {

	add_theme_support( 'custom-logo', array(
		'flex-width' => true,
    'flex-height'   => true
	) );

  add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'sasi_theme_setup' );

// add tag support to pages
function tags_support_all() {
	register_taxonomy_for_object_type('post_tag', 'page');
}

// ensure all tags are included in queries
// function tags_support_query($wp_query) {
// 	if ($wp_query->get('tag')) $wp_query->set('post_type', 'any');
// }

// tag hooks
add_action('init', 'tags_support_all');
// add_action('init', 'tags_support_query');

function sasi_theme_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}

// Add excerpt capabilities to posts.
add_action( 'init', 'add_excerpts' );
function add_excerpts() {
  add_post_type_support( 'post', 'excerpt' );
}

// add a custom image size
// add_image_size( 'slider', 1290, 500, array( 'center', 'center' ) );
add_image_size( 'single-story', 295 );
add_image_size( 'archive-story', 395 );

include_once( 'includes/menu_walker.php' );

function sasi_register_menus() {
  register_nav_menus(
    array(
      'main-menu' => __( 'Main Menu' ),
      'side-menu' => __( 'Side Menu' )
    )
  );
}
add_action( 'init', 'sasi_register_menus' );

function sasi_register_sidebars() {
  register_sidebar( array(
    'name'          => __( 'E-Newsletter', 'twc' ),
    'id'            => 'newsletter-sidebar',
    'description'   => __( 'Widgets in this area will be shown in the footer. Under the "E-Newsletter" section', 'twc' ),
    'before_widget' => '<div class="single">',
  	'after_widget'  => '</div>',
  ) );
}
// add_action( 'widgets_init', 'sasi_register_sidebars' );


function create_post_type() {
  $driverargs = array(
    'labels' => array(
      'name' => __( 'FMIS Machinery' ),
      'singular_name' => __( 'Machine' ),
      'add_new' => __( 'Add New Machine' ),
      'add_new_item'  => __( 'Add New Machine for FMIS' )
    ),
    'public' => true,
    'has_archive' => true,
    'show_in_nav_menus' => true,
    'rewrite' => array('slug' => 'machinery'),
    'supports' => array( 'title', 'thumbnail' ),
    'taxonomies' => array( 'category' )
  );
  register_post_type( 'Machinery', $driverargs );
}
add_action( 'init', 'create_post_type' );

function modify_read_more_link() {
    return '<a href="' . get_permalink() . '" class="read-more">Read More...</a>';
}
add_filter( 'the_content_more_link', 'modify_read_more_link' );


add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() {
  global $wp_meta_boxes;
  wp_add_dashboard_widget('custom_help_widget', 'SASI Marketing', 'dashboard_support');
}

function dashboard_support() {
  echo "<img src='https://sasi.com.au/img/logo-sasi.png' style='display: block; margin: 0 auto; width: 30%;'>";
  echo "<h2>For support enquiries</h2>";
  echo "<p>Now that your new website is up and running, you may find things that you want to change. If you need any help with this, please email <a href='mailto:support@sasi.com.au'>support@sasi.com.au</a>";
}

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page( array(
    'page_title'    =>  __("Website Options"),
    'menu_title'    =>  __("FMIS Options"),
    'menu-slug'     =>  'theme-options',
    'capability'    =>  'manage_options',
    'redirect'      =>  false
  ));
}


@ini_set( 'upload_max_size' , '128M' );
@ini_set( 'post_max_size', '128M');
@ini_set( 'max_execution_time', '300' );



class Bootstrap_Walker extends Walker_Nav_Menu
    {

        /* Start of the <ul>
         *
         * Note on $depth: Counterintuitively, $depth here means the "depth right before we start this menu".
         *                 So basically add one to what you'd expect it to be
         */
        function start_lvl(&$output, $depth = 0, $args= array(), $id = 0 )
        {
            $tabs = str_repeat("\t", $depth);
            // If we are about to start the first submenu, we need to give it a dropdown-menu class
            if ($depth == 0 || $depth == 1) { //really, level-1 or level-2, because $depth is misleading here (see note above)
                $output .= "\n{$tabs}<ul class=\"dropdown-menu\">\n";
            } else {
                $output .= "\n{$tabs}<ul>\n";
            }
            return;
        }

        /* End of the <ul>
         *
         * Note on $depth: Counterintuitively, $depth here means the "depth right before we start this menu".
         *                 So basically add one to what you'd expect it to be
         */
        function end_lvl( &$output, $depth = 0, $args = array() )
        {
            if ($depth == 0) { // This is actually the end of the level-1 submenu ($depth is misleading here too!)

            }
            $tabs = str_repeat("\t", $depth);
            $output .= "\n{$tabs}</ul>\n";
            return;
        }

        /* Output the <li> and the containing <a>
         * Note: $depth is "correct" at this level
         */
        function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
        {
            global $wp_query;
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
            $class_names = $value = '';
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;

            /* If this item has a dropdown menu, add the 'dropdown' class for Bootstrap */
            if ($item->hasChildren) {
                $classes[] = 'dropdown';
                // level-1 menus also need the 'dropdown-submenu' class
                if($depth == 1) {
                    $classes[] = 'dropdown-submenu';
                }
            }

            /* This is the stock Wordpress code that builds the <li> with all of its attributes */
            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
            $class_names = ' class="' . esc_attr( $class_names ) . '"';
            $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )  ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'  . esc_attr( $item->xfn      ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
            $item_output = $args->before;

            /* If this item has a dropdown menu, make clicking on this link toggle it */
            if ($item->hasChildren && $depth == 0) {
                $item_output .= '<a'. $attributes .' data-toggle="dropdown" data-category="">';
            } else {
                $item_output .= '<a'. $attributes .'>';
            }

            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

            /* Output the actual caret for the user to click on to toggle the menu */
            if ($item->hasChildren && $depth == 0) {
                $item_output .= ' <i class="fas fa-caret-down"></i></a>';

            }elseif($item->type == 'taxonomy'){
                $cat = get_category( $item->object_id);
                // $item_output .= ' ('.$cat->count.')</a>';
                $item_output .= '</a>';
            } else {
                $item_output .= '</a>';
            }

            $item_output .= $args->after;
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            return;
        }

        /* Close the <li>
         * Note: the <a> is already closed
         * Note 2: $depth is "correct" at this level
         */
        function end_el ( &$output, $item, $depth = 0, $args = array() )
        {
            $output .= '</li>';
            return;
        }

        /* Add a 'hasChildren' property to the item
         * Code from: http://wordpress.org/support/topic/how-do-i-know-if-a-menu-item-has-children-or-is-a-leaf#post-3139633
         */
        function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
        {
            // check whether this item has children, and set $item->hasChildren accordingly
            $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);

            // continue with normal behavior
            return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
        }
    }
