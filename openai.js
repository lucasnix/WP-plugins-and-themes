add_action( 'rest_api_init', function () {
    register_rest_route( 'myplugin/v1', '/openai', array(
        'methods' => 'POST',
        'callback' => 'openai_api_request',
    ) );
} );
