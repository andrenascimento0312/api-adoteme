<?php

// get doguinho by slug
// get doguinho by taxonomy
// get all doguinho
// retornar:
// nome, instituição, cidade, estado, porte, idade, caracteristicas(taxonomia), foto, galeria

//https://api-adoteme.andrednascimento.com.br/dogs/v1/all?page=1

function custom_dogs_endpoint()
{
    register_rest_route('dogs/v1', '/all', array(
        'methods' => 'GET',
        'callback' => 'get_dogs_titles',
    ));
}

add_action('rest_api_init', 'custom_dogs_endpoint');

function get_dogs_data($query)
{
    $dogs_data = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $dogs_data[] = [
                'dogName' => get_the_title(),
                'dogSlug' => get_post_field('post_name', get_the_ID()), 
                'dogAge' => (int) get_post_meta(get_the_ID(), 'dogAge', true),
                'dogSize' => get_post_meta(get_the_ID(), 'dogSize', true),
                'dogGender' => get_post_meta(get_the_ID(), 'dogGender', true),
                'dogMainPhoto' => wp_get_attachment_url(get_post_meta(get_the_ID(), 'dogMainPhoto', true)),
                'dogGallery' => get_post_meta(get_the_ID(), 'dogGallery', true)
            ];
        }
        wp_reset_postdata();
    }

    return $dogs_data;
}


// Função callback do endpoint
function get_dogs_titles(WP_REST_Request $request)
{
    $paged = $request->get_param('page') ? (int) $request->get_param('page') : 1;
    $age_param = $request->get_param('age');
    $size_param = $request->get_param('size');
    $gender_param = $request->get_param('gender');
    $taxonomy_param = $request->get_param('taxonomy');    

    $posts_per_page = 6;

    $args = array(
        'post_type' => 'dog',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
    );

    // Adicionando filtros de meta_query
    $meta_query = array('relation' => 'AND');

    
    if ($age_param) {
        $age_values = explode(',', $age_param);
        $min_age = intval($age_values[0]);
        $max_age = intval($age_values[1]);
    
        // Construindo a meta_query para o filtro de idade
        $meta_query[] = array(
            'key' => 'dogAge',
            'value' => array($min_age, $max_age),
            'type' => 'numeric',
            'compare' => 'BETWEEN',
        );
    }
    

    
    if ($size_param) {
        $sizes = explode(',', $size_param);
        $meta_query[] = array(
            'key' => 'dogSize',
            'value' => $sizes,
            'compare' => 'IN',
        );
    }

    
    if ($gender_param) {
        $genders = explode(',', $gender_param);
        $meta_query[] = array(
            'key' => 'dogGender',
            'value' => $genders,
            'compare' => 'IN',
        );
    }

    $tax_query = array('relation' => 'AND');
    
    if ($taxonomy_param) {
        $taxonomy_values = explode(',', $taxonomy_param);

        $tax_query[] = array(
            'taxonomy' => 'characteristics',
            'field' => 'slug',
            'terms' => $taxonomy_values,
            'operator' => 'IN',
        );
    }

    if (!empty($meta_query)) {
        $args['meta_query'] = $meta_query;
    }


    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    $query = new WP_Query($args);

    $total_posts = $query->found_posts;
    $total_pages = ceil($total_posts / $posts_per_page);
    $current_page = max(1, $paged);

    $data = array(
        'currentPage' => $current_page,
        'totalPosts' => $total_posts,
        'totalPages' => $total_pages,
    );

    $dogs_data = get_dogs_data($query);
    $response_data = array_merge($data, $dogs_data);

    $response = new WP_REST_Response($response_data);

    return $response;
}
