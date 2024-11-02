<?php add_action('init', 'c7_init');
function c7_init() {
  register_nav_menus([
    'principal' => __('Principal Menu', 'ng-conf')
  ]);
}

add_action('wp_footer', 'add_noscript_data');
function add_noscript_data() {
  $menu_items = wp_get_nav_menu_items(40);
  $menu_principal = [];
  if ($menu_items) {
    foreach ($menu_items as $item) {
      $menu_principal[] = [
        'title' => $item->title,
        'url' => $item->url
      ];
    }
  }
  $general = [
    'titulo' => get_bloginfo('name'),
    'url' => get_bloginfo('url'),
  ];
  if (is_single()) {
    $data = [
      'tipo' => 'single',
      'general' => $general,
      'menu' => $menu_principal,
      'articulo' => [
        'id' => get_the_ID(),
        'titulo' => get_the_title(),
        'resumen' => get_the_excerpt(),
        'contenido' => apply_filters('the_content', get_the_content()),
        'link' => get_the_permalink()
      ]
    ];
  } else {
    global $wp_query;
    $articulos = [];
    while(have_posts()) { the_post();
      array_push($articulos, [
        'id' => get_the_ID(),
        'titulo' => get_the_title(),
        'resumen' => get_the_excerpt(),
        'url' => get_the_permalink()
      ]);
    }
    $data = [
      'tipo' => 'home',
      'general' => $general,
      'menu' => $menu_principal,
      'articulos' => $articulos,
      'paginado' => [
        'total' => $wp_query->max_num_pages,
        'current' => $wp_query->query_vars['paged'] ? $wp_query->query_vars['paged'] : 1
      ]
    ];
  }
  echo '<noscript id="app-data">' . json_encode($data) . '</noscript>';
}