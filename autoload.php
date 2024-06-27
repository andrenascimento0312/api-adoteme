<?php

function theme_autoload($dir)
{
    if (!is_dir($dir)) {
        return;
    }

    $files = scandir($dir);

    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        $path = $dir . '/' . $file;

        if (is_dir($path)) {
            theme_autoload($path);
            continue;
        }

        if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
            // error_log("Carregando arquivo: " . $path);  // Adicione esta linha
            require_once $path;
        }
    }
}

theme_autoload(get_template_directory() . '/cpt');
theme_autoload(get_template_directory() . '/api');
