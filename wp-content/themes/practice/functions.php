<?php 

require get_theme_file_path('/inc/search-route.php');

function custom_theme_rest(){
  register_rest_field('post','authorName', array(
    'get_callback' => function() { return get_the_author(); }
  )); 
}

add_action('rest_api_init', 'custom_theme_rest');

function pageBanner($args = NULL) {
  
  if (!isset($args['title'])) {
    $args['title'] = get_the_title();
  }

  if (!isset($args['subtitle'])) {
    $args['subtitle'] = get_field('page_banner_subtitle');
  }

  if (!isset($args['photo'])) {
    if (get_field('page_banner_background_image')) {
      $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
    } else {
      $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
    }
  }

  ?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
      <div class="page-banner__intro">
        <p><?php echo $args['subtitle']; ?></p>
      </div>
    </div>  
  </div>
<?php }

function main_files() {
    wp_enqueue_script('main-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);
    wp_enqueue_script('jquery', get_theme_file_uri('js/jquery.min.js'), NULL, '1.0', true);
    wp_enqueue_script('search-js', get_theme_file_uri('/js/search.js'), NULL, '1.0', true);
    wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyDin3iGCdZ7RPomFLyb2yqFERhs55dmfTI', NULL, '1.0', true);
    wp_enqueue_style('custom-google-font', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('main_styles', get_stylesheet_uri());

    wp_localize_script('search-js','mainData', array(
      'root_url' => get_site_url()
    ));

}

add_action('wp_enqueue_scripts', 'main_files');



add_action('after_setup_theme', 'theme_feature');

function theme_feature(){
    //register_nav_menu('headerMenuLocation', 'Header Menu Location');
    //register_nav_menu('FooterLocationOne', 'Footer Location One');
    //register_nav_menu('FooterLocationTwo', 'Footer Location Two');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true );
    //Plugin Name: manual image crop tomasz(For crop), Regenerate Thumbnails
}
add_action('after_setup_theme', 'theme_feature');



function theme_adjust_queries($query){

    if(!is_admin()  AND is_post_type_archive('program') AND $query->is_main_query() ){
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }

    if(!is_admin()  AND is_post_type_archive('event') AND $query->is_main_query() ){
        $today = date('Ymd');
        //$query->set('posts_per_page', '1');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
                array(
                  'key' => 'event_date',
                  'compare' => '>=',
                  'value' => $today,
                  'type' => 'numeric'
                )
                ));
    }
}

add_action('pre_get_posts', 'theme_adjust_queries');


// Method 1: Filter.
function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyBh9b1rNCp6kOi5JeMHiRP4klDymBeoEWk';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


