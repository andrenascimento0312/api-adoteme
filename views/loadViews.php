<?php
// Função para registrar templates personalizados
function register_custom_templates($templates)
{
    $template_dir = get_template_directory() . '/views/templates';
    $files = scandir($template_dir);

    foreach ($files as $file) {
        $path = $template_dir . '/' . $file;

        if (is_file($path) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
            $template_name = get_template_name($path);
            if ($template_name) {
                $templates['views/templates/' . $file] = $template_name;
            }
        }
    }

    return $templates;
}

// Função para obter o nome do template a partir do arquivo PHP
function get_template_name($file_path)
{
    $file_content = file_get_contents($file_path);
    if (preg_match('/Template Name:(.*)$/mi', $file_content, $matches)) {
        return trim($matches[1]);
    }
    return false;
}

// Adiciona o filtro para registrar os templates personalizados
add_filter('theme_page_templates', 'register_custom_templates');

//gambiarra para retirar opção indesejada na listagem de modelos
function custom_admin_css() {
    ?>
    <style type="text/css">
        /* Esconde a opção indesejada no seletor de modelos de página */
        select#inspector-select-control-1 option[value="views/loadViews.php"] {
            display: none;
        }
    </style>
    <?php
 }
 add_action('admin_head', 'custom_admin_css');
