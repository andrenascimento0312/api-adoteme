<?php

// get doguinho by slug
// get doguinho by taxonomy
// get all doguinho
// retornar:
// nome, instituição, cidade, estado, porte, idade, caracteristicas(taxonomia), foto, galeria

//https://api-adoteme.andrednascimento.com.br/dogs/v1/all?page=1

function custom_dogs_taxonomies_endpoint() {
    register_rest_route('dogs-characteristics/v1', '/all', array(
        'methods' => 'GET',
        'callback' => 'get_dogs_taxonomies',
    ));
}

add_action('rest_api_init', 'custom_dogs_taxonomies_endpoint');

function get_dogs_taxonomies(WP_REST_Request $request) {
   
    $terms = get_terms(array(
        'taxonomy' => 'characteristics',
        'hide_empty' => false,
    ));

    $data = array();

    if (!is_wp_error($terms)) {
        foreach ($terms as $term) {
            $data[] = [
                'taxonomyID' => $term->term_id,
                'name' => $term->name,
                'slug' => $term->slug
            ];
        }
    }

    $response = new WP_REST_Response($data);

    return $response;
}
