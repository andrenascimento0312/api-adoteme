<?php

function custom_dogs_by_taxonomy_endpoint() {
    register_rest_route('dogs/v1', '/taxonomy', array(
        'methods' => 'GET',
        'callback' => 'get_dogs_by_taxonomies',
    ));
}

add_action('rest_api_init', 'custom_dogs_by_taxonomy_endpoint');

function get_dogs_by_taxonomies(WP_REST_Request $request) {
    $slugs = $request->get_param('slugs');

    if (empty($slugs)) {
        return new WP_Error('no_slugs', 'No slugs provided', array('status' => 400));
    }

    $slugs_array = explode(',', $slugs);

    $args = array(
        'post_type' => 'dog',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'characteristics',
                'field' => 'slug',
                'terms' => $slugs_array,
            ),
        ),
    );

    $query = new WP_Query($args);
    $data = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $data[] = [
                'dogID' => get_the_ID(),
                'dogName' => get_the_title(),
                'dogAge' => (int)get_post_meta(get_the_ID(), 'dogAge', true),
                'dogSize' => get_post_meta(get_the_ID(), 'dogSize', true),
                'dogGender' => get_post_meta(get_the_ID(), 'dogGender', true),
                'dogMainPhoto' => wp_get_attachment_url(get_post_meta(get_the_ID(), 'dogMainPhoto', true)),
                'characteristics' => wp_get_post_terms(get_the_ID(), 'characteristics', array('fields' => 'names'))
            ];
        }
        wp_reset_postdata();
    }

    $response = new WP_REST_Response($data);

    return $response;
}
