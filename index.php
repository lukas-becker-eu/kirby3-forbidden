<?php

Kirby::plugin('candyblue/forbidden', [
  'options' => [
    'load' => 'false'
  ],
  'hooks' => [
    'route:before' => function ($route, $path, $method) {
      $request = kirby()->request()->url();
      $panel_slug = str_ireplace(kirby()->url(), '', kirby()->url('panel'));
      $api_slug = str_ireplace(kirby()->url(), '', kirby()->url('api'));
      $plugin = kirby()->option('candyblue.forbidden.load');

      if ( $plugin === true && stripos($request, $panel_slug) === false && stripos($request, $api_slug) === false && !kirby()->user() ){
        Header::forbidden();
        echo '<h1>Forbidden</h1>';
        exit();
      }
    }
  ]
]);
