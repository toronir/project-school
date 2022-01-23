<?php
$logo = get_theme_mod('logo');
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
            $body = `<html >
            <head>
            <title>HTML CSS JS</title>
              <link href="https://fonts.googleapis.com/css2?family=Saira+Semi+Condensed:wght@200;400;600&display=swap"
                    rel="stylesheet">
            </head>
              
               <style type="text/css">
               
                 table{
                       border-spacing: 0px;
                 }
                  
                  h2 {
                    font-size: 56px;
                    font-family: 'Saira Semi Condensed', sans-serif;
                  }
                  
                    h3{
                    font-size: 28px;
                    font-weight: 900; 
                        font-family: 'Saira Semi Condensed', sans-serif;
                  }
                  
                  p {
                      font-family: 'Saira Semi Condensed', sans-serif;
                    font-weight: 100;
                  }
                  
                  td {
                vertical-align: top;
                  }
                  
                  #email {
                    margin: auto;
                    width: 600px;
                    background-color: white;
                  }
                  
                  a{
                   
                    text-decoration: none;
                    font: inherit;
                    background-color: #c29f48;
                    border: none;
                    padding: 10px;
                    text-transform: uppercase;
                    letter-spacing: 2px;
                    font-weight: 900; 
                    color: white;
                    border-radius: 5px; 
                    box-shadow: 3px 3px #808080;
                  }
                  
                  .subtle-link {
                    font-size: 9px; 
                    text-transform:uppercase; 
                    letter-spacing: 1px;
                    color: #CBD6E2;
                  }
                  
                </style>
             <body >
               
               <div id="email">
            
              
              
              <! Banner --> 
                     <table  width="100%" style=" border-bottom: solid #c29f48;  ;
            
             
              ">
                        <tr>
                     
                          <td bgcolor="#212529" align="center" style="color: white;">
                        
                         <img alt="Flower" src="$logo" width="400px" align="middle">
                            
                            <h2 style='color: #c29f48;'>  Nowy użytkownik czeka na akceptację </h2>
                            
                          </td>
                    </table>
               
               
            <table bgcolor="#212529" role="presentation" border="0" cellpadding="0" cellspacing="10px" style="padding: 30px 30px 30px 60px;color: #c29f48;">
                 <tr>
                   <td>
                    <h3 align="center"> Nowy kandydat $firstName $secondName wysyła swoją prośbę!</h3>
                        <p align="center" style="margin-bottom: 2rem">
                          Aby dowiedzieć się więcej o nowym kandydacie przejdź do panelu administracyjnego strony CatArmy lub kliknij w poniższy przycisk  
                        </p>
               <div style="display:flex;justify-content:center;">
                            <a style="font-family: 'Saira Semi Condensed', sans-serif;" href="http://front3.work-on.pl/wp-admin/">Wyświetl nowego użytkownika</a>
                     </div>
                           
                            
                      </td> 
                      </tr>
                             </table>
                 <table role="presentation" style="background-color: #c29f48" width="100%" >
                  <tr>
                      <td align="left" style="padding: 30px 30px;">
                        <p style="color:#212529"> Z miłością &hearts; od CatTeam </p>
                          <a  class="subtle-link" style="font-family: 'Saira Semi Condensed', sans-serif; background-color:#212529;" href="http://front3.work-on.pl/"> Do strony </a>      
                      </td>
                      </tr>
                  </table> 
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