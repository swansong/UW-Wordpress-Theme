<?php
function patch_band_options_menu() {
	add_theme_page( 'Patch & Band', 'Patch & Band', 'administrator', 'uw-patch-band',	'patch_band_options_html'		);
} 
add_action( 'admin_menu', 'patch_band_options_menu' );

function patch_band_initialize_options() {

	// If the theme options don't exist, create them.
	if( false == get_option( 'patchband' ) ) {
		add_option( 'patchband' );
	} // end if

	// First, we register a section. This is necessary since all future options must belong to a
	add_settings_section(
		'patchband_header_section',			// ID used to identify this section and with which to register options
		'Header Options',					// Title to be displayed on the administration page
		'sandbox_general_options_callback',	// Callback used to render the description of the section
		'patchband'		// Page on which to add this section of options
	);

	// Next, we'll introduce the fields for toggling the visibility of content elements.
	add_settings_field(
		'show_patch',						// ID used to identify the field throughout the theme
		'Show Patch',							// The label to the left of the option interface element
		'show_patch_toggle_header_callback',	// The name of the function responsible for rendering the option interface
		'patchband',	// The page on which this option will be displayed
		'patchband_header_section'			// The name of the section to which this field belongs
	);

	add_settings_field(
		'patch_color',
		'Patch Color',
		'patch_color_toggle_content_callback',
		'patchband',
		'patchband_header_section'
	);

	add_settings_field(
		'band_color',
		'Band Color',
		'band_color_header_callback',
		'patchband',
		'patchband_header_section'
	);

	add_settings_field(
		'wordmark_color',
		'Wordmark Color',
		'wordmark_color_header_callback',
		'patchband',
		'patchband_header_section'
	);

  /**
   * No need for a custom footer at the moment
   *
	add_settings_section(
		'patchband_footer_section',			// ID used to identify this section and with which to register options
		'Footer Options',					// Title to be displayed on the administration page
		'sandbox_general_options_callback',	// Callback used to render the description of the section
		'patchband'		// Page on which to add this section of options
	);

	// Next, we'll introduce the fields for toggling the visibility of content elements.
	add_settings_field(
		'show_patch',						// ID used to identify the field throughout the theme
		'Show Patch',							// The label to the left of the option interface element
		'showhide_callback',	// The name of the function responsible for rendering the option interface
		'patchband',	// The page on which this option will be displayed
		'patchband_footer_section'			// The name of the section to which this field belongs
	);

	add_settings_field(
		'patch_color',
		'Patch Color',
		'patchcolor_callback',
		'patchband',
		'patchband_footer_section'
	);

	add_settings_field(
		'band_color',
		'Band Color',
		'band_color_footer_callback',
		'patchband',
		'patchband_footer_section'
	);
   */

	// Finally, we register the fields with WordPress
	register_setting( 'patchband', 'patchband' );

} 
add_action('admin_init', 'patch_band_initialize_options');

function sandbox_general_options_callback() {
	echo '<p>Select which areas of content you wish to display.</p>';
}


/* Header options */
function band_color_header_callback () 
{
	$options = (array) get_option('patchband');
	$html = '<input type="radio" name="patchband[band][header][color]" value="purple" ' . checked( $options['band']['header']['color'], 'purple', false ) . '/>';
	$html .= '<label title="Purple band"> Purple </label><br/>'; 
	$html .= '<input type="radio" name="patchband[band][header][color]" value="tan" ' . checked( $options['band']['header']['color'], 'tan' , false ) . '/>';
	$html .= '<label title="Tan band"> Tan </label><br/>'; 
	echo $html;
}
function show_patch_toggle_header_callback() {
	$options = (array) get_option('patchband');
	$html = '<input class="header-show" type="checkbox" name="patchband[patch][header][visible]" value="1" ' . checked(1, $options['patch']['header']['visible'], false) . '/>'; 
	$html .= '<label for="patchband[patch][header][visible]"> Show / hide</label><br/>'; 
	echo $html;
} 

function patch_color_toggle_content_callback() {
	$options = (array) get_option('patchband');
	$html = '<input type="radio" name="patchband[patch][header][color]" value="purple" ' . checked( $options['patch']['header']['color'], 'purple', false ) . '/>';
	$html .= '<label title="Purple patch"> Purple </label><br/>'; 
	$html .= '<input type="radio" name="patchband[patch][header][color]" value="gold" ' . checked( $options['patch']['header']['color'], 'gold' , false ) . '/>';
	$html .= '<label title="Gold patch"> Gold </label><br/>'; 
	echo $html;
}

function wordmark_color_header_callback() {
	$options = (array) get_option('patchband');
	$html = '<input type="radio" name="patchband[wordmark][header][color]" value="purple" ' . checked( $options['wordmark']['header']['color'], 'purple' , false ) . '/>';
	$html .= '<label title="Purple wordmark"> Purple </label><br/>'; 
	$html .= '<input type="radio" name="patchband[wordmark][header][color]" value="white" ' . checked( $options['wordmark']['header']['color'], 'white', false ) . '/>';
	$html .= '<label title="White wordmark"> White </label><br/>'; 
	echo $html;
}


/* Footer options
 *
 *
function patchcolor_callback() {
	$options = (array) get_option('patchband');
	$html = '<input type="radio" name="patchband[patch][footer][color]" value="purple" ' . checked( $options['patch']['footer']['color'], 'purple', false ) . '/>';
	$html .= '<label title="Purple patch"> Purple </label><br/>'; 
	$html .= '<input type="radio" name="patchband[patch][footer][color]" value="gold" ' . checked( $options['patch']['footer']['color'], 'gold' , false ) . '/>';
	$html .= '<label title="Gold patch"> Gold </label><br/>'; 
	echo $html;
}

function showhide_callback() {
	$options = (array) get_option('patchband');
	$html = '<input class="footer-show" type="checkbox" name="patchband[patch][footer][visible]" value="1" ' . checked(1, $options['patch']['footer']['visible'], false) . '/>'; 
	$html .= '<label for="patchband[patch][footer][visible]"> Show / hide</label><br/>'; 
	echo $html;
}
function band_color_footer_callback () 
{
	$options = (array) get_option('patchband');
	$html = '<input type="radio" name="patchband[band][footer][color]" value="purple" ' . checked( $options['band']['footer']['color'], 'purple', false ) . '/>';
	$html .= '<label title="Purple band"> Purple </label><br/>'; 
	$html .= '<input type="radio" name="patchband[band][footer][color]" value="tan" ' . checked( $options['band']['footer']['color'], 'tan' , false ) . '/>';
	$html .= '<label title="Tan band"> Tan </label><br/>'; 
	echo $html;
}
 */


add_action( 'appearance_page_uw-patch-band', 'uw_patch_band_style' );
if ( ! function_exists( 'uw_patch_band_style' ) ): 

  function uw_patch_band_style() {
    wp_enqueue_script( 'jquery-ui-core' );
    wp_enqueue_style( 'style' , get_template_directory_uri() . '/style.css');
    wp_enqueue_script( 'patchband_script', get_template_directory_uri() . '/inc/patchband.js');
    wp_enqueue_script( 'jquery.color.js', 'https://raw.github.com/brandonaaron/jquery-cssHooks/master/color.js' );
    wp_enqueue_style( 'patchband_style', get_template_directory_uri() . '/inc/patchband.css');
  }

endif;

function patch_band_options_html() {
?>
  <style>
    .patch-band-canvas { position:relative; }
    .patch-band-canvas #thin-strip { position:absolute; }
    .patch-band-canvas .main-search { display:none; }
    .patch-band-canvas #header { position: relative; }
    .patch-band-canvas ul { padding: 0; margin: 0 0 9px 25px; }
    .patch-band-canvas a { text-decoration: none; }
    .patch-band-canvas a:hover { text-decoration: underline; }
  </style>

	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>
		<h2>Patch & Band Options</h2>
		<?php settings_errors(); ?>

  <div class="patch-band-canvas">
    <?php get_template_part('banner'); ?> </header>
  </div>

		<form method="post" action="options.php">
			<?php settings_fields( 'patchband' ); ?>
			<?php do_settings_sections( 'patchband' ); ?>
			<?php submit_button(); ?>
		</form>

	</div>
<?php
} 

?>
