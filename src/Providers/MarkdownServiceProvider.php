<?php

namespace A2Insights\FilamentSaas\Providers;

use Illuminate\Support\ServiceProvider;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Extension\DefaultAttributes\DefaultAttributesExtension;
use League\CommonMark\Extension\Table\Table;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Node\Block\Paragraph;

class MarkdownServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('markdown', function () {
            $config = [
                'html_input' => 'allow',
                'allow_unsafe_links' => false,
                'default_attributes' => [
                    Heading::class => [
                        'class' => static function (Heading $node) {
                            // Classes Tailwind para headings baseadas no nível
                            switch ($node->getLevel()) {
                                case 1:
                                    return 'text-4xl font-bold text-gray-900';
                                case 2:
                                    return 'text-3xl font-bold text-gray-800';
                                case 3:
                                    return 'text-2xl font-bold text-gray-700';
                                case 4:
                                    return 'text-xl font-bold text-gray-600';
                                default:
                                    return 'text-lg font-bold text-gray-500';
                            }
                        },
                    ],
                    Table::class => [
                        'class' => 'min-w-full divide-y divide-gray-200 shadow-sm rounded-lg overflow-hidden mb-6',
                    ],
                    'table_head' => [
                        'class' => 'bg-gray-50',
                    ],
                    'table_cell' => [
                        'class' => 'px-6 py-4 whitespace-nowrap text-sm text-gray-900',
                    ],
                    'table_header_cell' => [
                        'class' => 'px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider',
                    ],
                    Paragraph::class => [
                        'class' => 'mb-4 text-gray-700 leading-relaxed',
                    ],
                    Link::class => [
                        'class' => 'text-blue-600 hover:text-blue-800 hover:underline transition duration-150',
                        'target' => '_blank',
                        'rel' => 'noopener noreferrer',
                    ],
                    'blockquote' => [
                        'class' => 'border-l-4 border-gray-300 pl-4 italic text-gray-600 mb-4',
                    ],
                    'code_block' => [
                        'class' => 'bg-gray-800 text-gray-100 p-4 rounded mb-4 overflow-x-auto text-sm font-mono',
                    ],
                    'inline_code' => [
                        'class' => 'bg-gray-100 px-2 py-1 rounded text-sm font-mono',
                    ],
                    'list' => [
                        'class' => 'pl-5 mb-4',
                    ],
                    'list_item' => [
                        'class' => 'mb-2',
                    ],
                    'image' => [
                        'class' => 'rounded-lg shadow-md mb-4 max-w-full h-auto',
                    ],
                ],
            ];

            $environment = new Environment($config);
            $environment->addExtension(new CommonMarkCoreExtension);
            $environment->addExtension(new DefaultAttributesExtension);
            $environment->addExtension(new AttributesExtension);
            $environment->addExtension(new TableExtension);

            return new MarkdownConverter($environment);
        });
    }

    public function boot()
    {
        //
    }
}
