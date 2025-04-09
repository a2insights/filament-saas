<?php

namespace A2Insights\FilamentSaas\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \League\CommonMark\Output\RenderedContent convert(string $markdown)
 *
 * @see \League\CommonMark\MarkdownConverter
 */
class Markdown extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'markdown';
    }
}
