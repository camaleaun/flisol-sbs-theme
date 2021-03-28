<?php

if ( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

class Controller_Post {

    public function __construct(){
        add_action( 'pre_get_posts', array( $this, 'setPostsPerPage' ), 10 ,2 );
        add_filter( 'get_blog_post' , array( $this , 'get_blog_post') );
        add_filter( 'get_blog_posts' , array( $this , 'get_blog_posts') );
        add_filter( 'get_last_post_home' , array( $this , 'get_last_post_home' ) );
        add_filter( 'get_last_post_sidebar' , array( $this , 'get_last_post_sidebar' ) );
        //add_filter( 'get_post_featured' , array( $this , 'get_post_featured' ) );
        add_filter( 'get_blog_categories' , array( $this , 'get_blog_categories' ) );
        add_filter( 'get_post_viewed' , array( $this , 'getPostMostViewed' ) );
        add_filter( 'get_post_viewed_sidebar_left' , array( $this , 'getPostViewedSidebarLeft' ) );
        add_filter( 'get_post_viewed_sidebar_right' , array( $this , 'getPostViewedSidebarRight' ) );
        add_filter( 'get_post_viewed_home' , array( $this , 'getPostViewedHome' ) );
        add_filter( 'get_post_viewed_full_home' , array( $this , 'getPostViewedFullHome' ) );

    }

    public function setPostsPerPage($query) {

        $this->query = $query;

        if( $query->get( 'post_type' ) !=  'post') {
            return;
        }
        $this->query->set( 'posts_per_page', 12 );
    }

    public function get_post_by_id( $post_id ) {
        $post = get_post( $post_id );
        if( $post ) {
            return $this->get_blog_post( $post );
        }
        return false;
    }

    public function get_blog_post( $post ) {
        $post->intro = $post->post_excerpt;
        $post->permalink = get_permalink( $post );
        $post->date = get_the_date( 'd/m/Y', $post->ID );
        $post->date_extend = get_the_date( 'd F Y', $post->ID );
        $post->featuredImageId = get_post_thumbnail_id( $post->ID );
        $post->author_display_name =  get_the_author_meta( 'display_name' , $post->post_author );
        $post->author_display_description =  get_the_author_meta( 'user_description' , $post->post_author );
        $author_avatar_id =  get_user_meta(  $post->post_author , 'wp_user_avatar' , true );
        //$post->author_photos =  apply_filters( 'get_images_resized' , array( $author_avatar_id ) , $this->image_author_sizes );
        $post->categories = $this->get_post_categories( $post->ID );
        $post->image_cover = $this->getCoverFromPost( $post );
        $post->excerpt = $post->post_content ? substr( wp_strip_all_tags($post->post_content) , 0, 150) . '...'  : false;
        if ( $post->post_excerpt )
            $post->excerpt = $post->post_excerpt;
        return $post;
    }

    public function get_blog_posts( $posts ) {
        if( count( $posts ) == 0 ) {
            return null;
        }

        $posts_blog = array();
        foreach( $posts as $post ) {
            $posts_blog[] = $this->get_blog_post( $post );
        }
        return $posts_blog;
    }

    public function get_last_post_home() {
        global $wp_query;

        $tax = $wp_query->get_queried_object();
        $posts_per_page = 1;
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => $posts_per_page
        );
        $tax = $wp_query->get_queried_object();
        if( isset($tax->$taxonomy) ) {
            $tax_query[] = array(
                'taxonomy'  => $tax->taxonomy,
                'field'     => 'slug',
                'terms'     => $tax->slug
            );
            $args['tax_query'] = $tax_query;
        }

        $posts = get_posts( $args );

        if( count( $posts ) == 0 ) {
            return null;
        }

        $post_blog = array_shift( $posts );

        $this->get_blog_post( $post_blog );

        $img_id = get_post_thumbnail_id( $post_blog->ID );
        if( $img_id ) {
            $post_blog->imageBig = $this->getCoverFromImageId( $img_id, 1139, 544, false );
        } else {
            $post_blog->imageBig = false;
        }
        return $post_blog;
    }

    public function get_last_post_sidebar() {
        global $wp_query;

        //$tax = $wp_query->get_queried_object();
        $posts_per_page = 6;
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    =>  $posts_per_page,
            'orderby'           => 'date',
            'order'             => 'DESC',

        );
       $posts = get_posts($args);
        if ( $posts ) {
            foreach ( $posts as $post ) {
                $list_posts[] = $this->get_blog_post($post);
            }
            return $list_posts;
        }
        return false;
    }

    public function get_blog_categories() {
        $categories = get_terms('category');

        foreach( $categories as $key => $category ) {
            if( $category->term_id == 1 ) {
                unset( $categories[ $key ] );
            }
        }

        return $categories;
    }

    public function get_post_categories( $post_id ) {
        $post_categories = wp_get_post_terms( $post_id, 'category' );
        foreach( $post_categories as $key => $category ) {
            if( $category->slug == 'sem-categoria' ) {
                unset( $post_categories[ $key ]);
            }
        }

        return $post_categories;
    }

    public function getPostMostViewed() {

        global $wpdb;

        $sql = "SELECT post_views.id, post_views.count AS views
        FROM " . $wpdb->prefix . "post_views as post_views
        INNER JOIN " . $wpdb->prefix . "posts as post ON post.ID = post_views.id AND post.post_status = 'publish'
        WHERE post_views.type = 4 ORDER by post_views.count DESC";

        $post = $wpdb->get_results($sql, OBJECT);

        if(count($post) > 0) {
            for ($i = 0; $i < 6; $i++) {

                $post_list[] = $this->get_blog_post( get_post($post[$i]->id) );
            }
        } else {
            $post_list = false;
        }

        return $post_list;

    }

    public function getPostViewedHome() {

        global $wpdb;

        $sql = "SELECT post_views.id, post_views.count AS views
        FROM " . $wpdb->prefix . "post_views as post_views
        INNER JOIN " . $wpdb->prefix . "posts as post ON post.ID = post_views.id AND post.post_status = 'publish'
        WHERE post_views.type = 4 ORDER by post_views.count DESC";

        $post = $wpdb->get_results($sql, OBJECT);

        if(count($post) > 0) {
            for ($i = 3; $i < 7; $i++) {

                $post_list[] = $this->get_blog_post( get_post($post[$i]->id) );
            }
        } else {
            $post_list = false;
        }

        return $post_list;

    }

    public function getPostViewedFullHome()
    {
        global $wpdb;

        $sql = "SELECT post_views.id, post_views.count AS views
        FROM " . $wpdb->prefix . "post_views as post_views
        INNER JOIN " . $wpdb->prefix . "posts as post ON post.ID = post_views.id AND post.post_status = 'publish'
        WHERE post_views.type = 4 ORDER by post_views.count DESC";

        $post = $wpdb->get_results($sql, OBJECT);

        if(isset($post[2]->id))
            $post = $this->get_blog_post( get_post($post[2]->id) );
        else
            $post = false;

        return $post;
    }

    public function getPostViewedSidebarLeft()
    {
        global $wpdb;

        $sql = "SELECT post_views.id, post_views.count AS views
        FROM " . $wpdb->prefix . "post_views as post_views
        INNER JOIN " . $wpdb->prefix . "posts as post ON post.ID = post_views.id AND post.post_status = 'publish'
        WHERE post_views.type = 4 ORDER by post_views.count DESC";

        $post = $wpdb->get_results($sql, OBJECT);

        if(isset($post[0]->id))
            $post = $this->get_blog_post( get_post($post[0]->id) );
        else
            $post = false;

        return $post;
    }

    public function getPostViewedSidebarRight()
    {
        global $wpdb;

        $sql = "SELECT post_views.id, post_views.count AS views
        FROM " . $wpdb->prefix . "post_views as post_views
        INNER JOIN " . $wpdb->prefix . "posts as post ON post.ID = post_views.id AND post.post_status = 'publish'
        WHERE post_views.type = 4 ORDER by post_views.count DESC";

        $post = $wpdb->get_results($sql, OBJECT);

        if(isset($post[1]->id))
            $post = $this->get_blog_post( get_post($post[1]->id) );
        else
            $post = false;

        return $post;
    }

    public function getPostsByCategory() {
        global $wp_query;

        $tax = $wp_query->get_queried_object();

        $tax_query[] = array(
            'taxonomy' => $tax->taxonomy,
            'field'    => 'slug',
            'terms'    => $tax->slug
        );

        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => -1,
            'tax_query'         => $tax_query,
            'orderby'           => 'date',
            'order'             => 'DESC',
        );

        $posts = get_posts($args);
        if ( $posts ) {
            foreach ( $posts as $post ) {
                $list_posts[] = $this->get_blog_post($post);
            }
            return $list_posts;
        }
        return false;
    }

    public function getPosts($last_post = false){
        global $wp_query;

        $args = array(
            'post_type'         => 'post',
            // 'posts_per_page'    => -1,
            'paged'             => $wp_query->query['paged'],
            'orderby'           => 'date',
            'order'             => 'DESC'
        );

        if ( $last_post )
            $args['post__not_in'] = array($last_post);

        if ( isset($_GET['q']) )
            $args['s'] = strip_tags($_GET['q']);

        $posts = get_posts($args);
        if ( $posts ) {
            foreach ( $posts as $post ) {
                $list_posts[] = $this->get_blog_post($post);
            }
            return $list_posts;
        }
        return false;
    }

    public function getPostsHome(){
        global $wp_query;
        $posts_per_page = -1;
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => $posts_per_page
        );

        $posts = get_posts($args);
        if ( $posts ) {
            foreach ( $posts as $post ) {
                $list_posts[] = $this->get_blog_post($post);
            }
            return $list_posts;
        }
        return false;
    }



    public function getCoverFromImageID( $imageID, $width, $height, $crop = false ) {

        if ( $imageID  == '' ||  !$imageID  ) {
            return false;
        }

        $newImage = ImageFactory::create( $imageID , $width , $height, $crop );

        if (  ! $newImage->imageThumbnail ) {
            $newImage->imageThumbnail = $newImage->imageSrc;
        }

        return $newImage;
    }

    public function getCoverFromPost( $post ) {
        $thumbnailID  = get_post_thumbnail_id ( $post->ID );

        if ( $thumbnailID  == '' ||  !$thumbnailID  )
            return false;

        $newImage = ImageFactory::create( $thumbnailID , $this->widthCoverImage , $this->heightCoverImage, $this->coverCrop );

        if (  ! $newImage->imageThumbnail )
            $newImage->imageThumbnail = $newImage->imageSrc;

        return $newImage;
    }

    public function get_posts_related( $post_id, $taxonomy ) {

        $tax_query[] = array(
            'taxonomy'  => $taxonomy->taxonomy,
            'field'     => 'slug',
            'terms'     => $taxonomy->slug
        );

        $args = array(
            'post_type'         => 'post',
            'post_status'       => 'publish',
            'posts_per_page'    => 5,
            'post__not_in'      => array($post_id),
            'tax_query'         => $tax_query
        );
        $posts = get_posts($args);
        if ( $posts ) {
            foreach ( $posts as $post_op ) {
                $list_posts[] = $this->get_blog_post($post_op);
            }
            return $list_posts;
        }
        return false;
    }


}
