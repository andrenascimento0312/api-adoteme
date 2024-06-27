<?php

function custom_dogs_by_gender_endpoint() {
    register_rest_route('dogs/v1', '/gender', array(
        'methods' => 'GET',
        'callback' => 'get_dogs_by_gender',
    ));
}

add_action('rest_api_init', 'custom_dogs_by_gender_endpoint');

function get_dogs_by_gender(WP_REST_Request $request) {
    $genders = $request->get_param('gender');

    if (empty($genders)) {
        return new WP_Error('no_genders', 'No genders provided', array('status' => 400));
    }

    $genders_array = explode(',', $genders);

    $args = array(
        'post_type' => 'dog',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'dogGender',
                'value' => $genders_array,
                'compare' => 'IN',
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
        return new WP_Error('no_posts', 'No posts found with the provided genders', array('status' => 404));
    }

    $response = new WP_REST_Response($data);

    return $response;
}
