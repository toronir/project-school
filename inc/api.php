<?php

add_action('rest_api_init', function () {
    register_rest_route('work-on', '/contact', [
        'methods' => 'POST',
        'callback' => function ($request) {
            $output = '';
            $email = $request['email'] ? $request['email'] : '';
            $phone = $request['phone'] ? $request['phone'] : '';
            $name = $request['name'] ? $request['name'] : '';
            $birthday = $request['birthday'] ? $request['birthday'] : '';
            $pass = randomPassword();


            $to = 'toronir5@gmail.com';
            $subject = 'New User';
            $body = 'You got new user';
            $headers[] = 'Content-type: text/plain; charset=utf-8';
            $headers[] = 'From:' . "testing@gmail.com";

            if ($email && !get_page_by_title($email, OBJECT, 'subscription')) {

                wp_insert_post([
                    'post_title' => $email,
                    'post_status' => 'draft',
                    'post_type' => 'subscription',
                    'meta_input' => array(
                        'subscription_first_name' => $name,
                        'subscription_user_password' => $pass,
                        'subscription_telephone' => $phone,
                        'subscription_user_birthday' => $birthday,
                    )





                ]);
                $output = 'success';
                wp_mail($to, $subject, $body, $headers);
                
                
            } else {
                $output = 'error';
            }

            return $output;
        },

    ]);
});
// add_action('rest_api_init', function () {
//     register_rest_route( 'api/v1', '/cities', array(
//         'methods' => 'POST',
//         'callback' => 'create_city_from_data'
//     ));
// });
// function create_city_from_data($req) {
//     $response['name'] = $req['name'];
//     $response['population'] = $req['population'];

//     $res = new WP_REST_Response($response);
//     $res->set_status(200);

//     return ['req' => $res];
// }