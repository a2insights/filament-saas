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

    'terms_of_service_path' => 'terms-of-service',
    'privacy_policy_path' => 'privacy-policy',
];
