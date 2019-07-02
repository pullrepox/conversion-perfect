<?php
return [
    'ssl_tf'           => (env('APP_ENV') == 'dev' ? null : true),
    'domain_alias'     => 'app.',
    'site_domain'      => (env('APP_ENV') == 'dev' ? 'app.conversionperfectdev.test' : 'conversionperfect.com'),
    'site_domain_name' => (env('APP_ENV') == 'dev' ? 'app.conversionperfectdev' : 'conversionperfect'),
    'admin_email'      => 'admin@conversionperfect.com',
    'avatar_path'      => 'avatars/',
    'support_email'    => 'support@conversionperfect.com',
    'support_url'      => 'https://support.conversionperfect.com',
    'full_url'         => 'conversionperfect.com',
    'api_token'        => 'g97Bw8QdwqARtzZ9aXUKqje9',
    'billing_flag'     => 0,
    'link_check_min'   => 10,
    'db_prefix'        => '',
    'custom_link'      => [0 => 'https://username.cnvp.me/', -1 => 'https://username.cnvp.in/'],
    'home_url'         => (env('APP_ENV') == 'dev' ? 'http://app.conversionperfectdev.test' : 'https://conversionperfect.com'),
];
