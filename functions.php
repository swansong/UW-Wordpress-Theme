<?

    /**
     * Register with hook 'wp_enqueue_scripts', which can be used for front end CSS and JavaScript
     */
add_action( 'after_setup_theme', 'uw_setup' );

if ( ! function_exists( 'uw_setup' ) ): 

  function uw_setup() 
  {

	  add_theme_support( 'automatic-feed-links' );
	  add_theme_support( 'post-thumbnails' );

    add_image_size( 'Thimble', 50, 50, true );
    add_image_size( 'Sidebar', 250, 9999, false );
    add_image_size( 'Body Image', 300, 9999, false );
    add_image_size( 'Full Width', 600, 9999, false );

	  register_nav_menu( 'primary', __( 'Primary Menu', 'uw' ) );
	  register_nav_menu( 'footer', __( 'Footer Menu', 'uw' ) );

    define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyeleven_header_image_width', 1280 ) );
    define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyeleven_header_image_height', 215 ) );
    
	  add_theme_support( 'custom-header', array( 'random-default' => true ) );
	  add_custom_image_header( 'uw_header_style', 'uw_admin_header_style', 'uw_admin_header_image' );
    
    register_default_headers( array(
      'blossoms' => array(
        'url' => '%s/../uw/img/header/cherries.jpg',
        'thumbnail_url' => '%s/../uw/img/header/cherries-thumbnail.jpg',
        'description' => __( 'Cherry Blossoms', 'uw' )
      )
    ));
  
  }

endif;

add_action( 'wp_enqueue_scripts', 'uw_enqueue_default_styles' );

if ( ! function_exists( 'uw_enqueue_default_styles' ) ): 
/**
 * This is where all the CSS files are registered
 *
 * bloginfo('template_directory')  gives you the url to the parent theme
 * bloginfo('stylesheet_direcotory')  gives you the url to the child theme
 */
  function uw_enqueue_default_styles() {
      $is_child_theme = get_bloginfo('template_directory') != get_bloginfo('stylesheet_directory');
      wp_register_style( 'bootstrap',get_bloginfo('template_directory') . '/css/bootstrap.css', array(), '2.0.4' );
      wp_register_style( 'bootstrap-responsive', get_bloginfo('template_directory') . '/css/bootstrap-responsive.css', array('bootstrap'), '2.0.3' );
      wp_register_style( 'uw-master', get_bloginfo('template_url') . '/style.css', array('bootstrap-responsive') );
      if ( $is_child_theme)
        wp_register_style( 'uw-style', get_bloginfo('stylesheet_url'), array('bootstrap-responsive') );
      wp_register_style( 'google-font-open-sans', 'https://fonts.googleapis.com/css?family=Open+Sans' );
      wp_enqueue_style( 'bootstrap' );
      wp_enqueue_style( 'bootstrap-responsive' );
      wp_enqueue_style( 'uw-master' );
      if ( $is_child_theme)
        wp_enqueue_style( 'uw-style' );
      wp_enqueue_style( 'google-font-open-sans' );
  }

endif;

add_action( 'wp_enqueue_scripts', 'uw_enqueue_default_scripts' );

if ( ! function_exists( 'uw_enqueue_default_scripts' ) ): 
/**
 * This is where all the JS files are registered
 *
 * bloginfo('template_directory')  gives you the url to the parent theme
 * bloginfo('stylesheet_direcotory')  gives you the url to the child theme
 */
  function uw_enqueue_default_scripts() {
    wp_deregister_script('jquery'); //we use googles CDN below
    wp_register_script( 'jquery','https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', array(), '1.7.2' );
    wp_register_script( 'header', get_bloginfo('template_directory') . '/js/header.js', array('jquery') );
    wp_register_script( 'jquery.boostrap.dropdown', get_bloginfo('template_directory') . '/js/jquery.bootstrap.dropdown.js', array('jquery'), '2.0.3' );
    wp_register_script( 'jquery.boostrap.collapse', get_bloginfo('template_directory') . '/js/bootstrap-collapse.js', array('jquery.boostrap.dropdown'), '2.0.4' );
    wp_register_script( 'jquery.firenze', get_bloginfo('template_directory') . '/js/jquery.firenze.js', array('jquery'), '1.0' );
    wp_register_script( 'jquery.weather', get_bloginfo('template_directory') . '/js/jquery.weather.js', array('jquery'), '1.0' );
    wp_register_script( 'jquery.placeholder', get_bloginfo('template_directory') . '/js/jquery.placeholder.js', array('jquery'), '1.0' );
    wp_register_script( 'jquery.imageexpander', get_bloginfo('template_directory') . '/js/jquery.imageexpander.js', array('jquery'), '1.0' );
    wp_register_script( 'jquery.waypoints', get_bloginfo('template_directory') . '/js/jquery.waypoints.min.js', array('jquery'), '1.1.7' );
    wp_register_script( 'jquery.imagesloaded', get_bloginfo('template_directory') . '/js/jquery.imagesloaded.min.js', array('jquery'), '1.0' );

    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'header' );
    wp_enqueue_script( 'jquery.bootstrap.dropdown' );
    wp_enqueue_script( 'jquery.firenze' );
    wp_enqueue_script( 'jquery.placeholder' );
    wp_enqueue_script( 'jquery.imageexpander' );
    wp_enqueue_script( 'jquery.boostrap.collapse' );
  }

endif;



if ( ! function_exists( 'uw_header_style' ) ): 
  function uw_header_style() {}
endif;

if ( ! function_exists( 'uw_admin_header_style' ) ): 
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyeleven_setup().
 *
 * @since Twenty Eleven 1.0
 */
function uw_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1,
	#desc {
		font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
	}
	#headimg h1 {
		margin: 0;
	}
	#headimg h1 a {
		font-size: 32px;
		line-height: 36px;
		text-decoration: none;
	}
	#desc {
		font-size: 14px;
		line-height: 23px;
		padding: 0 0 3em;
	}
	<?php
		// If the user has set a custom color for the text use that
		if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	#headimg img {
		max-width: 1000px;
		height: auto;
		width: 100%;
	}
	</style>
<?php
}
endif;

if ( ! function_exists( 'uw_admin_header_image' ) ): 
  function uw_admin_header_image() {?>
  
	<div id="headimg">
		<?php
		if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif;

if ( ! function_exists( 'uw_dropdowns' ) ): 

  function uw_dropdowns() 
  {
    $nav = has_nav_menu('primary');
    if ( !$nav ) 
    {
      switch_to_blog(1);
    }
    wp_nav_menu( array( 
      'theme_location'  => 'primary',
      'container_class' => 'nav-collapse',
      'menu_class'      => 'nav',
      'fallback_cb'     => '',
      'walker'          => new UW_Dropdowns_Walker_Menu(),
    ) );
    if ( !$nav ) 
    {
      restore_current_blog();
    }
  }

endif;

if ( ! function_exists( 'uw_footer_menu') ) :
  function uw_footer_menu() 
  {
    $nav = has_nav_menu('footer');
    if ( !$nav ) 
    {
      switch_to_blog(1);
    }
    wp_nav_menu( array( 
      'theme_location'  => 'footer',
      'menu_class'      => 'footer-navigation',
      'fallback_cb'     => '',
    ) );
    if ( !$nav ) 
    {
      restore_current_blog();
    }
  }
endif;

if ( ! function_exists( 'banner_class' ) ): 
  function banner_class() 
  {
    $option = get_option('patchband');

    if ( ! is_array($option) )
      return;

    $patch    = (object) $option['patch'];
    $band     = (object) $option['band'];
    $wordmark = (object) $option['wordmark'];

    $classes[] = 'header';

    if ( !$patch->header['visible'] ) 
      $classes[] = 'hide-patch';

    if ( $patch->header['color']== 'purple' )
      $classes[] = 'purple-patch';

    if ( $band->header['color']== 'tan' )
      $classes[] = 'tan-band';

    if ( $wordmark->header['color']== 'white' )
      $classes[] = 'wordmark-white';

    echo 'class="'. join(' ', $classes ) . '"';
  }
endif;

if ( ! function_exists( 'custom_wordmark' ) ): 
  function custom_wordmark() 
  {
    $option = get_option('patchband');

    if ( ! is_array( $options) )
      return;

    $wordmark = (array) $option['wordmark'];
    if ( isset($wordmark['custom'] )) {
      echo ' style="background:url('.$wordmark['custom']['url'].') no-repeat transparent; height:75px; width:445px;" ' ;
    }
  }
endif;


/**
 * Register's the default right widget sidebar
 */
if ( ! function_exists( 'uw_widgets_init' ) ): 

  function uw_widgets_init() 
  {
    $args = array(
      'name'          => 'Sidebar',
      'id'            => 'sidebar',
      'description'   => 'Widgets for the right column of the all '. get_bloginfo('name') . ' subpages',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>'
    );

    register_sidebar($args);    
  }

endif;

add_action( 'widgets_init', 'uw_widgets_init' );


/**
 * Social Media Buttons
 *
 */
if ( ! function_exists( 'social_media' ) ):

  function social_media( $id = null ) 
  {
    echo get_social_media($id);
  }

endif;

add_filter('the_content', 'force_https_the_content');
add_filter('the_permalink', 'force_https_the_content');
add_filter('post_thumbnail_html', 'force_https_the_content');
add_filter('option_siteurl', 'force_https_the_content');
add_filter('option_home', 'force_https_the_content');
add_filter('option_url', 'force_https_the_content');
add_filter('option_wpurl', 'force_https_the_content');
add_filter('option_stylesheet_url', 'force_https_the_content');
add_filter('option_template_url', 'force_https_the_content');


if ( ! function_exists( 'force_https_the_content' ) ):
  /**
   * For our setup, when a user is logged into WP he or she is
   * behind ssl. Imported, old content, however can still point to 
   * http, which causes some issued like images not loading (even though they 
   * are accessible through https). This function patches that issue specifically
   * for images.
   */
    function force_https_the_content($content) {
        if ( is_ssl() )
        {
          $content = str_replace( 'src="http://', 'src="https://', $content );
        }
        return $content;
    }

endif;

if ( ! function_exists( 'get_social_media' ) ):

  function get_social_media( $id = null ) 
  {
    wp_register_script('social-media-js', get_bloginfo('template_url') . '/js/social-media.js', 'jquery');
    wp_enqueue_script('social-media-js');

    wp_register_style('social-media-css', get_bloginfo('template_url') . '/css/social-media.css', 'jquery');
    wp_enqueue_style('social-media-css');

    if ( $id == null ) {
      global $post;
      $permalink = get_permalink( $post->ID );
    } else if ($id == 'home') {
      $permalink = home_url();
    } else {
      $permalink = get_permalink( $id );
    }
    $url = (is_user_logged_in()) ? $permalink : 
                                   str_replace('.edu/cms/', '.edu/', $permalink );
    if ( !$post ) {
      $page_id = get_page_by_path( 'homepage' );
      $post = get_post($page_id);
    }

    $html = "<ul class='social-media'>" . 
              "<li class='fb'><a href='#'>" . 
              "<div class='facebook-like' data-href='$url' data-send='false' data-layout='button_count' data-width='30' data-show-faces='false'></div>" . 
              "</a></li>" . 
              "<li class='twit'>" .
              "<a class='twitter-share' href='http://twitter.com/share' data-url='$url'>Tweet</a>" .
              "</li>" . 
              "<li class='email'><a href='#' class='email-ajax' data-id='$post->ID'>Email</a></li>" . 
              "<li class='count' data-url='$url'></li>" . 
           "</ul>";
    return $html; 
  }

endif;

require( get_template_directory() . '/inc/patch-band-options.php' );
require( get_template_directory() . '/inc/media-credit.php' );
require( get_template_directory() . '/inc/custom-widgets.php' );
require( get_template_directory() . '/inc/custom-settings.php' );
require( get_template_directory() . '/inc/custom-image-sizes.php' );
require( get_template_directory() . '/inc/custom-image-shortcode.php' );
require( get_template_directory() . '/inc/dropdown-walker.php' );
require( get_template_directory() . '/inc/helper-functions.php' );

if ( is_admin() )  {
  require( get_template_directory() . '/admin/autocomplete-authors.php' );
  require( get_template_directory() . '/admin/custom-user-info-fields.php' );
}
?>
