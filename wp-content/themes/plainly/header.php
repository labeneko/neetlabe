<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Plainly
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<div id="content" class="site-content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<header id="masthead" class="site-header" role="banner">
			<div><img src="http://neetla.be/wp-content/uploads/2015/07/k-welcm.gif"></div>
			<div><img src="http://neetla.be/wp-content/uploads/2015/07/coollogo_com-232372750.gif"></div>
			<div class="ticker">
                <p>Welcome to にーとらべ！！！</p>
            </div>
			<div><img src="http://neetla.be/wp-content/uploads/2015/07/labeneko.png" style="width: 700px;"></div>
			</header><!-- #masthead -->