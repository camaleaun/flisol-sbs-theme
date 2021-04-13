<?php
if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

// --------------------------------

class Theme_Options extends Odin_Theme_Options {

    // -----------------------------------------------------------------------------

    public function __construct() {

        $this->create_theme_options();
    }

    // -----------------------------------------------------------------------------

    public function create_theme_options() {
        $options = new Odin_Theme_Options(
            'dados_gerais', // Slug/ID da página (Obrigatório)
            'Dados Gerais', // Titulo da página (Obrigatório
            'read'
        );

        $options->set_tabs(
            array(
               /*  array(
                    'id'    => 'contact',
                    'title' => 'Contato', // Título da aba.
                ), */
               /*  array(
                    'id'    => 'location',
                    'title' => 'Localização', // Título da aba.
                ), */
                array(
                    'id'    => 'social_networks',
                    'title' => 'Redes Sociais',
                ),
               /*  array(
                    'id'    => 'mailchimp',
                    'title' => 'Mailchimp',
                ), */
                /* array(
                    'id'    => 'widget_sidebar_blog',
                    'title' => 'Widget Sidebar Blog'
                ) */
            )
        );

        $options->set_fields(
            array(
                'contact' => array(
                    'tab'   => 'contact', // Sessão da aba odin_general
                    'title' => 'Dados de Contato',
                    'fields' => array(
                        array(
                            'id' => 'contact_phone',
                            'label' => 'Telefone',
                            'type' => 'text',
                            'description' => 'Utilize espaço para separar o código de área, ex. (47) 9090-9090'
                        ),
                        array(
                            'id' => 'contact_github',
                            'label' => 'GitHub',
                            'type' => 'text',
                            'description' => 'Utilize espaço para separar o código de área, ex. (47) 9090-9090'
                        ),
                        array(
                            'id' => 'contact_general_email',
                            'label' => 'Email Geral',
                            'type' => 'text',
                        ),
                        array(
                            'id' => 'contact_email',
                            'label' => 'Email Contato',
                            'type' => 'text',
                        ),

                        /*
                        array(
                            'id' => 'contact_logo_email',
                            'label' => 'Logo Email',
                            'type' => 'image',
                            'default'     => '',
                            'description' => '',
                        ),
                        */
                    )
                ),
                'location' => array(
                    'tab'   => 'location', // Sessão da aba odin_general
                    'title' => 'Dados de Localização',
                    'fields' => array(
                        array(
                            'id' => 'location_address',
                            'label' => 'Endereço',
                            'type' => 'text',
                            'description' => 'Rua, Número',
                        ),
                        array(
                            'id' => 'location_complements',
                            'label' => 'Complemento',
                            'type' => 'text',
                            'description' => 'Andar, Sala',
                        ),
                        array(
                            'id' => 'location_neighborhood',
                            'label' => 'Bairro',
                            'type' => 'text',
                        ),
                        array(
                            'id' => 'location_zip',
                            'label' => 'Cep',
                            'type' => 'text',
                        ),
                        array(
                            'id' => 'location_city',
                            'label' => 'Cidade',
                            'type' => 'text',
                        ),
                        array(
                            'id' => 'location_state',
                            'label' => 'Estado',
                            'type' => 'text',
                        ),
                    )
                ),
                'social_networks' => array(
                    'tab'   => 'social_networks', // Sessão da aba odin_general
                    'title' => 'Redes Sociais',
                    'fields' => array(
                        array(
                            'id' => 'social_networks_facebook',
                            'label' => 'Facebook',
                            'type' => 'text',
                            'attributes'  => array( // Optional (html input elements)
                                'type' => 'url',
                                'class' => 'social_networks'
                            ),
                            'description' => 'Link completo, incluíndo o http://'
                        ),
                        /*
                        array(
                            'id' => 'social_networks_foursquare',
                            'label' => 'Four Square',
                            'type' => 'text',
                            'description' => 'Link completo, incluíndo o http://'
                        ),*/
                        /*   array(
                            'id' => 'social_networks_twitter',
                            'label' => 'Twitter',
                            'type' => 'text',
                            'description' => 'Link completo, incluíndo o http://'
                        ), */
                        array(
                            'id' => 'social_networks_youtube',
                            'label' => 'Youtube',
                            'type' => 'text',
                            'attributes'  => array( // Optional (html input elements)
                                'type' => 'url',
                                'class' => 'social_networks'
                            ),
                            'description' => 'Link completo, incluíndo o http://'
                        ),
                        array(
                            'id' => 'social_networks_instagram',
                            'label' => 'Instagram',
                            'type' => 'text',
                            'description' => 'Link completo, incluíndo o http://'
                        ),
                        array(
                            'id' => 'social_networks_twitter',
                            'label' => 'twitter',
                            'type' => 'text',
                            'description' => 'Link completo, incluíndo o http://'
                        ),
                        array(
                            'id' => 'social_networks_github',
                            'label' => 'GitHub',
                            'type' => 'text',
                            'description' => 'Link completo, incluíndo o http://'
                        ),
                        /* array(
                            'id' => 'social_networks_spotify',
                            'label' => 'Spotify',
                            'type' => 'text',
                            'description' => 'Link completo, incluíndo o http://'
                        ), */
                    )
                ),
                'mailchimp' => array(
                    'tab'   => 'mailchimp', // Sessão da aba odin_general
                    'title' => 'Mail Chimp',
                    'fields' => array(
                        array(
                            'id' => 'link_subscribe_newsletter',
                            'label' => 'Link Inscrição',
                            'type' => 'text',
                            'description' => ''
                        ),
                    ),
                ),
                'widget_sidebar_blog' => array(
                    'tab'   => 'widget_sidebar_blog', // Sessão da aba odin_general
                    'title' => 'Widget Blog',
                    'fields' => array(
                        array(
                            'id' => 'info_adverts_blog',
                            'label' => 'Infos / Anúncios',
                            'type' => 'editor',
                            'options'     => array(
                                'textarea_rows' => 10,
                                'media_buttons' => false
                            ),
                            'description' => ''
                        ),
                        array(
                            'id' => 'link_info_adverts_blog',
                            'label' => 'Link Infos / Anúncios',
                            'type' => 'text',
                            'description' => ''
                        ),
                    ),
                ),
                /* 'form_options' => array(
                    'tab'   => 'form_options', // Sessão da aba odin_general
                    'title' => 'Opções',
                    'fields' => array(
                        array(
                            'id' => 'form_from_options_closed',
                            'label' => 'Opções Fechadas',
                            'type' => 'textarea',
                            'description' => '1 opção por linha'
                        ),
                        array(
                            'id' => 'form_from_options_opened',
                            'label' => 'Opções Abertas',
                            'type' => 'textarea',
                            'description' => '1 opção por linha'
                        ),
                    ),
                ), */
            )

        );

    }

    // -----------------------------------------------------------------------------
}


new Theme_Options;
