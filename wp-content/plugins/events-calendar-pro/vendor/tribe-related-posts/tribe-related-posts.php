<?php
/*
 Plugin Name: Tribe Related Posts
 Description: Template tags and shortcode to display related posts by taxonomy.
 Author: Modern Tribe, Inc., Paul Hughes
 Version: 1.1
 Author URI: http://m.tri.be/4p
 */

// Include plugin files.
require_once( 'tribe-related-posts.class.php' );
require_once( 'tribe-related-posts-widget.php' );
require_once( 'template-tags.php' );

TribeRelatedPosts::instance();