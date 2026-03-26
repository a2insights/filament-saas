<?php

return [
    'user' => [
        'model' => App\Models\User::class,
        'resource' => A2Insights\FilamentSaas\User\Filament\UserResource::class,
        'tenant_scope' => false,
    ],

    'company' => [
        'model' => App\Models\Company::class,
    ],

    'terms_of_use_path' => 'terms-of-use',
    'privacy_policy_path' => 'privacy-policy',

    'legal_pages' => false,

    'robots_allowed_domains' => [
        'localhost',
    ],
];
