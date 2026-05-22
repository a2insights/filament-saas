<?php

namespace A2Insights\FilamentSaas\Facades;

use Illuminate\Support\Facades\Facade;
use League\CommonMark\MarkdownConverter;

/**
 * @method static \League\CommonMark\Output\RenderedContent convert(string $markdown)
 *
 * @see MarkdownConverter
 */
class Markdown extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'markdown';
    }
}
