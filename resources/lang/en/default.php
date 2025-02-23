<?php

return [
    'users' => [
        'register' => [
            'accept_terms' => 'I accept the <a href=":terms_of_service_url" class="underline">Terms of Service</a> and <a href=":privacy_policy_url" class="underline">Privacy Policy</a>',
            'phone' => 'Phone',
        ],
        'profile' => [
            'phone' => [
                'title' => 'Phone',
                'description' => 'Add and update your phone number',
                'submit' => 'Update',
                'notify' => 'Profile updated successfully!',
            ],
            'username' => [
                'title' => 'Username',
                'description' => 'Add and update your username',
                'submit' => 'Update',
                'notify' => 'Username updated successfully!',
            ],
        ],
        'navigation' => [
            'user' => 'User|Users',
            'role' => 'Role|Roles',
            'group' => 'Users',
        ],
    ],

    'features' => [
        'title' => 'Features',
        'heading' => 'Features',
        'subheading' => 'Enable or disable features of the application.',
        'webhooks' => [
            'title' => 'Webhooks',
            'subtitle' => 'Enable webhooks page.',
            'active' => [
                'label' => 'Active',
            ],
        ],
        'whatsapp_chat' => [
            'title' => 'WhatsApp Chat',
            'subtitle' => 'Enable WhatsApp chat widget on the site.',
            'active' => [
                'label' => 'Active',
            ],
            'attendants' => [
                'title' => 'Attendants',
                'avatar' => [
                    'label' => 'Avatar',
                ],
                'icon' => [
                    'label' => 'Icon',
                ],
                'active' => [
                    'label' => 'Active',
                ],
                'name' => [
                    'label' => 'Name',
                    'help_text' => 'Name of attendant.',
                ],
                'label' => [
                    'label' => 'Label',
                    'help_text' => 'Label that will be displayed in the chat.',
                ],
                'phone' => [
                    'label' => 'Phone',
                ],
            ],
            'header' => [
                'label' => 'Header',
            ],
            'footer' => [
                'label' => 'Footer',
            ],
        ],
        'user' => [
            'title' => 'User',
            'subtitle' => 'Features related to users.',
            'switch_language' => [
                'label' => 'Switch Language',
                'help_text' => 'Enable switch language option in the top bar.',
            ],
            'phone' => [
                'label' => 'Phone',
                'help_text' => 'Enable phone in the register page and profile.',
            ],
            'username' => [
                'label' => 'Username',
                'help_text' => 'Enable username in the register page and profile. Must be unique.',
            ],
            'registration' => [
                'label' => 'Register',
                'help_text' => 'Enable register page.',
            ],
        ],
    ],

    'settings' => [
        'title' => 'Settings',
        'heading' => 'Settings',
        'subheading' => 'Configure the behavior of the application.',
        'seo' => [
            'title' => 'SEO',
            'subtitle' => 'Configure the SEO of the site.',
            'name' => [
                'label' => 'Name',
            ],
            'keywords' => [
                'label' => 'Keywords',
                'help_text' => 'Enter to add keywords.',
            ],
            'description' => [
                'label' => 'Description',
                'help_text' => 'HTML not allowed.',
            ],
        ],
        'sitemap' => [
            'title' => 'Sitemap',
            'subtitle' => 'Configure the sitemap of the site.',
            'active' => [
                'label' => 'Active',
            ],
            'pages' => [
                'title' => 'Pages',
                'page' => [
                    'label' => 'Page',
                ],
            ],
        ],
        'robots' => [
            'title' => 'Robots',
            'subtitle' => 'Configure the robots of the site.',
            'label' => 'Robots',
        ],
        'style' => [
            'title' => 'Style',
            'subtitle' => 'Configure the style, brand and colors of the application.',
            'logo' => [
                'label' => 'Logo',
                'help_text' => 'Upload your logo. Recommended size: 3x1 ratio.',
            ],
            'og' => [
                'label' => 'OG',
                'help_text' => 'Configure Open Graph meta image for social media sharing.',
            ],
            'logo_size' => [
                'label' => 'Logo Size',
                'help_text' => 'Example: 2rem',
            ],
            'favicon' => [
                'label' => 'Favicon',
                'help_text' => 'Preferably 16x16px. supported formats: .ico, .png, .svg.',
            ],
        ],
        'embed' => [
            'title' => 'Embed',
            'subtitle' => 'Append embed code to your site.',
            'head' => [
                'label' => 'Head',
                'help_text' => 'HTML code to be inserted in the head section.',
            ],
        ],
        'terms_and_privacy_policy' => [
            'title' => 'Terms and Privacy Policy',
            'subtitle' => 'Configure the terms and privacy policy of the application.',
            'terms' => [
                'label' => 'Terms',
            ],
            'privacy_policy' => [
                'label' => 'Privacy Policy',
            ],
        ],
        'security' => [
            'title' => 'Security',
            'subtitle' => 'Configure the security of the application.',
            'restrict_ips' => [
                'label' => 'Restrict IPs',
                'help_text' => 'Caution: If you block your own IP address, you will be locked out of your sistema. And you will have to manually remove your IP address from the database or access from another IP address.',
            ],
            'restrict_users' => [
                'label' => 'Restrict Users',
                'help_text' => 'Caution: If you block your own user, you will be locked out of your sistema. And you will have to manually remove your user from the database or access from another user.',
            ],
        ],
        'localization' => [
            'title' => 'Localization',
            'subtitle' => 'Configure the localization of the application.',
            'timezone' => [
                'label' => 'Timezone',
                'help_text' => 'Current time is :time.',
            ],
            'locale' => [
                'label' => 'Locale',
                'help_text' => 'If you change the locale, the locale will be displayed according to the locale you set.',
            ],
            'locales' => [
                'label' => 'Locales',
                'help_text' => 'List of locales available.',
            ],
        ],
    ],

    'privacy-policy' => [
        'title' => 'Privacy Policy',
    ],

    'terms-of-service' => [
        'title' => 'Terms of Service',
    ],
];
