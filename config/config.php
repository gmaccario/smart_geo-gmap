<?php
return [
    'settings' => [
		'dependencies' => [],
		'restrictions' => []
	],
	'features' => [
		'backend' => [
			'hooks' => [],
			'filters'=> [],
			'shortcodes'=> [],
			'ajax'=> [],
			'routes'=> [],
		    'additional_js' => [],
		    'additional_css' => [],
			'pages'=> [
				[
				    'name'=> 'Smart GEO GMap Backend',
    				'slug'=> 'smart_geo_gmap_menu_page',
    				'attributes'=> [
    					'callback'=> 'configuration',
    					'tabs'=> [
    						[
    							'name' => 'Welcome',
    							'slug' => 'welcome',
    							'callback' => 'displayTabWelcome'
    						],
    					    [
    					        'name' => 'Settings',
    					        'slug' => 'settings',
    					        'callback' => 'displayTabSettings'
    					    ],
    						[
    							'name' => 'Files',
    							'slug' => 'files',
    							'callback' => 'displayTabFiles'
    						]
    					]
    				]
				]
			]
		],
		'frontend' => [
			'hooks'=> [],
			'filters'=> [],
			'shortcodes'=> [
			    ['smart_geo_gmap'=> 'showSmartGEOGoogleMap']
			],
			'ajax'=> [],
			'routes'=> [],
		    'additional_js' => [ 'https://maps.googleapis.com/maps/api/js?key=%s&amp;callback=initMap' ],
		    'additional_css' => []
		]
	],
	'comments'=> 'Pages will create new pages for your backend and tabs will create tabs inside backend pages. | Frontend shortcodes: [shortcode => frontend method]'
];
