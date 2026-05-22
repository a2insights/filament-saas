<?php

namespace A2Insights\FilamentSaas\User;

use ArrayAccess;
use Spatie\LaravelData\Data;

class UserPreferences extends Data implements ArrayAccess
{
    public function __construct(
        public ?string $app_theme = 'default',
        public ?string $navigation_layout = 'sidebar',
        public ?int $zoom_level = 100,
        public array $dismissed_alerts = [],
        public array $collapsed_alerts = [],
        public bool $show_alerts_globally = true,
        public ?string $last_seen_version = null,
    ) {}

    public function offsetExists(mixed $offset): bool
    {
        return property_exists($this, $offset);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->{$offset} ?? null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->{$offset} = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        $this->{$offset} = null;
    }
}
