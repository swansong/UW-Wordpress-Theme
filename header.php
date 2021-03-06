<!doctype html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0" />
  <title>
    <?php
      /*
       * Print the <title> tag based on what is being viewed.
       */
      global $page, $paged;

      wp_title( '|', true, 'right' );

      // Add the blog name.
      bloginfo( 'name' );

      // Add the blog description for the home/front page.
      $site_description = get_bloginfo( 'description', 'display' );
      if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description";

      // Add a page number if necessary:
      if ( $paged >= 2 || $page >= 2 )
        echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
    ?>
  </title>

  <?php wp_head(); ?>

<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/print.css" type="text/css" media="print" />

<!--[if lt IE 9]>
  <script src="<?php bloginfo("template_directory"); ?>/js/html5shiv.js" type="text/javascript"></script>
  <script src="<?php bloginfo("template_directory"); ?>/js/respond.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo("template_directory"); ?>/css/ie8-and-down.css" />
<![endif]-->


</head>

<body <?php body_class(); ?>>


<?php get_template_part('banner'); ?>
<?php get_template_part('dropdowns'); ?>
