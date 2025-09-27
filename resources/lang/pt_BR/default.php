<?php

return [
    'users' => [
        'register' => [
            'accept_terms' => 'Eu aceito os <a href=":terms_of_service_path" class="underline">Termos de Uso</a> e a <a href=":privacy_policy_path" class="underline">Política de Privacidade</a>',
            'phone' => 'Telefone',
        ],
        'profile' => [
            'phone' => [
                'title' => 'Telefone',
                'description' => 'Adicione e atualize seu número de telefone',
                'submit' => 'Atualizar',
                'notify' => 'Perfil atualizado com sucesso!',
            ],
            'username' => [
                'title' => 'Nome de Usuário',
                'description' => 'Adicione e atualize seu nome de usuário',
                'submit' => 'Atualizar',
                'notify' => 'Username atualizado com sucesso!',
            ],
        ],
        'navigation' => [
            'user' => 'Usuário|Usuários',
            'role' => 'Função|Funções',
            'group' => 'Usuários',
        ],
    ],

    'features' => [
        'title' => 'Funcionalidades',
        'heading' => 'Funcionalidades',
        'subheading' => 'Habilite ou desabilite funcionalidades do sistema.',
        'auth' => [
            'title' => 'Autenticação',
            'registration' => [
                'label' => 'Registro',
                'help_text' => 'Habilitar pagina de registro.',
            ],
        ],
        'webhooks' => [
            'title' => 'Webhooks',
            'subtitle' => 'Habilitar páginas de webhooks.',
            'active' => [
                'label' => 'Ativo',
            ],
        ],
        'whatsapp_chat' => [
            'title' => 'WhatsApp Chat',
            'subtitle' => 'Habilitar widget de chat do WhatsApp no site.',
            'active' => [
                'label' => 'Ativo',
            ],
            'attendants' => [
                'title' => 'Atendentes',
                'avatar' => [
                    'label' => 'Avatar',
                ],
                'icon' => [
                    'label' => 'Icone',
                ],
                'active' => [
                    'label' => 'Ativo',
                ],
                'name' => [
                    'label' => 'Nome',
                    'help_text' => 'Nome do atendente.',
                ],
                'label' => [
                    'label' => 'Label',
                    'help_text' => 'Descricao do atendente.',
                ],
                'phone' => [
                    'label' => 'Telefone',
                ],
            ],
            'header' => [
                'label' => 'Cabeçalho',
            ],
            'footer' => [
                'label' => 'Rodapé',
            ],
        ],
        'user' => [
            'title' => 'Usuário',
            'subtitle' => 'Habilite ou desabilite funcionalidades do usuário.',
            'switch_language' => [
                'label' => 'Trocar Idioma',
                'help_text' => 'Habilitar opção de troca de idioma na barra superior.',
            ],
            'phone' => [
                'label' => 'Telefone',
                'help_text' => 'Habilitar telefone na página de registro e perfil.',
            ],
            'username' => [
                'label' => 'Username',
                'help_text' => 'Habilitar nome de usuário na página de registro e perfil. Deve ser único.',
            ],
            'registration' => [
                'label' => 'Registro',
                'help_text' => 'Habilitar pagina de registro.',
            ],
        ],
    ],

    'settings' => [
        'title' => 'Configurações',
        'heading' => 'Configurações',
        'subheading' => 'Configure o comportamento do sistema.',
        'seo' => [
            'title' => 'SEO',
            'subtitle' => 'Configure o SEO do sistema.',
            'name' => [
                'label' => 'Nome',
            ],
            'keywords' => [
                'label' => 'Palavras-chave',
                'help_text' => 'Pressione Enter para adicionar palavras-chave.',
            ],
            'description' => [
                'label' => 'Descrição',
                'help_text' => 'HTML não é permitido.',
            ],
        ],
        'sitemap' => [
            'title' => 'Sitemap',
            'subtitle' => 'Configure o sitemap do site.',
            'active' => [
                'label' => 'Ativo',
            ],
            'pages' => [
                'title' => 'Páginas',
                'page' => [
                    'label' => 'Páginas',
                ],
            ],
        ],
        'robots' => [
            'title' => 'Robots',
            'subtitle' => 'Configure o robots do site.',
            'label' => 'Robots',
        ],
        'style' => [
            'title' => 'Estilo',
            'subtitle' => 'Configure o estilo, marca e cores do sistema.',
            'logo' => [
                'label' => 'Logo',
                'help_text' => 'Envie seu logo. Tamanho recomendado: proporção de 3x1.',
            ],
            'og' => [
                'label' => 'OG',
                'help_text' => 'Configure a imagem Open Graph para compartilhamento nas redes sociais.',
            ],
            'logo_size' => [
                'label' => 'Tamanho do Logo',
                'help_text' => 'Exemplo: 2rem',
            ],
            'favicon' => [
                'label' => 'Favicon',
                'help_text' => 'Envie seu favicon. Tamanho recomendado: 16x16px. Formatos suportados: .ico, .png, .svg.',
            ],
        ],
        'embed' => [
            'title' => 'Embed',
            'subtitle' => 'Configure códigos de incorporação.',
            'head' => [
                'label' => 'Head',
                'help_text' => 'HTML para ser inserido na head do site. Ex: Google Analytics.',
            ],
        ],
        'terms_and_privacy_policy' => [
            'title' => 'Termos e Política de Privacidade',
            'subtitle' => 'Configure os termos e a política de privacidade do sistema.',
            'terms' => [
                'label' => 'Termos',
            ],
            'privacy_policy' => [
                'label' => 'Política de Privacidade',
            ],
        ],
        'security' => [
            'title' => 'Segurança',
            'subtitle' => 'Configure o comportamento de segurança do site.',
            'restrict_ips' => [
                'label' => 'Restringir IPs',
                'help_text' => 'Cuidado: Se você bloquear seu próprio IP, será bloqueado do sistema e terá que remover o IP do banco de dados manualmente ou acessar de outro IP.',
            ],
            'restrict_users' => [
                'label' => 'Restringir Usuários',
                'help_text' => 'Cuidado: Se você bloquear seu próprio usuário, será bloqueado do sistema e terá que remover o usuário do banco de dados manualmente ou acessar com outro usuário.',
            ],
        ],
        'localization' => [
            'title' => 'Localização',
            'subtitle' => 'Configure a localização do sistema.',
            'timezone' => [
                'label' => 'Fuso Horário',
                'help_text' => 'A hora atual é :time.',
            ],
            'locale' => [
                'label' => 'Idioma',
                'help_text' => 'Se você mudar o idioma, ele será exibido de acordo com a configuração.',
            ],
            'locales' => [
                'label' => 'Idiomas',
                'help_text' => 'Lista de idiomas disponíveis.',
            ],
        ],
    ],

    'privacy-policy' => [
        'title' => 'Política de Privacidade',
    ],

    'terms-of-service' => [
        'title' => 'Termos de Serviço',
    ],
];
