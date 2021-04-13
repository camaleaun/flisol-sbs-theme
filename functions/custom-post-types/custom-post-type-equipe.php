<?php

if( !defined( 'WPINC' ) )
  die();

class CPT_Equipe {

    // -----------------------------------------------------------------------------

    public function __construct() {

        $cases = new Odin_Post_Type(
            'Equipe',
            'equipe'
        );

        $cases->set_arguments(
            array(
                'supports'            => array( 'title' , 'thumbnail' ),
                'hierarchical'        => false,
                'menu_icon'           => 'dashicons-groups',
                'exclude_from_search' => true
            )
        );

        $cases->set_labels(
            array(
                'menu_name'          => 'Membros da Equipe',
                'singular_name'      => 'Membro da Equipe',
                'add_new'            => 'Adicionar Novo Membro a Equipe',
                'add_new_item'       => 'Adicionar Novo Membro a Equipe',
                'edit_item'          => 'Editar Membro da Equipe',
                'new_item'           => 'Novo Membro da Equipe',
                'all_items'          => 'Toda a Equipe',
                'view_item'          => 'Ver Membro da Equipe',
                'search_items'       => 'Procurar Membro da Equipe',
                'not_found'          => 'Nenhum Membro da Equipe Encontrado',
                'not_found_in_trash' => 'Nenhum Membro da Equipe Encontrado na Lixeira',
                'parent_item_colon'  => '',
            )
        );

        add_filter( 'manage_edit-cases_columns' , array($this, 'remove_columns_in_post_list' ) );
    }

    // -----------------------------------------------------------------------------

    /**
     * Edita as colunas que serão exibigas na listagem do post
     * @param  array $columns   Colunas
     * @return array
     */
    public function remove_columns_in_post_list( $columns ) {
        unset($columns["date"]);
        unset($columns["icl_translations"]);
        unset($columns["wpseo-metadesc"]);
        unset($columns["wpseo-title"]);
        unset($columns["wpseo-focuskw"]);
        unset($columns["wpseo-score"]);
        return $columns;
    }
}

new CPT_Equipe;

?>
