<?php 
//ACTIVATION
global $pagenow;
if (is_admin() && isset($_GET['activated'])  && $pagenow == "themes.php"){

	// redirect to theme options
	wp_redirect(admin_url("admin.php?page=".SHORTNAME."_dummy"));		
}
//CLEANUP

// remove WordPress version from RSS feed
function th_no_generator() { return ''; }
add_filter('the_generator', 'th_no_generator');

// cleanup wp_head
function th_noindex() {
	if (get_option('blog_public') === '0') {
    echo '<meta name="robots" content="noindex,nofollow">', "\n";
  }
}	
add_filter( 'media_view_strings', 'th_media_view_strings' );
/**
 * Removes the media 'From URL' string.
 *
 * @see wp-includes|media.php
 */
function th_media_view_strings( $strings ) {
	global $admin_menu;
	if($admin_menu && $admin_menu->isEditThemeSubmenu())
	{
		unset( $strings['insertFromUrlTitle'] );
	}
    return $strings;
}
function th_rel_canonical() {
	if (!is_singular()) {
		return;
  }

	global $wp_the_query;
	if (!$id = $wp_the_query->get_queried_object_id()) {
		return;
  }

	$link = get_permalink($id);
	echo "\t<link rel=\"canonical\" href=\"$link\">\n";
}

// remove CSS from recent comments widget
function th_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
	}
}

// remove CSS from gallery
function th_gallery_style($css) {
	return preg_replace("/<style type='text\/css'>(.*?)<\/style>/s", '', $css);
}

function th_head_cleanup() {
	// http://wpengineer.com/1438/wordpress-header/
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
	remove_action('wp_head', 'noindex', 1);	
	add_action('wp_head', 'th_noindex');
	remove_action('wp_head', 'rel_canonical');	
	add_action('wp_head', 'th_rel_canonical');
	add_action('wp_head', 'th_remove_recent_comments_style', 1);	
	add_filter('gallery_style', 'th_gallery_style');
}

add_action('init', 'th_head_cleanup');

////
//OTHER TWEAKS
////


// we don't need to self-close these tags in html5:
// <img>, <input>
function th_remove_self_closing_tags($input) {
	return str_replace(' />', '>', $input);
}

add_filter('get_avatar', 'th_remove_self_closing_tags');
add_filter('comment_id_fields', 'th_remove_self_closing_tags');

// set the post revisions to 5 unless the constant
// was set in wp-config.php to avoid DB bloat
if (!defined('WP_POST_REVISIONS')) define('WP_POST_REVISIONS', 5);

// allow more tags in TinyMCE including iframes
function th_change_mce_options($options) {
	$ext = 'pre[id|name|class|style],iframe[align|longdesc|name|width|height|frameborder|scrolling|marginheight|marginwidth|src]';	
	if (isset($initArray['extended_valid_elements'])) {
		$options['extended_valid_elements'] .= ',' . $ext;
	} else {
		$options['extended_valid_elements'] = $ext;
	}
	return $options;
}

add_filter('tiny_mce_before_init', 'th_change_mce_options');

//clean up the default WordPress style tags
add_filter('style_loader_tag', 'th_clean_style_tag');

function th_clean_style_tag($input) {
  preg_match_all("!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches);
  //only display media if it's print
  $media = $matches[3][0] === 'print' ? ' media="print"' : '';                                                                             
  return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
}

//lightbox replace

add_filter('the_content', 'th_addlightboxrel_replace', 12);

add_filter('get_comment_text', 'th_addlightboxrel_replace');

function th_addlightboxrel_replace ($content)
{   global $post;
	$pattern = "/(<a\s*(?!.*\bdata-pp=)[^>]*) ?(href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")) ?(class=('|\")(.*?)('|\"))?/i";
    $replacement = '$1 href=$3$4.$5$6 data-pp="lightbox['.$post->ID.']" class="autolink lightbox $9" ';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}

//SEO meta

function th_add_theme_favicon() {
	if( get_option(SHORTNAME."_favicon")) { 
	 ?>
	<link rel="shortcut icon" href="<?php echo get_option(SHORTNAME."_favicon"); ?>" />
<?php } }
add_action('wp_head', 'th_add_theme_favicon');

function th_default_comments_off( $data ) {
	// each custom post type has default_comments_off method to.
    if($data['post_type'] == 'page' && $data['post_status'] == 'auto-draft')
	{
        $data['comment_status'] = 0;
		$data['ping_status'] = 0;
    }
	
    return $data;
}
add_filter( 'wp_insert_post_data', 'th_default_comments_off' );


function th_imgborder_from_editor($class){
$class=$class.' imgborder';
return $class;
}
add_filter('get_image_tag_class','th_imgborder_from_editor');


function th_default_widgets_init() {	

  if ( isset( $_GET['activated'] ) ) {
  
  		update_option( 'sidebars_widgets', array (
							 'default-sidebar' => array('search')
							 ));
  }
}
add_action('widgets_init', 'th_default_widgets_init');


// CUSTOM ADMIN LOGIN HEADER LOGO
function th_custom_login_logo()
{
	if (get_option(SHORTNAME . "_linkscolor"))
	{
		$customcolor = get_option(SHORTNAME . "_linkscolor");
	}
	else
	{
		$customcolor = "#C62B02";
	}
	echo '<style type="text/css"> h1 a { background-image:url(' . get_template_directory_uri() . '/images/logo.png) !important;background-size:auto !important } body {background-color:' . $customcolor . ' !important } #nav a, #backtoblog a {background:#fff;}</style>';
	$customcolor = NULL;
}
   
   
if (!get_option(SHORTNAME . "_loginstyledisable"))
{
	add_action('login_head', 'th_custom_login_logo');
}   

// CUSTOMIZE ADMIN MENU ORDER
function th_custom_menu_order($menu_ord)
{
	if (!$menu_ord)
	{
		return true;
	}
	return array(
		'index.php',
		'separator1',
		'edit.php',
		'edit.php?post_type=page',
		'edit.php?post_type=' . Custom_Posts_Type_Event::POST_TYPE,
		'edit.php?post_type=' . Custom_Posts_Type_Gallery::POST_TYPE,
		'edit.php?post_type=' . Custom_Posts_Type_Slideshow::POST_TYPE,
		'edit.php?post_type=' . Custom_Posts_Type_Testimonial::POST_TYPE,
		'revslider',
		'separator2',
		SHORTNAME . '_general',
		'separator-last'
	);
}

add_filter('custom_menu_order', 'th_custom_menu_order');
add_filter('menu_order', 'th_custom_menu_order');

// CUSTOM USER PROFILE FIELDS
function th_custom_userfields($contactmethods)
{
	// ADD CONTACT CUSTOM FIELDS
	
	$contactmethods['contact_facebook'] = __('Facebook','churchope');	
	$contactmethods['contact_phone_office'] = __('Office Phone','churchope');
	$contactmethods['contact_phone_mobile'] = __('Mobile Phone','churchope');
	$contactmethods['contact_office_fax'] = __('Office Fax','churchope');

	// ADD ADDRESS CUSTOM FIELDS
	$contactmethods['address_line_1'] = __('Address Line 1','churchope');
	$contactmethods['address_line_2'] = __('Address Line 2 (optional)','churchope');
	$contactmethods['address_city'] = __('City','churchope');
	$contactmethods['address_state'] = __('State','churchope');
	$contactmethods['address_zipcode'] = __('Zipcode','churchope');
	return $contactmethods;
}

add_filter('user_contactmethods', 'th_custom_userfields', 10, 1);
   
   
//Remove read more page jump
function th_remove_more_jump_link($link)
{
	$offset = strpos($link, '#more-');
	if ($offset)
	{
		$end = strpos($link, '"', $offset);
	}
	if ($end)
	{
		$link = substr_replace($link, '', $offset, $end - $offset);
	}
	return $link;
}

add_filter('the_content_more_link', 'th_remove_more_jump_link');

//remove pings to self
function th_no_self_ping(&$links)
{
	$home = home_url();
	foreach ($links as $l => $link)
	{
		if (0 === strpos($link, $home))
			unset($links[$l]);
	}
}

add_action('pre_ping', 'th_no_self_ping');

// customize admin footer text
function th_custom_admin_footer() {
        echo 'Copyrighted by '.get_option('blogname').'. | Developed by <a href="http://themoholics.com" title="WordPress Premium Themes" >Themoholics</a>.';
} 
add_filter('admin_footer_text', 'th_custom_admin_footer');

//
function th_new_excerpt_more($more) {
	return '...';
}

add_filter('excerpt_more', 'th_new_excerpt_more');

//excerpt length
function excerpt($num) {
    $limit = $num+1;
	$cleaned = $text = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', get_the_excerpt());
    $excerpt = substr($cleaned,0, $limit);
    
    $excerpt .= "...";
    echo $excerpt;
}

// Theme default avatar
add_filter( 'avatar_defaults', 'th_newgravatar' );

function th_newgravatar ($avatar_defaults) {
    $myavatar = get_template_directory_uri() . '/images/noava.png';
    $avatar_defaults[$myavatar] = THEMENAME;
    return $avatar_defaults;
}


//Responsive twitter
function th_twitter_oembed_hotfix( $html, $data, $url ) {
	// remove the blockquote width attribute and value from the twitter oembed html response and return the filtered version
	$html = str_ireplace( '<blockquote class="twitter-tweet" width="550">', '<blockquote class="twitter-tweet">', $html );
	return $html;
}
add_filter( 'embed_oembed_html', 'th_twitter_oembed_hotfix', 10, 3 );
	
	
function th_the_content($content)
{
	/**
	* @see http://wordpress.stackexchange.com/questions/9667/get-wordpress-post-content-by-post-id
	*/
	
	$content = wpautop($content);
	$content = do_shortcode($content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}

function ajax_captcha_check()
{
	require_once get_template_directory() . '/lib/recaptchalib.php';
	$resp = recaptcha_check_answer(
			get_option(SHORTNAME . '_captcha_private_key'),
			$_SERVER["REMOTE_ADDR"],
			$_POST["recaptcha_challenge_field"],
			$_POST["recaptcha_response_field"]);

	header('Content-Type: application/json');
	die(json_encode($resp));
}
add_action('wp_ajax_captcha_check', 'ajax_captcha_check');
add_action('wp_ajax_nopriv_captcha_check', 'ajax_captcha_check');

function th_ajax_calendar_walker()
{
	require_once get_template_directory() . '/lib/shortcode/eventsCalendar.php';
	die();
}
add_action('wp_ajax_calendar_walker', 'th_ajax_calendar_walker');
add_action('wp_ajax_nopriv_calendar_walker', 'th_ajax_calendar_walker');

function th_ajax_send_contact_form()
{
	require_once get_template_directory() . '/lib/shortcode/contactForm/contactsend.php';
	die();
}
add_action('wp_ajax_send_contact_form', 'th_ajax_send_contact_form');
add_action('wp_ajax_nopriv_send_contact_form', 'th_ajax_send_contact_form');

function th_recaptcha_get_html($error = null)
{
	if(get_option(SHORTNAME . '_captcha_private_key'))
	{
		if($publickey = get_option(SHORTNAME . '_captcha_public_key') )
		{
			require_once get_template_directory() . '/lib/recaptchalib.php';
			return recaptcha_get_html($publickey, $error, is_ssl());
		}
	}
	return '';
}
?>