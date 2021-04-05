<?php

if( !defined( 'WPINC' ) )
  die();

class CPT_Palestrantes {

    // -----------------------------------------------------------------------------

    public function __construct() {

        $cases = new Odin_Post_Type(
            'Palestrantes',
            'palestrantes'
        );

        $cases->set_arguments(
            array(
                'supports'            => array( 'title' , 'editor', 'thumbnail' ),
                'hierarchical'        => false,
                'menu_icon'           => 'dashicons-businessman',
                'exclude_from_search' => true
            )
        );

        $cases->set_labels(
            array(
                'menu_name'          => 'Palestrantes',
                'singular_name'      => 'Palestrante',
                'add_new'            => 'Adicionar Novo Palestrante',
                'add_new_item'       => 'Adicionar Novo Palestrante',
                'edit_item'          => 'Editar Palestrante',
                'new_item'           => 'Novo Palestrante',
                'all_items'          => 'Todos os Palestrante',
                'view_item'          => 'Ver Palestrante',
                'search_items'       => 'Procurar Palestrante',
                'not_found'          => 'Nenhum Palestrante Encontrado',
                'not_found_in_trash' => 'Nenhum Palestrante Encontrado na Lixeira',
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

new CPT_Palestrantes;

?>
