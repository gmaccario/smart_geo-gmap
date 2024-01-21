<?php

namespace SmartGeoGMap\Actions\Public;

use SmartGeoGMap\Helpers\Constants;
use SmartGeoGMap\Helpers\LoggerAdapter;

class Actions
{
    public string $side = Constants::SMARTGEOGMAP_SIDE_PUBLIC;

	private LoggerAdapter $logger;

    public function __construct( LoggerAdapter $logger = null )
    {
	    $this->logger = $logger;

        // add_action ( 'rest_api_init', [$this, 'prepare_rest_init'] );
    }

    /*public function prepare_rest_init(): void
    {
        $this->at_rest_init_oauth();
        $this->at_rest_init_process();
    }

    public function at_rest_init_oauth(): void
    {
        // route url: domain.com/wp-json/$namespace/$route
        $namespace = Constants::SNAPWIZARD_API_NAMESPACE;
        $route     = Constants::SNAPWIZARD_API_AUTH;

        register_rest_route($namespace, $route, [
            'methods'   => \WP_REST_Server::READABLE,
            'callback'  => [$this->tokenManager, 'snapwizard_create_token_from_oauth_redirect_url_public_page']
        ]);
    }

    public function at_rest_init_process(): void
    {
        // route url: domain.com/wp-json/$namespace/$route
        $namespace = Constants::SNAPWIZARD_API_NAMESPACE;
        $route     = Constants::SNAPWIZARD_API_PROCESS;

        register_rest_route($namespace, $route, [
            'methods'   => \WP_REST_Server::READABLE,
            'callback'  => [$this->feedProcessor, 'snapwizard_process_ig_feed_url']
        ]);
    }*/
}
