<?php

if( !defined( 'WPINC' ) )
  die();

class CPT_Palestras {

    // -----------------------------------------------------------------------------

    public function __construct() {

        $cases = new Odin_Post_Type(
            'Palestra',
            'palestras'
        );

        $cases->set_arguments(
            array(
                'supports'            => array( 'title' , 'editor', 'thumbnail' ),
                'hierarchical'        => false,
                'menu_icon'           => 'dashicons-money',
                'exclude_from_search' => true
            )
        );

        $cases->set_labels(
            array(
                'menu_name'          => 'Palestras',
                'singular_name'      => 'Palestra',
                'add_new'            => 'Adicionar Nova Palestra',
                'add_new_item'       => 'Adicionar Nova Palestra',
                'edit_item'          => 'Editar Palestra',
                'new_item'           => 'Nova Palestra',
                'all_items'          => 'Todas as Palestra',
                'view_item'          => 'Ver Palestra',
                'search_items'       => 'Procurar Palestra',
                'not_found'          => 'Nenhuma Palestra Encontrado',
                'not_found_in_trash' => 'Nenhuma Palestra Encontrada na Lixeira',
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

new CPT_Palestras;

?>
