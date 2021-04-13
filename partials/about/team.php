<?php
defined( 'ABSPATH' ) || die;

global $post;
$last_id = false;

$controllerTeam = new Controller_Equipe();

$teamPost = $controllerTeam->getPosts($last_id);

?>

<section id="sobre__equipe" class="section-padrao pb-5">

    <div class="container">

        <h2 class="titulo">
        ><span class="blink">_</span> Nossa Equipe
        </h2>
        <h3 class="subtitulo">
        Conheça a equipe do FliSol São Bento do Sul
        </h3>

        <?php if ( $teamPost ): ?>
        <div class="row mt-5 pt-5">
            <?php foreach ( $teamPost as $member ) : ?>
            <?php
                $facebook = get_field('facebook_membro', $member->ID);
                $instagram = get_field('instagram_membro', $member->ID);
                $twitter = get_field('twitter_membro', $member->ID);
                $github = get_field('github_membro', $member->ID);
                $linkedin = get_field('linkedin_membro', $member->ID);
            ?>
            <div class="col-6 col-lg-3 p-5">
                <div class="our-team">
                    <div class="pic">
                        <img src='<?php echo $member->image_cover->imageThumbnail; ?>' alt='<?php echo $member->post_title; ?>'>
                    </div>
                    <div class="team-content">
                        <h3 class="title"><?php echo $member->post_title; ?></h3>
                        <span class="post"><?php the_field('especialidade_empresa_mebro', $member->ID); ?></span>
                        <ul class="social">


                            <?php if ($facebook): ?>
                            <li><a href="<?php echo $facebook; ?>" class="fab fa-facebook" target="_blank"></a></li>
                            <?php endif; ?>
                            <?php if ($instagram): ?>
                            <li><a href="<?php echo $instagram; ?>" class="fab fa-instagram" target="_blank"></a></li>
                            <?php endif; ?>
                            <?php if ($twitter): ?>
                            <li><a href="<?php echo $twitter; ?>" class="fab fa-twitter" target="_blank"></a></li>
                            <?php endif; ?>
                            <?php if ($github): ?>
                            <li><a href="<?php echo $github; ?>" class="fab fa-github" target="_blank"></a></li>
                            <?php endif; ?>
                            <?php if ($linkedin): ?>
                            <li><a href="<?php echo $linkedin; ?>" class="fab fa-linkedin-in" target="_blank"></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
        <?php endif; ?>

    </div>

</section>