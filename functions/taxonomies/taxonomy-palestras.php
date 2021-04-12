<?php
if( !defined( 'WPINC' ) )
  die();

class TAX_Palestras {

    // -----------------------------------------------------------------------------

    public function __construct()  {

        $course_type = new Odin_Taxonomy(
            'categoria Palestra',   // Nome (Singular) da nova Taxonomia.
            'categoria-palestra',   // Slug da Taxonomia.
            array( 'palestras' )        // Nome do tipo de conteúdo que a taxonomia irá fazer parte.
        );

        $course_type->set_labels(
            array(
                'name'                       =>  'Categorias', 'taxonomy general name',
                'singular_name'              =>  'Categoria', 'taxonomy singular name',
                'search_items'               =>  'Procurar Categoria',
                'popular_items'              =>  'Categorias mais usadas',
                'all_items'                  =>  'Todas as categorias',
                'parent_item'                =>  null,
                'parent_item_colon'          =>  null,
                'edit_item'                  =>  'Editar Categoria',
                'update_item'                =>  'Atualizar Categoria',
                'add_new_item'               =>  'Adicionar Categoria',
                'new_item_name'              =>  'Nova Categoria',
                'separate_items_with_commas' =>  'Separar atributo com vírgulas',
                'add_or_remove_items'        =>  'Adicionar ou remover',
                'choose_from_most_used'      =>  'Escolher a partir dos mais usados',
                'not_found'                  =>  'Nenhuma Categoria Encontrada.',
                'menu_name'                  =>  'Categorias Palestras'
            )
        );

        $course_type->set_arguments(
            array(
                'hierarchical' => true,
                'rewrite' => array( 'slug' => 'tipo-curso' )
            )
        );
    }
}

new TAX_Palestras;
