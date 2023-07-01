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

	<header class="flex h-20 flex-d-col-lg w-full flex-wrap align-center bg-transparent space-between absolute z-10">
    <div class="flex flex-1 align-center space-between">
      <a href="/" class="logo">
        ARCHITECTS
      </a>
    </div>

    <div class="pointer hidden-lg hamburger-menu"
      ><svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
        <title>menu</title>
        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path></svg>
	</div>

    <div class="hidden w-auto flex-lg align-center-lg" id="primary-menu">
      <nav>
        <ul class="align-center space-between fs-3 text-black flex-lg">
          <li><a class="block" href="#">Home</a></li>
          <li><a class="block" href="#">About</a></li>
          <li class="relative"><a class="block" href="#">projecten</a>
			<ul id="submenu" class="absolute">
			<li><a class="block" href="#">projecten</a>
			<li><a class="block" href="#">projecten</a>
			<li><a class="block" href="#">projecten</a>
			<li><a class="block" href="#">projecten</a>
			</ul></li>
          <li><a class="block" href="#">contact</a></li>
        </ul>
      </nav>
    </div>
  </header>
