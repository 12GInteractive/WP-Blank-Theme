<?php

// ◆◆◆◆◆◆◆◆◆◆◆◆◆◆  FUNCTIONS  ◆◆◆◆◆◆◆◆◆◆◆◆◆ //
//  ◇ External Modules/Files                
//  ◇ Theme Support                         
//  ◇ Actions & Filters & Shortcodes        
//  ◇ Custom Post Types                     
// ◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆ //

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
// ※ EXTERNAL MODULES/FILES                                   
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

// You can place your Options Panel code here
if(!class_exists('rh_Options')){
  require_once('admin/options.php');
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
// ※ THEME SUPPORT                                            
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

if (function_exists('add_theme_support'))
{
  add_theme_support('menus'); // Add Menu Support
  add_theme_support('post-thumbnails'); // Add Thumbnail Theme Support
  add_image_size('large', 700, '', true); // Large Thumbnail
  add_image_size('medium', 250, '', true); // Medium Thumbnail
  add_image_size('small', 120, '', true); // Small Thumbnail
  add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

  add_theme_support('automatic-feed-links'); // Enables post and comment RSS feed links to head
  load_theme_textdomain('vg', get_template_directory() . '/languages'); // Localization Support
}


// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
// ※ FUNCTIONS                                              
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

// Navigation
function vg_nav() 
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '', 
		'container'       => 'div', 
		'container_class' => 'menu-{menu slug}-container', 
		'container_id'    => '',
		'menu_class'      => 'menu', 
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}
// Load conditional scripts
// function vg_conditional_scripts() 
// {
//   if (is_page('pagenamehere')) {
//     wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0', true); // Conditional script(s)
//     wp_enqueue_script('scriptname'); // Enqueue it!
//   }
// }
// Load scripts
function vg_header_scripts()  
{
  if (!is_admin()) {
    wp_deregister_script('jquery'); // Deregister WordPress jQuery
    wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', array(), '1.9.1');
    wp_register_script('modernizr', 'http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js', array(), '2.6.2'); 
    wp_register_script('plugins', get_template_directory_uri() . '/js/plugins.js', array(), '1.0.0'); 
    wp_register_script('scripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0', true); // adding "true" will enqueue in the footer
    
    wp_enqueue_script('jquery'); 
    wp_enqueue_script('modernizr'); 
    wp_enqueue_script('plugins'); 
    wp_enqueue_script('scripts'); 
  }
}

// Load styles
function vg_styles() 
{
  wp_register_style('style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
  wp_register_style('reset', get_template_directory_uri() . '/css/reset.css', array(), '1.0', 'all');
  wp_register_style('grid', get_template_directory_uri() . '/css/grid.css', array(), '1.0', 'all');
  wp_register_style('global', get_template_directory_uri() . '/css/global.css', array(), '1.0', 'all');
  
  wp_enqueue_style('style'); 
  wp_enqueue_style('reset'); 
  wp_enqueue_style('grid'); 
  wp_enqueue_style('global'); 
}

// Register Navigation
function register_vg_menu() 
{
  register_nav_menus(array( // Using array to specify more menus if needed
    'header-menu' => __('Header Menu', 'vg'), // Main Navigation
    'sidebar-menu' => __('Sidebar Menu', 'vg'), // Sidebar Navigation
    'extra-menu' => __('Extra Menu', 'vg') // Extra Navigation if needed (duplicate as many as you need!)
  ));
}

// Remove Dashboard Menu Items
function vg_remove_menu_pages() {
  // remove_menu_page('options-general.php'); 
}

// Add page slug to body class
function add_slug_to_body_class($classes)
{
  global $post;
  if (is_home()) {
    $key = array_search('blog', $classes);
    if ($key > -1) {
        unset($classes[$key]);
    }
  } elseif (is_page()) {
    $classes[] = sanitize_html_class($post->post_name);
  } elseif (is_singular()) {
    $classes[] = sanitize_html_class($post->post_name);
  }
  return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
  // Define Sidebar Widget Area 1
  register_sidebar(array(
    'name' => __('Widget Area 1', 'vg'),
    'description' => __('Description for this widget-area...', 'vg'),
    'id' => 'widget-area-1',
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));

  // Define Sidebar Widget Area 2
  register_sidebar(array(
    'name' => __('Widget Area 2', 'vg'),
    'description' => __('Description for this widget-area...', 'vg'),
    'id' => 'widget-area-2',
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
  global $wp_widget_factory;
  remove_action('wp_head', array(
    $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
    'recent_comments_style'
  ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function vgwp_pagination()
{
  global $wp_query;
  $big = 999999999;
  echo paginate_links(array(
    'base' => str_replace($big, '%#%', get_pagenum_link($big)),
    'format' => '?paged=%#%',
    'current' => max(1, get_query_var('paged')),
    'total' => $wp_query->max_num_pages
  ));
}

// Custom Excerpts
function vgwp_index($length) // Create 20 Word Callback for Index page Excerpts, call using vgwp_excerpt('vgwp_index');
{
  return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using vgwp_excerpt('vgwp_custom_post');
function vgwp_custom_post($length)
{
  return 40;
}

// Create the Custom Excerpts callback
function vgwp_excerpt($length_callback = '', $more_callback = '')
{
  global $post;
  if (function_exists($length_callback)) {
      add_filter('excerpt_length', $length_callback);
  }
  if (function_exists($more_callback)) {
      add_filter('excerpt_more', $more_callback);
  }
  $output = get_the_excerpt();
  $output = apply_filters('wptexturize', $output);
  $output = apply_filters('convert_chars', $output);
  $output = '<p>' . $output . '</p>';
  echo $output;
}

// Custom View Article link to Post
function vg_view_article($more)
{
  global $post;
  return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'vg') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
  return false;
}

// Remove 'text/css' from our enqueued stylesheet
function vg_style_remove($tag)
{
  return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
  $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
  return $html;
}

// Custom Gravatar in Settings > Discussion
function vggravatar ($avatar_defaults)
{
  $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
  $avatar_defaults[$myavatar] = "Custom Gravatar";
  return $avatar_defaults;
}
// Threaded Comments
function enable_threaded_comments()
{
  if (!is_admin()) {
    if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script('comment-reply');
    }
  }
}

// Custom Comments Callback
function vgcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }


// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
// ※ ACTIONS & FILTERS & SHORTCODES                       
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

// Actions
add_action('init', 'vg_header_scripts'); // Add Custom Scripts to wp_head
// add_action('wp_print_scripts', 'vg_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'vg_styles'); // Add Theme Stylesheet
add_action('init', 'register_vg_menu'); // Add Menu
add_action('init', 'create_post_type_vg'); // Add Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'vgwp_pagination'); // Add Pagination
// add_action( 'admin_menu', 'vg_remove_menu_pages' ); // Remove Dashboard menu items
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
// Filters
// add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) ); // Disable WP update notice
// add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) ); // Disable plugin update notification
add_filter('avatar_defaults', 'vggravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'vg_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'vg_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether
// Shortcodes
//add_shortcode('vg_shortcode_demo', 'vg_shortcode_demo'); 
//add_shortcode('vg_shortcode_demo_2', 'vg_shortcode_demo_2'); 


// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
// ※ CUSTOM POST TYPES                                     
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

// Create 1 Custom Post type for a Demo
function create_post_type_vg()
{
  register_taxonomy_for_object_type('category', 'vg-custom'); // Register Taxonomies for Category
  register_taxonomy_for_object_type('post_tag', 'vg-custom');
  register_post_type('vg-custom', // Register Custom Post Type
    array(
    'labels' => array(
      'name' => __('VG Custom Post', 'vg'), // Rename these to suit
      'singular_name' => __('VG Custom Post', 'vg'),
      'add_new' => __('Add New', 'vg'),
      'add_new_item' => __('Add New VG Custom Post', 'vg'),
      'edit' => __('Edit', 'vg'),
      'edit_item' => __('Edit VG Custom Post', 'vg'),
      'new_item' => __('New VG Custom Post', 'vg'),
      'view' => __('View VG Custom Post', 'vg'),
      'view_item' => __('View VG Custom Post', 'vg'),
      'search_items' => __('Search VG Custom Post', 'vg'),
      'not_found' => __('No VG Custom Posts found', 'vg'),
      'not_found_in_trash' => __('No VG Custom Posts found in Trash', 'vg')
    ),
    'public' => true,
    'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
    'has_archive' => true,
    'supports' => array(
      'title',
      'editor',
      'excerpt',
      'thumbnail'
    ), // Go to Dashboard Custom post for supports
    'can_export' => true, // Allows export in Tools > Export
    'taxonomies' => array(
      'post_tag',
      'category'
    ) // Add Category and Post Tags support
  ));
}


// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //
// ※ SHORTCODES                                            
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

// Shortcode Demo with Nested Capability
function vg_shortcode_demo($atts, $content = null)
{
  return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function vg_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
  return '<h2>' . $content . '</h2>';
}

?>