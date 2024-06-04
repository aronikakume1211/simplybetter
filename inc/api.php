<?php
class Mebrik_Api
{
    public function __construct()
    {
        add_action('rest_api_init', [$this, 'user_registration_api']);
        add_action('rest_api_init', [$this, 'login_api']);
    }

    public function user_registration_api()
    {
        /**
         * Handle Register User request
         */
        register_rest_route('v1/register', 'user', array(
            'methods'    => 'POST',
            'callback' => [$this, 'wc_rest_user_endpoint_handler'],
            'permission_callback' => '__return_true',
        ));
    }

    public function wc_rest_user_endpoint_handler($request = null)
    {
        // Your user registration logic here
        $response = array();
        $parameters = $request->get_params();

        $username = sanitize_text_field($parameters['username']);
        $email = sanitize_text_field($parameters['username']);
        $password = $parameters['password'];

        $error = new WP_Error();

        // Perform validation, user creation, etc.
        
        $user_id = username_exists($username);

        if (!$user_id && email_exists($email) == false) {
            $user_id = wp_create_user($username, $password, $email);
            if (!is_wp_error($user_id)) {
                // Ger User Meta Data (Sensitive, Password included. DO NOT pass to front end.)
                $user = get_user_by('id', $user_id);
                // $user->set_role($role);
                $user->set_role('subscriber');
                // WooCommerce specific code
                if (class_exists('WooCommerce')) {
                    $user->set_role('customer');
                }
                // Ger User Data (Non-Sensitive, Pass to front end.)
                $response['code'] = 200;
                $response['message'] = __("Registration was Successful", "wp-rest-user");
            } else {
                return $user_id;
            }
        } else {
            $error->add(
                406,
                __(
                    "Email/username already exists.",
                    'wp-rest-user'
                ),
                array('status' => 400)
            );
            return $error;
        }
        return new WP_REST_Response($response, 123);
    }

    public function login_api()
    {
        /**
         * Handle Login User request
         */
        register_rest_route('v1/user', 'login', array(
            'methods'    => 'POST',
            'callback' => [$this, 'wc_rest_login_endpoint_handler']
        ));
    }
    public function wc_rest_login_endpoint_handler($request = null)
    {
        $response = array();
        $parameters = $request->get_params();
        $username = sanitize_text_field($parameters['username']);
        $password = sanitize_text_field($parameters['password']);
        $error = new WP_Error();
        if (empty($username)) {
            $error->add(
                400,
                array(
                    'username' => true,
                    'status' => 400
                )
            );
            return $error;
        }
        if (empty($password)) {
            $error->add(
                404,
                array(
                    'password' => true,
                    'status' => 400
                )
            );
            return $error;
        }

        // if (!wp_verify_nonce($params['_wpnonce'], 'wp_rest')) {
        //     return new WP_Rest_Response('Data not Sent', 422);
        // }
        unset($params['_wpnonce']);
        unset($params['_wp_http_referer']);
        $creds = array(
            'user_login'    => $username,
            'user_password' => $password,
            'remember'      => true
        );
        $user = wp_signon($creds, false);
        if (is_wp_error($user)) {
            $error->add(
                404,
                array(
                    'error' => "The password or username is incorrect",
                    'status' => 400
                )
            );
            return $error;
        } else {
            wp_clear_auth_cookie();
            wp_set_current_user($user->ID); // Set the current user detail
            wp_set_auth_cookie($user->ID); // Set auth details in cookie
            $response = true;
        }
        return new WP_REST_Response($response, 123);
    }
}
