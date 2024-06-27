<?php

// Register Custom Post Type
function register_dog_post_type()
{

    $labels = array(
        'name'                  => _x('Cachorros', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Cachorro', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Cachorros', 'text_domain'),
        'name_admin_bar'        => __('Cachorro', 'text_domain'),
        'archives'              => __('Arquivo de Cachorros', 'text_domain'),
        'attributes'            => __('Atributos de Cachorro', 'text_domain'),
        'parent_item_colon'     => __('Cachorro Parente:', 'text_domain'),
        'all_items'             => __('Todos os Cachorros', 'text_domain'),
        'add_new_item'          => __('Adicionar Novo Cachorro', 'text_domain'),
        'add_new'               => __('Adicionar Novo', 'text_domain'),
        'new_item'              => __('Novo Cachorro', 'text_domain'),
        'edit_item'             => __('Editar Cachorro', 'text_domain'),
        'update_item'           => __('Atualizar Cachorro', 'text_domain'),
        'view_item'             => __('Ver Cachorro', 'text_domain'),
        'view_items'            => __('Ver Cachorros', 'text_domain'),
        'search_items'          => __('Procurar Cachorro', 'text_domain'),
        'not_found'             => __('Não encontrado', 'text_domain'),
        'not_found_in_trash'    => __('Não encontrado no lixo', 'text_domain'),
        'featured_image'        => __('Imagem em destaque', 'text_domain'),
        'set_featured_image'    => __('Definir imagem em destaque', 'text_domain'),
        'remove_featured_image' => __('Remover imagem em destaque', 'text_domain'),
        'use_featured_image'    => __('Usar como imagem em destaque', 'text_domain'),
        'insert_into_item'      => __('Inserir no Cachorro', 'text_domain'),
        'uploaded_to_this_item' => __('Enviado para este Cachorro', 'text_domain'),
        'items_list'            => __('Lista de Cachorros', 'text_domain'),
        'items_list_navigation' => __('Navegação na lista de Cachorros', 'text_domain'),
        'filter_items_list'     => __('Filtrar lista de Cachorros', 'text_domain'),
    );
    $args = array(
        'label'                 => __('Cachorro', 'text_domain'),
        'description'           => __('Cadastro de cachorro para adoção', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'menu_icon'             => 'dashicons-pets',
        'show_in_menu'          => true,
        'menu_position'         => 4,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'rest_base'             => 'dogs',
        'show_in_graphql'       => 'document',
        'graphql_single_name'   => 'dog',
        'graphql_plural_name'   => 'dogs',
        'publicly_queryable'    => true
    );
    register_post_type('dog', $args);
}
add_action('init', 'register_dog_post_type', 0);


// Register Custom Taxonomy
function register_dog_taxonomy()
{

    $labels = array(
        'name'                       => _x('Característica', 'Taxonomy General Name', 'text_domain'),
        'singular_name'              => _x('Característica', 'Taxonomy Singular Name', 'text_domain'),
        'menu_name'                  => __('Caracteríticas', 'text_domain'),
        'all_items'                  => __('Todas as caracteríticas', 'text_domain'),
        'parent_item'                => __('Parent Item', 'text_domain'),
        'parent_item_colon'          => __('Parent Item:', 'text_domain'),
        'new_item_name'              => __('Nova característica', 'text_domain'),
        'add_new_item'               => __('Adicionar nova característica', 'text_domain'),
        'edit_item'                  => __('Editar Característica', 'text_domain'),
        'update_item'                => __('Editar Catacterística', 'text_domain'),
        'view_item'                  => __('Ver', 'text_domain'),
        'separate_items_with_commas' => __('Separar as características por vírgula', 'text_domain'),
        'add_or_remove_items'        => __('Adicionar ou remover', 'text_domain'),
        'choose_from_most_used'      => __('Escolha os mais usados', 'text_domain'),
        'popular_items'              => __('Popular Items', 'text_domain'),
        'search_items'               => __('Procurar caracteristicas', 'text_domain'),
        'not_found'                  => __('Não encontrado...', 'text_domain'),
        'no_terms'                   => __('Sem caracteristicas', 'text_domain'),
        'items_list'                 => __('Lista de características', 'text_domain'),
        'items_list_navigation'      => __('Items list navigation', 'text_domain'),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => false,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
        'rest_base'                  => 'characteristics',
        'rest_controller_class'      => 'characteristics',
        'show_in_graphql'            => 'document',
        'graphql_single_name'        => 'characteristic',
        'graphql_plural_name'        => 'characteristics',
        'publicly_queryable'         => true
    );
    register_taxonomy('characteristics', array('dog'), $args);
}
add_action('init', 'register_dog_taxonomy', 0);

