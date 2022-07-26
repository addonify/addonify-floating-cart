<?php

class Addonify_Floating_Cart_Rest_Api{

    protected $namespace = "addonify_floating_cart_options_api/";

    function __construct(){
        add_action( 'rest_api_init', [$this, 'register_rest_apis'] );
    }

    function register_rest_apis(){

        register_rest_route( 
            $this->namespace, 
            'get_options', 
            array(
                'methods' => 'GET',
                'callback' => [$this, 'rest_handler_get_settings_fields'],
                'permission_callback' => [$this, 'permission_callback']
            )
        );

        register_rest_route( $this->namespace, 'update_options', 
            array(
                'methods' => \WP_REST_Server::CREATABLE,
                'callback' => [$this, 'rest_handler_update_options'],
                'permission_callback' => [ $this, 'permission_callback' ]
            )
        );
    }

    public function rest_handler_get_settings_fields(){
        return addonify_floating_cart_get_setting_fields();
    }


    /**
     * Callback function to update all settings options values.
     * 
     * @since    1.0.7
     * @param    \WP_REST_Request    $request    The request object.
     * @return   \WP_REST_Response   $return_data   The response object.
     */
    public function rest_handler_update_options( $request ) {

        $return_data = array(
            'success' => false,
            'message' => __( 'Ooops, error saving settings!!!', 'addonify-floating-cart' ),
        );

        $params = $request->get_params(); 

        if ( ! isset( $params['settings_values'] ) ) {

            $return_data['message'] = __( 'No settings values to update!!!', 'addonify-floating-cart' );
            return $return_data;
        }

        if ( addonify_quick_view_update_settings_fields_values( $params['settings_values'] ) === true ) {

            $return_data['success'] = true;
            $return_data['message'] = __( 'Settings saved successfully', 'addonify-floating-cart' );
        } 

        return rest_ensure_response( $return_data );
    }



    /**
     * Permission callback function to check if current user can access the rest api route.
     * 
     * @since    1.0.0
     */
    public function permission_callback() {

        if ( ! current_user_can( 'manage_options' ) ) {
            return new WP_Error( 'rest_forbidden',esc_html__( 'Ooops, you are not allowed to manage options.', 'addonify-floating-cart' ), 
            array( 'status' => 401 ) );
        } 
        
        return true;
    }
}