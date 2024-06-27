<?php


function my_acf_json_save_point($path)
{
   $path = get_stylesheet_directory() . '/acf-json';

   return $path;
}

add_filter('acf/settings/save_json', 'my_acf_json_save_point');

// Função para definir o caminho de carregamento dos arquivos JSON do ACF
function my_acf_json_load_point($paths)
{
   // Remove o caminho padrão (opcional)
   unset($paths[0]);
   $paths[] = get_stylesheet_directory() . '/acf-json';

   return $paths;
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');


// autoload de cpt e api
require_once get_template_directory() . '/autoload.php';
require_once get_template_directory() . '/views/loadViews.php';
