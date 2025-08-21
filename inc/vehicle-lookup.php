<?php
// /wp-json/vehdb/v1/license-decode?plate=ABC123&state=GA
add_action('rest_api_init', function () {
  register_rest_route('vehdb/v1', '/license-decode', [
    'methods'  => 'GET',
    'callback' => 'vehdb_decode_proxy',
    'permission_callback' => '__return_true',
    'args' => [
      'plate' => ['required' => true, 'sanitize_callback' => 'sanitize_text_field'],
      'state' => ['required' => true, 'sanitize_callback' => 'sanitize_text_field'],
    ],
  ]);
});

function vehdb_decode_proxy( WP_REST_Request $req ) {
  $plate = strtoupper(trim($req->get_param('plate')));
  $state = strtoupper(trim($req->get_param('state')));

  if (!$plate || !$state) {
    return new WP_REST_Response(['error' => 'Plate and state are required'], 400);
  }

  // Full state names to abbreviations
  $states = [
    'ALABAMA' => 'AL',
    'ALASKA' => 'AK',
    'ARIZONA' => 'AZ',
    'ARKANSAS' => 'AR',
    'CALIFORNIA' => 'CA',
    'COLORADO' => 'CO',
    'CONNECTICUT' => 'CT',
    'DELAWARE' => 'DE',
    'FLORIDA' => 'FL',
    'GEORGIA' => 'GA',
    'HAWAII' => 'HI',
    'IDAHO' => 'ID',
    'ILLINOIS' => 'IL',
    'INDIANA' => 'IN',
    'IOWA' => 'IA',
    'KANSAS' => 'KS',
    'KENTUCKY' => 'KY',
    'LOUISIANA' => 'LA',
    'MAINE' => 'ME',
    'MARYLAND' => 'MD',
    'MASSACHUSETTS' => 'MA',
    'MICHIGAN' => 'MI',
    'MINNESOTA' => 'MN',
    'MISSISSIPPI' => 'MS',
    'MISSOURI' => 'MO',
    'MONTANA' => 'MT',
    'NEBRASKA' => 'NE',
    'NEVADA' => 'NV',
    'NEW HAMPSHIRE' => 'NH',
    'NEW JERSEY' => 'NJ',
    'NEW MEXICO' => 'NM',
    'NEW YORK' => 'NY',
    'NORTH CAROLINA' => 'NC',
    'NORTH DAKOTA' => 'ND',
    'OHIO' => 'OH',
    'OKLAHOMA' => 'OK',
    'OREGON' => 'OR',
    'PENNSYLVANIA' => 'PA',
    'RHODE ISLAND' => 'RI',
    'SOUTH CAROLINA' => 'SC',
    'SOUTH DAKOTA' => 'SD',
    'TENNESSEE' => 'TN',
    'TEXAS' => 'TX',
    'UTAH' => 'UT',
    'VERMONT' => 'VT',
    'VIRGINIA' => 'VA',
    'WASHINGTON' => 'WA',
    'WEST VIRGINIA' => 'WV',
    'WISCONSIN' => 'WI',
    'WYOMING' => 'WY',
    // DC and territories
    'DISTRICT OF COLUMBIA' => 'DC',
    'PUERTO RICO' => 'PR',
    'GUAM' => 'GU',
    'AMERICAN SAMOA' => 'AS',
    'NORTHERN MARIANA ISLANDS' => 'MP',
    'US VIRGIN ISLANDS' => 'VI'
  ];

  // Convert if needed
  if (isset($states[$state])) {
    $state = $states[$state];
  }

  // Keep the API key server-side
  $apiKey = get_field('api_key', 'option') ?? '';

  $url = sprintf(
    'https://api.vehicledatabases.com/license-decode/%s/%s',
    rawurlencode($plate),
    rawurlencode($state)
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
    'vin'   => $intro['vin']  ?? '',
    'year'  => $basic['year'] ?? '',
    'make'  => $basic['make'] ?? '',
    'model' => $basic['model']?? '',
  ];
}
