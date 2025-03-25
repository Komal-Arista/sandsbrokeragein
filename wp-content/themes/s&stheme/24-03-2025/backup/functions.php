<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

// This theme requires WordPress 5.3 or later.
if ( version_compare( $GLOBALS['wp_version'], '5.3', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twenty_twenty_one_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @return void
	 */
	function twenty_twenty_one_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Twenty-One, use a find and replace
		 * to change 'twentytwentyone' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'twentytwentyone', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary menu', 'twentytwentyone' ),
				'footer'  => esc_html__( 'Secondary menu', 'twentytwentyone' ),
				'services'  => esc_html__( 'services menu', 'twentytwentyone' ),
				'others'  => esc_html__( 'Others menu', 'twentytwentyone' ),
				'news'  => esc_html__( 'News menu', 'twentytwentyone' ),
				'topmenu'  => esc_html__( 'Top menu', 'twentytwentyone' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/*
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		$background_color = get_theme_mod( 'background_color', 'D1E4DD' );
		if ( 127 > Twenty_Twenty_One_Custom_Colors::get_relative_luminance_from_hex( $background_color ) ) {
			add_theme_support( 'dark-editor-style' );
		}

		$editor_stylesheet_path = './assets/css/style-editor.css';

		// Note, the is_IE global variable is defined by WordPress and is used
		// to detect if the current browser is internet explorer.
		global $is_IE;
		if ( $is_IE ) {
			$editor_stylesheet_path = './assets/css/ie-editor.css';
		}

		// Enqueue editor styles.
		add_editor_style( $editor_stylesheet_path );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Extra small', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XS', 'Font size', 'twentytwentyone' ),
					'size'      => 16,
					'slug'      => 'extra-small',
				),
				array(
					'name'      => esc_html__( 'Small', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'S', 'Font size', 'twentytwentyone' ),
					'size'      => 18,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'M', 'Font size', 'twentytwentyone' ),
					'size'      => 20,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'L', 'Font size', 'twentytwentyone' ),
					'size'      => 24,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Extra large', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XL', 'Font size', 'twentytwentyone' ),
					'size'      => 40,
					'slug'      => 'extra-large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XXL', 'Font size', 'twentytwentyone' ),
					'size'      => 96,
					'slug'      => 'huge',
				),
				array(
					'name'      => esc_html__( 'Gigantic', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XXXL', 'Font size', 'twentytwentyone' ),
					'size'      => 144,
					'slug'      => 'gigantic',
				),
			)
		);

		// Custom background color.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'd1e4dd',
			)
		);

		// Editor color palette.
		$black     = '#000000';
		$dark_gray = '#28303D';
		$gray      = '#39414D';
		$green     = '#D1E4DD';
		$blue      = '#D1DFE4';
		$purple    = '#D1D1E4';
		$red       = '#E4D1D1';
		$orange    = '#E4DAD1';
		$yellow    = '#EEEADD';
		$white     = '#FFFFFF';

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__( 'Black', 'twentytwentyone' ),
					'slug'  => 'black',
					'color' => $black,
				),
				array(
					'name'  => esc_html__( 'Dark gray', 'twentytwentyone' ),
					'slug'  => 'dark-gray',
					'color' => $dark_gray,
				),
				array(
					'name'  => esc_html__( 'Gray', 'twentytwentyone' ),
					'slug'  => 'gray',
					'color' => $gray,
				),
				array(
					'name'  => esc_html__( 'Green', 'twentytwentyone' ),
					'slug'  => 'green',
					'color' => $green,
				),
				array(
					'name'  => esc_html__( 'Blue', 'twentytwentyone' ),
					'slug'  => 'blue',
					'color' => $blue,
				),
				array(
					'name'  => esc_html__( 'Purple', 'twentytwentyone' ),
					'slug'  => 'purple',
					'color' => $purple,
				),
				array(
					'name'  => esc_html__( 'Red', 'twentytwentyone' ),
					'slug'  => 'red',
					'color' => $red,
				),
				array(
					'name'  => esc_html__( 'Orange', 'twentytwentyone' ),
					'slug'  => 'orange',
					'color' => $orange,
				),
				array(
					'name'  => esc_html__( 'Yellow', 'twentytwentyone' ),
					'slug'  => 'yellow',
					'color' => $yellow,
				),
				array(
					'name'  => esc_html__( 'White', 'twentytwentyone' ),
					'slug'  => 'white',
					'color' => $white,
				),
			)
		);

		add_theme_support(
			'editor-gradient-presets',
			array(
				array(
					'name'     => esc_html__( 'Purple to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'purple-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to purple', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'yellow-to-purple',
				),
				array(
					'name'     => esc_html__( 'Green to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $green . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'green-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to green', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $green . ' 100%)',
					'slug'     => 'yellow-to-green',
				),
				array(
					'name'     => esc_html__( 'Red to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'red-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to red', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'yellow-to-red',
				),
				array(
					'name'     => esc_html__( 'Purple to red', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'purple-to-red',
				),
				array(
					'name'     => esc_html__( 'Red to purple', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'red-to-purple',
				),
			)
		);

		/*
		* Adds starter content to highlight the theme on fresh sites.
		* This is done conditionally to avoid loading the starter content on every
		* page load, as it is a one-off operation only needed once in the customizer.
		*/
		if ( is_customize_preview() ) {
			require get_template_directory() . '/inc/starter-content.php';
			add_theme_support( 'starter-content', twenty_twenty_one_get_starter_content() );
		}

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );

		// Add support for experimental link color control.
		add_theme_support( 'experimental-link-color' );

		// Add support for experimental cover block spacing.
		add_theme_support( 'custom-spacing' );

		// Add support for custom units.
		// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
		add_theme_support( 'custom-units' );

		// Remove feed icon link from legacy RSS widget.
		add_filter( 'rss_widget_feed_link', '__return_false' );
	}
}
add_action( 'after_setup_theme', 'twenty_twenty_one_setup' );

/**
 * Register widget area.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function twenty_twenty_one_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'twentytwentyone' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'twentytwentyone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twenty_twenty_one_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @global int $content_width Content width.
 *
 * @return void
 */
function twenty_twenty_one_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twenty_twenty_one_content_width', 750 );
}
add_action( 'after_setup_theme', 'twenty_twenty_one_content_width', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_scripts() {
	// Note, the is_IE global variable is defined by WordPress and is used
	// to detect if the current browser is internet explorer.
	global $is_IE, $wp_scripts;
	if ( $is_IE ) {
		// If IE 11 or below, use a flattened stylesheet with static values replacing CSS Variables.
		wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/assets/css/ie.css', array(), wp_get_theme()->get( 'Version' ) );
	} else {
		// If not IE, use the standard stylesheet.
		wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	}

	// RTL styles.
	wp_style_add_data( 'twenty-twenty-one-style', 'rtl', 'replace' );

	// Print styles.
	//wp_enqueue_style( 'twenty-twenty-one-print-style', get_template_directory_uri() . '/assets/css/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	// Threaded comment reply styles.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Register the IE11 polyfill file.
	/*wp_register_script(
		'twenty-twenty-one-ie11-polyfills-asset',
		get_template_directory_uri() . '/assets/js/polyfills.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);*/

	// Register the IE11 polyfill loader.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills',
		null,
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
	wp_add_inline_script(
		'twenty-twenty-one-ie11-polyfills',
		wp_get_script_polyfill(
			$wp_scripts,
			array(
				'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'twenty-twenty-one-ie11-polyfills-asset',
			)
		)
	);

	// Main navigation scripts.
	/*if ( has_nav_menu( 'primary' ) ) {
		wp_enqueue_script(
			'twenty-twenty-one-primary-navigation-script',
			get_template_directory_uri() . '/assets/js/primary-navigation.js',
			array( 'twenty-twenty-one-ie11-polyfills' ),
			wp_get_theme()->get( 'Version' ),
			true
		);
	}*/

	// Responsive embeds script.
	/*wp_enqueue_script(
		'twenty-twenty-one-responsive-embeds-script',
		get_template_directory_uri() . '/assets/js/responsive-embeds.js',
		array( 'twenty-twenty-one-ie11-polyfills' ),
		wp_get_theme()->get( 'Version' ),
		true
	);*/
}
add_action( 'wp_enqueue_scripts', 'twenty_twenty_one_scripts' );

/**
 * Enqueue block editor script.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_block_editor_script() {

	wp_enqueue_script( 'twentytwentyone-editor', get_theme_file_uri( '/assets/js/editor.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}

add_action( 'enqueue_block_editor_assets', 'twentytwentyone_block_editor_script' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://git.io/vWdr2
 */
function twenty_twenty_one_skip_link_focus_fix() {

	// If SCRIPT_DEBUG is defined and true, print the unminified file.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		echo '<script>';
		include get_template_directory() . '/assets/js/skip-link-focus-fix.js';
		echo '</script>';
	} else {
		// The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
		?>
		<script>
		/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",(function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())}),!1);
		</script>
		<?php
	}
}
add_action( 'wp_print_footer_scripts', 'twenty_twenty_one_skip_link_focus_fix' );

/**
 * Enqueue non-latin language styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_non_latin_languages() {
	$custom_css = twenty_twenty_one_get_non_latin_css( 'front-end' );

	if ( $custom_css ) {
		wp_add_inline_style( 'twenty-twenty-one-style', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'twenty_twenty_one_non_latin_languages' );

// SVG Icons class.
require get_template_directory() . '/classes/class-twenty-twenty-one-svg-icons.php';

// Custom color classes.
require get_template_directory() . '/classes/class-twenty-twenty-one-custom-colors.php';
new Twenty_Twenty_One_Custom_Colors();

// Enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Menu functions and filters.
require get_template_directory() . '/inc/menu-functions.php';

// Custom template tags for the theme.
require get_template_directory() . '/inc/template-tags.php';

// Customizer additions.
require get_template_directory() . '/classes/class-twenty-twenty-one-customize.php';
new Twenty_Twenty_One_Customize();

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

// Block Styles.
require get_template_directory() . '/inc/block-styles.php';

// Dark Mode.
require_once get_template_directory() . '/classes/class-twenty-twenty-one-dark-mode.php';
new Twenty_Twenty_One_Dark_Mode();

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_preview_init() {
	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);

	wp_enqueue_script(
		'twentytwentyone-customize-preview',
		get_theme_file_uri( '/assets/js/customize-preview.js' ),
		array( 'customize-preview', 'customize-selective-refresh', 'jquery', 'twentytwentyone-customize-helpers' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_preview_init', 'twentytwentyone_customize_preview_init' );

/**
 * Enqueue scripts for the customizer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_controls_enqueue_scripts() {

	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'twentytwentyone_customize_controls_enqueue_scripts' );

/**
 * Calculate classes for the main <html> element.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_the_html_classes() {
	/**
	 * Filters the classes for the main <html> element.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @param string The list of classes. Default empty string.
	 */
	$classes = apply_filters( 'twentytwentyone_html_classes', '' );
	if ( ! $classes ) {
		return;
	}
	echo 'class="' . esc_attr( $classes ) . '"';
}

/**
 * Add "is-IE" class to body if the user is on Internet Explorer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_add_ie_class() {
	?>
	<script>
	if ( -1 !== navigator.userAgent.indexOf( 'MSIE' ) || -1 !== navigator.appVersion.indexOf( 'Trident/' ) ) {
		document.body.classList.add( 'is-IE' );
	}
	</script>
	<?php
}
add_action( 'wp_footer', 'twentytwentyone_add_ie_class' );


if ( ! function_exists( 'wp_get_list_item_separator' ) ) :
	/**
	 * Retrieves the list item separator based on the locale.
	 *
	 * Added for backward compatibility to support pre-6.0.0 WordPress versions.
	 *
	 * @since 6.0.0
	 */
	function wp_get_list_item_separator() {
		/* translators: Used between list items, there is a space after the comma. */
		return __( ', ', 'twentytwentyone' );
	}
endif;

require get_template_directory() . '/inc/acf/init.php';
require_once('wp_bootstrap_navwalker.php');

function bittersweet_pagination() {

global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) return; 

$big = 999999999; // need an unlikely integer

$pages = paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
    	'next_text'          => __( 'Next page', 'twentyfifteen' ),
        'type'  => 'array',
    ) );
    if( is_array( $pages ) ) {
        $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
        echo '<div class="pagination-wrap"><ul class="pagination">';
        foreach ( $pages as $page ) {
                echo "<li>$page</li>";
        }
       echo '</ul></div>';
        }
}

// Add custom roles with custom capability

//Super Admin Role
function add_sands_super_admin_role() {
	if (!get_role('super_admin')) {
		add_role(
			'super_admin', 
			__('Super Admin'),
			array(
				'read' => true, 
			)
		);
	}
}

add_action('init', 'add_sands_super_admin_role');

//Super Manager Role
function add_sands_super_manager_role() {
	if (!get_role('super_manager')) {
		add_role(
			'super_manager', 
			__('Super Manager'),
			array(
				'read' => true, 
			)
		);
	}
}

add_action('init', 'add_sands_super_manager_role');

//Manager Role
function add_sands_manager_role() {
	if (!get_role('manager')) {
		add_role(
			'manager', 
			__('Manager'),
			array(
				'read' => true, 
			)
		);
	}
}

add_action('init', 'add_sands_manager_role');

// Agent Role
function add_sands_agent_role() {
	if (!get_role('agent')) {
		add_role(
			'agent', 
			__('Agent'),
			array(
				'read' => true 
			)
		);
	}
}

add_action('init', 'add_sands_agent_role');

// CSV Manager Role
function add_sands_csv_manager_role() {
	if (!get_role('csv_manager')) {
		add_role(
			'csv_manager', 
			__('CSV Manager'),
			array(
				'read' => true,  // Basic capability for reading
				'manage_csv_data' => true,  // Custom capability for CSV uploads
			)
		);
	}
}

add_action('init', 'add_sands_csv_manager_role');

// Show Search page links on Account page
function show_search_page_links_on_account_page() {
    
    if ( um_is_core_page('account') ) {

		if ( is_user_logged_in() ) {

			global $wpdb;
			$table_prefix = $wpdb->prefix;
			$user = wp_get_current_user();

			$location_name = '';
			$current_user_location_id = get_user_meta($user->ID, 'user_location', true);

			if($current_user_location_id) {
				$location = $wpdb->get_results("SELECT `name` FROM {$table_prefix}locations 
							WHERE id = {$current_user_location_id}", ARRAY_A);
												
				$location_data = array_column($location, 'name');

				$location_name = !empty($location_data) ? esc_html($location_data[0]) : "";
			}
		
			// Check if the user has 'Agent' role
			if ( in_array('agent', (array) $user->roles) || in_array('manager', (array) $user->roles) || in_array('super_manager', (array) $user->roles) || in_array('super_admin', (array) $user->roles)) {
			?>
			<script>
				jQuery(document).ready(function(){
					jQuery(".um-account-side ul").append('<li id="sns-search-page"><a href="<?php echo site_url("/search/"); ?>" class="um-account-link"><span class="um-account-icontip uimob800-show um-tip-w"><i class="um-faicon-search"></i></span><span class="um-account-icon uimob800-hide"><i class="um-faicon-search"></i></span><span class="um-account-title uimob800-hide">Search</span><span class="um-account-arrow uimob800-hide"><i class="um-faicon-angle-right"></i></span></a></li>');
					jQuery('#sns-search-page').click(function(){
					   window.location.href = "<?php echo site_url('/search/'); ?>";
					});
				});
			</script>
			<?php				
			}

			if ( in_array('super_manager', (array) $user->roles) || in_array('super_admin', (array) $user->roles)) {
			?>
			<script>
				jQuery(document).ready(function(){
					jQuery(".um-account-side ul").append('<li id="sns-user-page"><a href="<?php echo site_url("/list-user/"); ?>" class="um-account-link"><span class="um-account-icontip uimob800-show um-tip-w"><i class="um-faicon-user"></i></span><span class="um-account-icon uimob800-hide"><i class="um-faicon-users"></i></span><span class="um-account-title uimob800-hide">Users List</span><span class="um-account-arrow uimob800-hide"><i class="um-faicon-angle-right"></i></span></a></li>');
					jQuery('#sns-user-page').click(function(){
						window.location.href = "<?php echo site_url('/list-user/'); ?>";
					});
				});
			</script>
			<?php				
			}

			if ( in_array('manager', (array) $user->roles) || in_array('super_manager', (array) $user->roles) || in_array('super_admin', (array) $user->roles)) {
			?>
			<script>
				jQuery(document).ready(function(){
					
					jQuery(".um-account-side ul").append('<li id="sns-adv-search-page"><a href="<?php echo site_url("/advance-search/"); ?>" class="um-account-link"><span class="um-account-icontip uimob800-show um-tip-w"><i class="um-faicon-search-plus"></i></span><span class="um-account-icon uimob800-hide"><i class="um-faicon-search-plus"></i></span><span class="um-account-title uimob800-hide">Advance Search</span><span class="um-account-arrow uimob800-hide"><i class="um-faicon-angle-right"></i></span></a></li>');
					jQuery('#sns-adv-search-page').click(function(){
					   window.location.href = "<?php echo site_url("/advance-search/"); ?>";
					});

					jQuery(".um-account-side ul").append('<li id="sns-user-analytics-page"><a href="<?php echo site_url("/user-analytics/"); ?>" class="um-account-link"><span class="um-account-icontip uimob800-show um-tip-w"><i class="um-faicon-calculator"></i></span><span class="um-account-icon uimob800-hide"><i class="um-faicon-calculator"></i></span><span class="um-account-title uimob800-hide">User Analytics</span><span class="um-account-arrow uimob800-hide"><i class="um-faicon-angle-right"></i></span></a></li>');
					jQuery('#sns-user-analytics-page').click(function(){
					   window.location.href = "<?php echo site_url("/user-analytics/"); ?>";
					});

					jQuery(".um-account-side ul").append('<li id="sns-agent-activity-log-page"><a href="<?php echo site_url("/agent-activity-logs/"); ?>" class="um-account-link"><span class="um-account-icontip uimob800-show um-tip-w"><i class="um-faicon-user"></i></span><span class="um-account-icon uimob800-hide"><i class="um-faicon-user"></i></span><span class="um-account-title uimob800-hide">Agent Activity Logs</span><span class="um-account-arrow uimob800-hide"><i class="um-faicon-angle-right"></i></span></a></li>');
					jQuery('#sns-agent-activity-log-page').click(function(){
					   window.location.href = "<?php echo site_url("/agent-activity-logs/"); ?>";
					});

					jQuery(".um-account-side ul").append('<li id="sns-add-new-customer-page"><a href="<?php echo site_url("/customers-data/"); ?>" class="um-account-link"><span class="um-account-icontip uimob800-show um-tip-w"><i class="um-icon-person"></i></span><span class="um-account-icon uimob800-hide"><i class="um-icon-person"></i></span><span class="um-account-title uimob800-hide">Add New Customer</span><span class="um-account-arrow uimob800-hide"><i class="um-faicon-angle-right"></i></span></a></li>');
					jQuery('#sns-add-new-customer-page').click(function(){
					   window.location.href = "<?php echo site_url("/customers-data/"); ?>";
					});
				});
			</script>
			<?php	
			}

			?>
			<style>
				.um-account-profile-link {
					display: none;
				}
				.um-account-name.uimob800-hide {
					padding-bottom: 20px;
				}
			</style>

			<script>
				jQuery(document).ready(function(){
					jQuery('.um-account-meta-img a').removeAttr('href');
					jQuery('.um-account-name a').removeAttr('href');

					var userRole = "<?php echo esc_js(str_replace('_', ' ', $user->roles[0] ?? '')); ?>";
					if(userRole) {
						jQuery('.um-account-name').append('<div class="account-role" style="text-transform: capitalize;">' + userRole + '</div>');
					}
					jQuery('.um-account-name').append('<div class="account-name"><?php echo esc_html($location_name); ?></div>');

					jQuery(".um-account-side ul").append('<li id="sns-logout"><a href="<?php echo site_url("/logout/"); ?>" class="um-account-link real_url"><span class="um-account-icontip uimob800-show um-tip-w"><i class="um-faicon-user"></i></span><span class="um-account-icon uimob800-hide"><i class="um-faicon-sign-out"></i></span><span class="um-account-title uimob800-hide">Logout</span><span class="um-account-arrow uimob800-hide"><i class="um-faicon-angle-right"></i></span></a></li>');
					jQuery('#sns-logout').click(function(){
					   window.location.href = "<?php echo site_url('/logout/'); ?>";
					});
				});
			</script>
			<?php				
		}
    }
}

add_action('um_after_account_page_load', 'show_search_page_links_on_account_page');

// Location Drop Down
function add_location_field_to_user_profile( $user ) {
    global $wpdb;

    $selected_location = get_user_meta( $user->ID, 'user_location', true );

    $locations_table = $wpdb->prefix . 'locations';
    $locations = $wpdb->get_results( "SELECT * FROM $locations_table", OBJECT_K );

    ?>
    <h3><?php _e( 'Location Information', 'textdomain' ); ?></h3>
    <table class="form-table">
        <!-- Location dropdown -->
        <tr>
            <th><label for="user_location"><?php _e( 'Select Location', 'textdomain' ); ?></label></th>
            <td>
                <select name="user_location" id="user_location">
                    <option value=""><?php _e( 'None', 'textdomain' ); ?></option>
                    <?php foreach ( $locations as $location ) : ?>
                        <option value="<?php echo esc_attr( $location->id ); ?>" <?php selected( $selected_location, $location->id ); ?>>
                            <?php echo esc_html( $location->name ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

// Hook the form into the user profile
add_action( 'show_user_profile', 'add_location_field_to_user_profile' );
add_action( 'edit_user_profile', 'add_location_field_to_user_profile' );

//Manager Drop Down
//The action only fires if the current user is editing their own profile. comment below line if don't want that partcular user can edit this in his profile
add_action( 'show_user_profile', 'add_manager_dropdown_to_user_profile' ); 
add_action( 'edit_user_profile', 'add_manager_dropdown_to_user_profile' );

function add_manager_dropdown_to_user_profile( $user ) {
	
    if ( (in_array( 'agent', (array) $user->roles ) || in_array( 'manager', (array) $user->roles )) && current_user_can( 'administrator' )  ) {
		
        // Get all users with the 'manager' or super manager role
        $managers = get_users( array(
			'role__in' => array( 'manager', 'super_manager' )
		) );

		// Get the currently assigned manager ID
        $assigned_manager_id = get_user_meta( $user->ID, 'assigned_manager', true );

        ?>
        <h3><?php _e( 'Assign Manager', 'textdomain' ); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="assigned_manager"><?php _e( 'Select Manager', 'textdomain' ); ?></label></th>
                <td>
                    <select name="assigned_manager" id="assigned_manager">
                        <option value=""><?php _e( 'None', 'textdomain' ); ?></option>
                        <?php foreach ( $managers as $manager ) :  
							$user = get_userdata( $manager->ID ); 
							$user_role = !empty( $user->roles ) ? array_values( $user->roles ) : '';
							$role = !empty( $user_role ) ? ucwords( str_replace( '_', ' ', $user_role[0] ) ) : 'No role';
							?>
                            <option value="<?php echo esc_attr( $manager->ID ); ?>" 
                                <?php selected( $assigned_manager_id, $manager->ID ); ?>>
                                <?php echo esc_html( $manager->display_name . ' (' . $role . ')' ); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
        </table>
        <?php
    }
}

// Hook to save custom user field
add_action( 'personal_options_update', 'save_manager_selection' );
add_action( 'edit_user_profile_update', 'save_manager_selection' );

function save_manager_selection( $user_id ) {
    // Check if the current user has permission to edit user
    if ( !current_user_can( 'edit_users', $user_id ) ) {
        return false;
    }

    // Get selected manager ID
    $selected_manager_id = isset( $_POST['assigned_manager'] ) ? intval( $_POST['assigned_manager'] ) : '';

    // Update the 'assigned_manager' meta field (set to empty if "None" is selected)
    if ( empty( $selected_manager_id ) ) {
        delete_user_meta( $user_id, 'assigned_manager' );
    } else {
        update_user_meta( $user_id, 'assigned_manager', $selected_manager_id );
    }

	$selected_location_id = isset( $_POST['user_location'] ) ? intval( $_POST['user_location'] ) : '';
	// Update the 'user_location' meta field (set to empty if "None" is selected)
    if ( empty( $selected_location_id ) ) {
        delete_user_meta( $user_id, 'user_location' );
    } else {
        update_user_meta( $user_id, 'user_location', $selected_location_id );
    }

    // Update the custom relationship table
    global $wpdb;
    $table_name = $wpdb->prefix . 'agent_manager_relationships';

    // Delete existing relationship for this agent
    $wpdb->delete( $table_name, array( 'agent_id' => $user_id ) );

    // If a manager is selected, insert the new relationship
    if ( !empty( $selected_manager_id ) ) {
        $wpdb->insert( 
            $table_name, 
            array( 
                'agent_id' => $user_id, 
                'manager_id' => $selected_manager_id 
            ) 
        );
    }
}

// Add custom column to user list
add_filter( 'manage_users_columns', 'add_assigned_manager_column' );

function add_assigned_manager_column( $columns ) {
	$columns['assigned_location'] = __( 'Location', 'textdomain' );
    $columns['assigned_manager'] = __( 'Assigned Manager', 'textdomain' );
    return $columns;
}

// Populate custom column with assigned manager's name
add_action( 'manage_users_custom_column', 'show_assigned_manager_column_content', 10, 3 );

function show_assigned_manager_column_content( $output, $column_name, $user_id ) {
	
	// Location Column
	if ( 'assigned_location' === $column_name ) {
		global $wpdb;
        $table_prefix = $wpdb->prefix;

		$user = get_userdata( $user_id );

		$user_location = get_user_meta( $user_id, 'user_location', true );
		
		if ( $user_location ) {
			$location = $wpdb->get_results("SELECT `name` FROM {$table_prefix}locations 
                                            WHERE id = {$user_location}", ARRAY_A);
											
			$result = 	array_column($location, 'name');
			return esc_html( $result[0] );
		} else {
			return __( 'None', 'textdomain' );
		}
    }
	// Assigned Manager Column
    if ( 'assigned_manager' === $column_name ) {

		$user = get_userdata( $user_id );
		$user_roles = $user->roles;

		if ( in_array( 'agent', $user_roles, true ) || in_array( 'manager', $user_roles, true )) {

        	$assigned_manager_id = get_user_meta( $user_id, 'assigned_manager', true );
			
			if ( $assigned_manager_id ) {
				$manager = get_userdata( $assigned_manager_id );
				return esc_html( $manager->display_name );
			} else {
				return __( 'None', 'textdomain' );
			}

		} else if ( in_array( 'csv_manager', $user_roles, true ) ) {
			return __( 'Can\'t Assign', 'textdomain' );
		} else if ( in_array( 'super_manager', $user_roles, true ) ) {
			return __( 'Can\'t Assign', 'textdomain' );
		} else if ( in_array( 'administrator', $user_roles, true ) ) {
			return __( 'Can\'t Assign', 'textdomain' );
		}
    }

    return $output;
}


// Redirect to Account page if user is already loggedIn
add_action( 'template_redirect', 'um_restrict_login_page_logged_in' );
function um_restrict_login_page_logged_in() {
    if ( um_is_core_page('login') && is_user_logged_in() ) {
        wp_redirect( um_get_core_page( 'account' ) );
        exit;
    }
}

// Redirect to Account page if user is already loggedIn
add_action( 'template_redirect', 'um_restrict_register_page_logged_in' );
function um_restrict_register_page_logged_in() {
    if ( um_is_core_page('register') && is_user_logged_in() ) {
        wp_redirect( um_get_core_page( 'account' ) );
        exit;
    }
}

// Rename Plugin Name
function rename_wp_activity_log_plugin() {
    global $menu;
    $original_plugin_name = 'WP Activity Log';
    $new_plugin_name = 'User Activity Log';

    foreach ( $menu as $key => $item ) {
        if ( strpos( $item[0], $original_plugin_name ) !== false ) {
            $menu[$key][0] = $new_plugin_name;
        }
    }
}
add_action( 'admin_menu', 'rename_wp_activity_log_plugin', 999 ); 

// Change Drop Down Menu options Name in admin Dashboard on Users List Page
add_filter( 'um_admin_bulk_user_actions_hook', function( $actions ){
	if($actions['um_approve_membership']) {
		$actions['um_approve_membership'] = array( 'label' => 'Approve' );
	}

	if($actions['um_reject_membership']) {
		$actions['um_reject_membership'] = array( 'label' => 'Reject' );
	}
    return $actions;
});

function get_client_ip() {
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))
	   $ipaddress = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
}

function restrictedPages() {
	if(get_client_ip() != '180.151.44.206' && get_client_ip() != '103.229.27.26' && get_client_ip() != '203.193.167.99' && get_client_ip() != '115.247.107.18' && get_client_ip() != '183.177.127.146' && get_client_ip() != '50.184.119.78' && get_client_ip() != '14.195.111.10' && get_client_ip() != '122.176.23.236' && get_client_ip() != '67.83.5.228'){
	?>
		<script> location.replace("<?php echo site_url();?>"); </script>
	<?php
	}
}
add_shortcode('restrictedpages', 'restrictedPages');

// Handle User Analytics Logs Page Data
function handle_user_analytics_ajax() {
    global $wpdb;

    if (!is_user_logged_in()) {
        wp_send_json_error('User is not logged in');
        exit;
    }

    $current_user = wp_get_current_user();
    $table_prefix = $wpdb->prefix;

    // Fetch DataTables parameters
    $page = isset($_GET['start']) ? intval($_GET['start']) : 0;
    $limit = isset($_GET['length']) ? intval($_GET['length']) : 40;
    $search_value = isset($_GET['search_value']) ? sanitize_text_field(trim($_GET['search_value'])) : '';

    // Calculate offset for pagination
    $offset = max(0, $page);

    $where_clause = "1=1"; // Default condition to prevent SQL errors

    if (in_array('manager', (array) $current_user->roles)) {
        // Get agents assigned to this manager
        $agent_ids = $wpdb->get_col($wpdb->prepare(
            "SELECT agent_id FROM {$table_prefix}agent_manager_relationships WHERE manager_id = %d", 
            $current_user->ID
        ));

        if (!empty($agent_ids)) {
            $agent_ids_str = implode(",", array_map('intval', $agent_ids));
            $where_clause .= " AND s.user_id IN ($agent_ids_str)";
        } else {
            $where_clause .= " AND 1=0"; // No assigned agents, return no data
        }
    } else if (in_array('super_manager', (array) $current_user->roles)) {
        // Fetch the super manager's location
        $current_user_location = get_user_meta($current_user->ID, 'user_location', true);

        // Fetch all users at the same location, excluding administrator and super_admin
        $users = get_users([
            'role__in'   => ['manager', 'agent'], // Only these roles
            'meta_key'   => 'user_location',
            'meta_value' => $current_user_location,
            'fields'     => 'ID', // Get only user IDs
        ]);

        if (!empty($users)) {
            $users_ids_str = implode(",", array_map('intval', $users));
            $where_clause .= " AND s.user_id IN ($users_ids_str)";
        } else {
            $where_clause .= " AND 1=0"; // No users at this location
        }
    } else if (in_array('super_admin', (array) $current_user->roles)) {
        // Super Admin can see all users (except ID=1, which is usually the main admin account)
        $totalUsers = $wpdb->get_results("SELECT ID FROM {$table_prefix}users", ARRAY_A);
        $users_ids = array_column($totalUsers, 'ID');

        if (!empty($users_ids)) {
            $users_ids_str = implode(",", array_map('intval', $users_ids));
            $where_clause .= " AND s.user_id IN ($users_ids_str)";
        } else {
            $where_clause .= " AND 1=0"; // No users found
        }
    } else {
        wp_send_json_error('Unauthorized access');
        exit;
    }

    // Apply search filter only if length > 3
    if (!empty($search_value) && strlen($search_value) > 3) {
        $search_value = esc_sql($search_value);
        $where_clause .= $wpdb->prepare(
            " AND (s.display_name LIKE %s 
                OR s.user_email LIKE %s 
                OR s.search_term LIKE %s 
                OR s.selected_term LIKE %s 
                OR s.search_page LIKE %s 
                OR s.location LIKE %s 
                OR s.date LIKE %s)", 
            "%{$search_value}%", "%{$search_value}%", "%{$search_value}%", "%{$search_value}%", "%{$search_value}%", "%{$search_value}%", "%{$search_value}%"
        );
    }

    // Get total records
    $totalRecordsQuery = "SELECT COUNT(*) FROM {$table_prefix}search_data s WHERE $where_clause";
    $totalRecords = $wpdb->get_var($totalRecordsQuery);

    // Get paginated results
    $query = $wpdb->prepare(
        "SELECT s.display_name, s.user_email, s.search_term, s.selected_term, s.search_page, s.location, s.date
        FROM {$table_prefix}search_data s
        WHERE $where_clause ORDER BY s.id DESC LIMIT %d OFFSET %d", $limit, $offset
    );
    
    $users = $wpdb->get_results($query);

    // Prepare response data for DataTables
    $response = array(
        'draw' => isset($_GET['draw']) ? intval($_GET['draw']) : 1,
        'recordsTotal' => (int) $totalRecords,
        'recordsFiltered' => (int) $totalRecords, 
        'data' => $users
    );

    wp_send_json_success($response);
    exit;
}
add_action('wp_ajax_user_analytics_data', 'handle_user_analytics_ajax');












