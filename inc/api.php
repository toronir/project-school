<?php

add_action('rest_api_init', function () {
    register_rest_route('work-on', '/contact', [
        'methods' => 'POST',
        'callback' => function ($request) {
            $output = '';
            $email = $request['email'] ? $request['email'] : '';
            $phone = $request['phone'] ? $request['phone'] : '';
            $firstName = $request['firstName'] ? $request['firstName'] : '';
            $secondName = $request['secondName'] ? $request['secondName'] : '';
            $birthday = $request['birthday'] ? $request['birthday'] : '';
            $massage = $request['massage'] ? $request['massage'] : '';



            $pass = randomPassword();


            $to = 'toronir5@gmail.com';
            $subject = 'Hey! Masz nowego kandydata';
            $body = `<html>
            <body>
   <h1 style='color: #c29f48; background-color: #212529;margin:0px; text-align: center;'>
     Masz nowego użytkownika
   </h1>
                <div style='background-color: #212529;padding:1rem;padding-left: 10rem;'>
                    <table>
                        
                    
                       <tr>
                            <td style='color: #c29f48;'>Imię:</td>
                            <td style='color: #c29f48;'>$firstName<br></td>
                        </tr>
                       <tr>
                            <td style='color: #c29f48;'>Nazwisko:</td>
                            <td style='color: #c29f48;'>$secondName<br></td>
                        </tr>
                       
                        <tr>
                            <td style='color: #c29f48;'>Data urodzenia:</td>
                            <td style='color: #c29f48;'>$birthday</td>
                        </tr>
                        <tr>
                            <td style='color: #c29f48;'>Telefon:</td>
                            <td style='color: #c29f48;'>$phone</td>
                        </tr>
                        <tr>
                            <td style='color: #c29f48;'>Wiadomość:</td>
                            <td style='color: #c29f48;'>$massage</td>
                        </tr>

                       <tr>
                            <td style='color: #c29f48;'>Poczta kandydata:</td>
                            <td style='color: #c29f48;'>$email<br></td>
                        </tr>
                    </table>
                </div>
            </body>
        </html>`;


            $userList = get_users('blog_id=0&orderby=nicename');
            foreach ($userList as $user) {
                if ($user->user_email == $email) {
                    $output = 'user_exists';;
                }
            }

            if ($email && !get_page_by_title($email, OBJECT, 'subscription') && !$output) {


                $newPost = wp_insert_post([
                    'post_title' => $email,
                    'post_status' => 'draft',
                    'post_type' => 'subscription',
                    'meta_input' => array(
                        'subscription_first_name' => $firstName,
                        'subscription_second_name' => $secondName,
                        'subscription_user_password' => $pass,
                        'subscription_telephone' => $phone,
                        'subscription_user_birthday' => $birthday,
                        'subscription_discription' => $massage,
                    )
                ]);

                $output = 'success';
                add_filter('wp_mail_content_type', 'set_html_content_type');

                wp_mail($to, $subject, $body);
                remove_filter('wp_mail_content_type', 'set_html_content_type');
            } else {

                $output = !$output ? "error" : $output;
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