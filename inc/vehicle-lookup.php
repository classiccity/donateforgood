<?php
// /wp-json/vehdb/v1/license-decode?plate=ABC123&state=GA
add_action('rest_api_init', function () {
  register_rest_route('vehdb/v1', '/vin-decode', [
    'methods'  => 'GET',
    'callback' => 'vehdb_vin_decode_proxy',
    'permission_callback' => '__return_true',
    'args' => [
      'vin' => [
        'required' => true,
        'sanitize_callback' => 'sanitize_text_field',
      ],
    ],
  ]);
});

function vehdb_vin_decode_proxy( WP_REST_Request $req ) {
  $vin = strtoupper(trim($req->get_param('vin')));

  if (!$vin) {
    return new WP_REST_Response(['error' => 'VIN is required'], 400);
  }

  // Keep the API key server-side
  $apiKey = get_field('api_key', 'option') ?? '';

  $url = sprintf(
    'https://api.vehicledatabases.com/vin-decode/%s',
    rawurlencode($vin)
  );

  $resp = wp_remote_get($url, [
    'headers' => ['x-AuthKey' => $apiKey],
    'timeout' => 10,
  ]);

  if (is_wp_error($resp)) {
    return new WP_REST_Response(['error' => $resp->get_error_message()], 502);
  }

  $code = wp_remote_retrieve_response_code($resp);
  $body = wp_remote_retrieve_body($resp);
  $json = json_decode($body, true);

  if ($code !== 200) {
    return new WP_REST_Response([
      'error'   => $json['message'] ?? 'Vehicle API returned error',
      'status'  => $json['status'] ?? 'error',
      'code'    => $code,
    ], $code);
  }

  $basic = $json['data']['basic'] ?? [];
  $intro = $json['data']['intro'] ?? [];

  return [
    'vin'   => $intro['vin']  ?? $vin,
    'year'  => $basic['year'] ?? '',
    'make'  => $basic['make'] ?? '',
    'model' => $basic['model']?? '',
  ];
}
