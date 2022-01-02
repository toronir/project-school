<?php

add_action('rest_api_init', function () {
    register_rest_route('workon', '/contact-us', [
        'methods' => 'POST',
        'callback' => function ($request) {
            $output = '';
            $email = $request['email'] ? $request['email'] : '';
            if ($email && !get_page_by_title($email,OBJECT,'subscription')) {
                wp_insert_post([
                    'post_title' => $email,
                    'post_status' => 'publish',
                    'post_type' => 'subscription',

                ]);
                $output='success';
            } else {
                $output = 'error';
            }

            return $output;
        },

    ]);
});
add_action('rest_api_init', function () {
    register_rest_route( 'api/v1', '/cities', array(
        'methods' => 'POST',
        'callback' => 'create_city_from_data'
    ));
});
function create_city_from_data($req) {
    $response['name'] = $req['name'];
    $response['population'] = $req['population'];

    $res = new WP_REST_Response($response);
    $res->set_status(200);

    return ['req' => $res];
}