<?php

if( !defined( 'WPINC' ) )
  die();

class CPT_Atividades {

    // -----------------------------------------------------------------------------

    public function __construct() {

        $cases = new Odin_Post_Type(
            'Atividades',
            'atividades'
        );

        $cases->set_arguments(
            array(
                'supports'            => array( 'title' , 'editor', 'thumbnail' ),
                'hierarchical'        => false,
                'menu_icon'           => 'dashicons-smiley',
                'exclude_from_search' => true
            )
        );

        $cases->set_labels(
            array(
                'menu_name'          => 'Atividades',
                'singular_name'      => 'Atividade',
                'add_new'            => 'Adicionar Nova Atividade',
                'add_new_item'       => 'Adicionar Nova Atividade',
                'edit_item'          => 'Editar Atividade',
                'new_item'           => 'Nova Atividade',
                'all_items'          => 'Todas as Atividades',
                'view_item'          => 'Ver Atividade',
                'search_items'       => 'Procurar Atividade',
                'not_found'          => 'Nenhuma Atividade Encontrada',
                'not_found_in_trash' => 'Nenhuma Atividade Encontrada na Lixeira',
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

new CPT_Atividades;

?>
