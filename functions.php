<?php add_action('wp_footer', 'add_noscript_data');
function add_noscript_data() {
  if (is_single()) {
    $data = [
      'tipo' => 'single',
      'general' => [
        'titulo' => get_bloginfo('name'),
        'url' => get_bloginfo('url'),
      ],
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
      'general' => [
        'titulo' => get_bloginfo('name'),
        'url' => get_bloginfo('url'),
      ],
      'articulos' => $articulos,
      'paginado' => [
        'total' => $wp_query->max_num_pages,
        'current' => $wp_query->query_vars['paged'] ? $wp_query->query_vars['paged'] : 1
      ]
    ];
  }
  echo '<noscript id="app-data">' . json_encode($data) . '</noscript>';
}