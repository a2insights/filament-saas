<?php

return [
    'users' => [
        'model' => App\Models\User::class,
        'resource' => A2Insights\FilamentSaas\User\Filament\UserResource::class,
        'tenant_scope' => false,
    ],

    'companies' => [
        'model' => App\Models\Company::class,
    ],

    'terms_of_service_url' => 'terms-of-service_url',
    'privacy_policy_url' => 'privacy-policy_url',
];
