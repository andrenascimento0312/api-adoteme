<?php

function custom_dogs_by_age_endpoint() {
    register_rest_route('dogs/v1', '/age', array(
        'methods' => 'GET',
        'callback' => 'get_dogs_by_age',
    ));
}

add_action('rest_api_init', 'custom_dogs_by_age_endpoint');

function get_dogs_by_age(WP_REST_Request $request) {
    $age_param = $request->get_param('age');

    if (empty($age_param)) {
        return new WP_Error('no_age_range', 'No age range provided', array('status' => 400));
    }

    $ages = explode(',', $age_param);

    if (count($ages) != 2 || !is_numeric($ages[0]) || !is_numeric($ages[1])) {
        return new WP_Error('invalid_age_format', 'Invalid age format. Use min,max format with numeric values.', array('status' => 400));
    }

    $min_age = intval($ages[0]);
    $max_age = intval($ages[1]);

    // Adjust min and max for inclusive filtering
    $min_age_filter = max(1, $min_age);
    $max_age_filter = $max_age;

    $args = array(
        'post_type' => 'dog',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'dogAge',
                'value' => array($min_age_filter, $max_age_filter),
                'type' => 'numeric',
                'compare' => 'BETWEEN',
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
    } else {
        return new WP_Error('no_posts', 'No posts found within the provided age range', array('status' => 404));
    }

    $response = new WP_REST_Response($data);

    return $response;
}
