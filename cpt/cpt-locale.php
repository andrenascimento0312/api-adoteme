<?php

// Register Custom Post Type
function register_city_post_type()
{

    $labels = array(
        'name'                  => _x('Cidades', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Cidade', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Cidades', 'text_domain'),
        'name_admin_bar'        => __('Cidade', 'text_domain'),
        'archives'              => __('Arquivo de Cidades', 'text_domain'),
        'attributes'            => __('Atributos de Cidade', 'text_domain'),
        'parent_item_colon'     => __('Cidade Parente:', 'text_domain'),
        'all_items'             => __('Todos os Cidades', 'text_domain'),
        'add_new_item'          => __('Adicionar Novo Cidade', 'text_domain'),
        'add_new'               => __('Adicionar Novo', 'text_domain'),
        'new_item'              => __('Novo Cidade', 'text_domain'),
        'edit_item'             => __('Editar Cidade', 'text_domain'),
        'update_item'           => __('Atualizar Cidade', 'text_domain'),
        'view_item'             => __('Ver Cidade', 'text_domain'),
        'view_items'            => __('Ver Cidades', 'text_domain'),
        'search_items'          => __('Procurar Cidade', 'text_domain'),
        'not_found'             => __('Não encontrado', 'text_domain'),
        'not_found_in_trash'    => __('Não encontrado no lixo', 'text_domain'),
        'featured_image'        => __('Imagem em destaque', 'text_domain'),
        'set_featured_image'    => __('Definir imagem em destaque', 'text_domain'),
        'remove_featured_image' => __('Remover imagem em destaque', 'text_domain'),
        'use_featured_image'    => __('Usar como imagem em destaque', 'text_domain'),
        'insert_into_item'      => __('Inserir em Cidade', 'text_domain'),
        'uploaded_to_this_item' => __('Enviado para este Cidade', 'text_domain'),
        'items_list'            => __('Lista de Cidades', 'text_domain'),
        'items_list_navigation' => __('Navegação na lista de Cidades', 'text_domain'),
        'filter_items_list'     => __('Filtrar lista de Cidades', 'text_domain'),
    );
    $args = array(
        'label'                 => __('Cidade', 'text_domain'),
        'description'           => __('Cadastro de Cidade para adoção', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array('title'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'menu_icon'             => 'dashicons-location-alt',
        'show_in_menu'          => true,
        'menu_position'         => 6,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'rest_base'             => 'cities',
        'show_in_graphql'       => 'document',
        'graphql_single_name'   => 'cities',
        'graphql_plural_name'   => 'cities',
        'publicly_queryable'    => true
    );
    register_post_type('city', $args);
}
add_action('init', 'register_city_post_type', 0);


// Register Custom Taxonomy
function register_state_taxonomy()
{

    $labels = array(
        'name'                       => _x('Estados', 'Taxonomy General Name', 'text_domain'),
        'singular_name'              => _x('Estados', 'Taxonomy Singular Name', 'text_domain'),
        'menu_name'                  => __('Estados', 'text_domain'),
        'all_items'                  => __('Todas as Estados', 'text_domain'),
        'parent_item'                => __('Parent Item', 'text_domain'),
        'parent_item_colon'          => __('Parent Item:', 'text_domain'),
        'new_item_name'              => __('Nova Estados', 'text_domain'),
        'add_new_item'               => __('Adicionar nova Estados', 'text_domain'),
        'edit_item'                  => __('Editar Estados', 'text_domain'),
        'update_item'                => __('Editar Catacterística', 'text_domain'),
        'view_item'                  => __('Ver', 'text_domain'),
        'separate_items_with_commas' => __('Separar as Estadoss por vírgula', 'text_domain'),
        'add_or_remove_items'        => __('Adicionar ou remover', 'text_domain'),
        'choose_from_most_used'      => __('Escolha os mais usados', 'text_domain'),
        'popular_items'              => __('Popular Items', 'text_domain'),
        'search_items'               => __('Procurar caracteristicas', 'text_domain'),
        'not_found'                  => __('Não encontrado...', 'text_domain'),
        'no_terms'                   => __('Sem caracteristicas', 'text_domain'),
        'items_list'                 => __('Lista de Estados', 'text_domain'),
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
        'rest_base'                  => 'state',
        'rest_controller_class'      => 'state',
        'show_in_graphql'            => 'document',
        'graphql_single_name'        => 'state',
        'graphql_plural_name'        => 'states',
        'publicly_queryable'         => true
    );
    register_taxonomy('state', array('city'), $args);
}
add_action('init', 'register_state_taxonomy', 0);
