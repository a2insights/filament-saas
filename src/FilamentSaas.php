<?php

namespace A2Insights\FilamentSaas;

class FilamentSaas
{
    public static function getUserModel(): string
    {
        return config('filament-saas.user.model', 'App\\Models\\User');
    }

    public static function getCompanyModel(): string
    {
        return config('filament-saas.companies.model', 'App\\Models\\Company');
    }

    public static function getTeamModel(): string
    {
        return config('filament-saas.team_model', 'App\\Models\\Company');
    }

    public static function getPrivacyPolicyRoute(): string
    {
        return config('filament-saas.privacy_policy_url', 'privacy-policy');
    }

    public static function getTermsOfServiceRoute(): string
    {
        return config('filament-saas.terms_of_service_url', 'terms-of-service');
    }
}
