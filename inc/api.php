<?php

add_action('rest_api_init', function () {
    register_rest_route('workon', '/newsletter', [
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
