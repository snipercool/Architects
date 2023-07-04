<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package architects
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://use.typekit.net/yuc6ahm.css">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> dir="ltr">
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'achillesdesign' ); ?></a>

	<header class="flex h-20 flex-d-col-lg w-full  flex-wrap align-center bg-creme space-between absolute z-10">
    <div class="logo-cont flex flex-1 align-center space-between">
      <a href="/" class="logo">
        ARCHITECTS
      </a>
	  <div class="pointer hidden-lg hamburger-menu">
	  	<svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
        <title>menu</title>
        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path></svg>
	</div>
    </div>

    <div class="hidden w-auto flex-lg align-center-lg" id="primary-menu">
		<?php wp_nav_menu( array( 'menu' => 'primary' ) );?>
    </div>
  </header>
  AuorA7co4kuBwfZIDA859y(p
  WebitSollicitatie#1
  2R6OZIAWc%