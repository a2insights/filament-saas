<?php

use A2Insights\FilamentSaas\User\Filament\UserResource;
use App\Models\Company;
use App\Models\User;

return [
    'user' => [
        'model' => User::class,
        'resource' => UserResource::class,
        'tenant_scope' => false,
    ],

    'company' => [
        'model' => Company::class,
    ],

    'terms_of_use_path' => 'terms-of-use',
    'privacy_policy_path' => 'privacy-policy',

    'legal_pages' => false,

    'robots_allowed_domains' => [
        'localhost',
    ],
];
