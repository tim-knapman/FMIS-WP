<?php
/**
 * Create HTML list of nav menu items.
 * Replacement for the native Walker, using the description.
 *
 * @see    http://wordpress.stackexchange.com/q/14037/
 * @author toscho, http://toscho.de
 */
class Walker_twc_Nav_Menu extends Walker_Nav_Menu {
        private $color_idx = 0;

        // add classes to ul sub-menus
        function start_lvl( &$output, $depth = 0, $args= array(), $id = 0) {
            //p($output);
            // depth dependent classes
            $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
            $display_depth = ( $depth + 1); // because it counts the first submenu as 0
            $classes = array(
                'sidebar-menu',
                ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
                ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
                'level-' . $display_depth
                );
            $class_names = implode( ' ', $classes );


            // build html
            $incri = $this->color_idx-1;
            $output .= "\n" . $indent . '<ul class="dropdown">' .$parent_label.$back_btn. "\n";
        }

        // add main/sub classes to li's and links
         function start_el( &$output, $item, $depth = 0, $args = Array(), $id = 0 ) {


            global $wp_query;
            $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

            // depth dependent classes
            $depth_classes = array(
                'sidebar-item',
                ( $depth == 0 ? 'li0' : '' ),
                ( $depth == 1 ? 'li1' : '' ),
                ( $depth == 2 ? 'li2' : '' ),
                ( $depth == 3 ? 'li3' : '' ),
                ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
                'menu-item-depth-' . $depth
            );

            if(in_array('menu-item-has-children',$item->classes)){
                $has_children = 'menu-item-has-children';
                $has_children_var = 1;
                $depth_classes[] = 'has-children';
            } else{
                $has_children_var = 0;
                $depth_classes[] = 'no-children';
            }

            $title = apply_filters( 'the_title', $item->title, $item->ID );

            $li_attributes = ' class="'. strtolower($title) .' '.$has_children .'"';

            $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );




            // passed classes
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

            // build html
            $output .= $indent . '<li class="' . $class_names . '">';

            // link attributes

            // $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes  = ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url       ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            // if(in_array('menu-item-has-children', $item->classes)) {
            //   $attributes .= ' class="fas fa-caret-right"';
            // }

            $title = str_replace(array( ' ', '-',' ' ), '', esc_attr($item->title));

            $item_output = "<a " . $attributes . ">" . esc_attr($item->title);
            if(in_array('menu-item-has-children',$item->classes)){
            //   $item_output .= "<label class='submenu' title='toggle-menu' for='" . strtolower($title) . "'>";
              // $item_output .= "<i class='fas fa-caret-right'></i></label>";
            }
            $item_output .= "</a>";

            if(in_array('menu-item-has-children',$item->classes)){
              $item_output .= "";
            }


            // build html
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

            if($has_children_var == 1){
                $this->color_idx++;
            }
        }
}
