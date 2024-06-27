<?php

function custom_dogs_by_slug_endpoint() {
    register_rest_route('dogs/v1', '/doguinho/(?P<slug>[a-zA-Z0-9-]+)', array(
        'methods' => 'GET',
        'callback' => 'get_dogs_by_slug',
    ));
}

add_action('rest_api_init', 'custom_dogs_by_slug_endpoint');

function get_dogs_by_slug(WP_REST_Request $request) {
    $slug = $request->get_param('slug');

    if (empty($slug)) {
        return new WP_Error('no_slug', 'No slug provided', array('status' => 400));
    }

    $args = array(
        'name' => $slug,
        'post_type' => 'dog',
        'posts_per_page' => 1,
        'post_status' => 'publish'
    );

    $query = new WP_Query($args);
    $data = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $data = [
                'dogID' => get_the_ID(),
                'dogName' => get_the_title(),
                'dogAge' => (int)get_post_meta(get_the_ID(), 'dogAge', true),
                'dogSize' => get_post_meta(get_the_ID(), 'dogSize', true),
                'dogGender' => get_post_meta(get_the_ID(), 'dogGender', true),
                'dogMainPhoto' => wp_get_attachment_url(get_post_meta(get_the_ID(), 'dogMainPhoto', true)),
                'characteristics' => wp_get_post_terms(get_the_ID(), 'characteristics', array('fields' => 'names')),
                'description' => get_the_content()
            ];
        }
        wp_reset_postdata();
    } else {
        return new WP_Error('no_post', 'No post found with that slug', array('status' => 404));
    }

    $response = new WP_REST_Response($data);

    return $response;
}
