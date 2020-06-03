<?php 

function mediumerge_files() {
	wp_enqueue_script('javascript', get_theme_file_uri('/assets/js/bootstrap.min.js'), NULL, '1.0', true);
	wp_enqueue_script('javascript', get_theme_file_uri('/assets/js/ie10-viewport-bug-workaround.js'), NULL, '1.0', true);
	wp_enqueue_script('javascript', get_theme_file_uri('/assets/js/jquery.min.js'), NULL, '1.0', true);
	wp_enqueue_script('javascript', get_theme_file_uri('/assets/js/mediumish.js'), NULL, '1.0', true);
	wp_enqueue_style('custom-google-font', '//fonts.googleapis.com/css?family=Righteous');
	wp_enqueue_style('font-awesome', get_theme_file_uri('/assets/css/font-awesome.min.css'));
	wp_enqueue_style('bootstrap-min-css', get_theme_file_uri('/assets/css/bootstrap.min.css'));
	wp_enqueue_style('institute_main_styles', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'mediumerge_files');

function mediumerge_features(){
	
	add_theme_support('title-tag');

}
# custom excerpt length of 32 words
function custom_excerpt_length( $length ) {
	return 32;
}

 // register the nav
 function register_my_menu() {
  register_nav_menu('topnav', 'Main menu');
 }
 add_action( 'init', 'register_my_menu' );

// let's add "*active*" as a class to the li

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
     if( in_array('current-menu-item', $classes) ){
             $classes[] = 'active ';
     }
     return $classes;
}

// let's add our custom class to the actual link tag    

function atg_menu_classes($classes, $item, $args) {
  if($args->theme_location == 'topnav') {
    $classes[] = 'nav-link';
  }
  return $classes;
}
add_filter('nav_menu_css_class', 'atg_menu_classes', 1, 3);

function add_menuclass($ulclass) {
   return preg_replace('/<a /', '<a class="nav-link"', $ulclass);
}
add_filter('wp_nav_menu','add_menuclass');

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

add_action('after_setup_theme', 'mediumerge_features');

// Add theme support for Featured Images
add_theme_support('post-thumbnails', array(
'post',
'page',
'custom-post-type-name',
));


function register_post_assets(){
    add_meta_box('featured-post', __('Featured Post'), 'add_featured_meta_box', 'post', 'advanced', 'high');
}
add_action('admin_init', 'register_post_assets', 1);

function add_featured_meta_box($post){
    $featured = get_post_meta($post->ID, '_featured-post', true);
    echo "<label for='_featured-post'>".__('Feature this post?', 'mediumerge')."</label>";
    echo "<input type='checkbox' name='_featured-post' id='featured-post' value='1' ".checked(1, $featured)." />";
}

function save_featured_meta($post_id){
    // Do validation here for post_type, nonces, autosave, etc...
    if (isset($_REQUEST['_featured-post']))
        update_post_meta(esc_attr($post_id, '_featured-post', esc_attr($_REQUEST['_featured-post']))); 
        // I like using _ before my custom fields, so they are only editable within my form rather than the normal custom fields UI
}
add_action('save_post', 'save_featured_meta');

function theme_prefix_setup() {
	
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-width' => true,
	) );

}
add_action( 'after_setup_theme', 'theme_prefix_setup' );

//Reading Time Calculator
function reading_time() {
    $content = get_post_field( 'post_content', $post->ID );
    $word_count = str_word_count( strip_tags( $content ) );
    $readingtime = ceil($word_count / 200);

    if ($readingtime == 1) {
      $timer = " minute";
    } else {
      $timer = " minutes";
    }
    $totalreadingtime = $readingtime . $timer;

    return $totalreadingtime;
}

//Featured Post
function sm_custom_meta() {
    add_meta_box( 'sm_meta', __( 'Featured Posts', 'mediumerge' ), 'sm_meta_callback', 'post' );
}
function sm_meta_callback( $post ) {
    $featured = get_post_meta( $post->ID );
    ?>
 
  <p>
    <div class="sm-row-content">
        <label for="meta-checkbox">
            <input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $featured['meta-checkbox'] ) ) checked( $featured['meta-checkbox'][0], 'yes' ); ?> />
            <?php _e( 'Featured this post', 'mediumerge' )?>
        </label>
        
    </div>
</p>
 
    <?php
}
add_action( 'add_meta_boxes', 'sm_custom_meta' );


function sm_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
 // Checks for input and saves
if( isset( $_POST[ 'meta-checkbox' ] ) ) {
    update_post_meta( $post_id, 'meta-checkbox', 'yes' );
} else {
    update_post_meta( $post_id, 'meta-checkbox', '' );
}
 
}
add_action( 'save_post', 'sm_meta_save' );

//related posts
function wcr_related_posts($args = array()) {
    global $post;

    // default args
    $args = wp_parse_args($args, array(
        'post_id' => !empty($post) ? $post->ID : '',
        'taxonomy' => 'category',
        'limit' => 3,
        'post_type' => !empty($post) ? $post->post_type : 'post',
        'orderby' => 'date',
        'order' => 'DESC'
    ));

    // check taxonomy
    if (!taxonomy_exists($args['taxonomy'])) {
        return;
    }

    // post taxonomies
    $taxonomies = wp_get_post_terms($args['post_id'], $args['taxonomy'], array('fields' => 'ids'));

    if (empty($taxonomies)) {
        return;
    }

    // query
    $related_posts = get_posts(array(
        'post__not_in' => (array) $args['post_id'],
        'post_type' => $args['post_type'],
        'tax_query' => array(
            array(
                'taxonomy' => $args['taxonomy'],
                'field' => 'term_id',
                'terms' => $taxonomies
            ),
        ),
        'posts_per_page' => $args['limit'],
        'orderby' => $args['orderby'],
        'order' => $args['order']
    ));

    include( locate_template('related-posts-template.php', false, false) );

    wp_reset_postdata();
}

if ( ! isset( $content_width ) ) {
    $content_width = 600;
}
if ( is_singular() ) wp_enqueue_script( "comment-reply" )

 ?>