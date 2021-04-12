<?php
/* Template Name: Palestrantes */
defined( 'ABSPATH' ) || die;

global $post;
$last_id = false;

/* controllers */
$controllerPalestrantes = new Controller_Palestrantes();

$palestrantesPosts = $controllerPalestrantes->getPosts($last_id);

get_header();
?>
  <section id="programacao__fisol" class="section-padrao">

    <div class="container">

      <h2 class="titulo">
        ><span class="blink">_</span> Palestrantes
      </h2>

      <h3 class="subtitulo flsbs__aligncenter">
        Confira os Palestrantes.
      </h3>

    <?php if ( $palestrantesPosts ) : ?>
      <div class="row mt-5 mb-5 row-cols-1 row-cols-lg-3 g-4">
        <?php $counter = 1; ?>
        <?php foreach ( $palestrantesPosts as $palestrantes ) : ?>
        <?php
            $instagram = get_field('instagram_palestrante', $palestrantes->ID);
            $facebook = get_field('facebook_palestrante', $palestrantes->ID);
            $github = get_field('github_palestrante', $palestrantes->ID);
            $discord = get_field('dicord_palestrante', $palestrantes->ID);
            $linkedin = get_field('linkedin_palestrante', $palestrantes->ID);
        ?>
         <!-- ITEM -->
        <div class="col programacao__fisol-item palestrantes__fisol-item">
          <div class="card h-100">
            <img src='<?php echo $palestrantes->image_cover->imageThumbnail; ?>' class="card-img-top" alt='<?php echo $palestrantes->post_title; ?>'>

            <div class="card-body">
              <h2 class="card-title"><?php echo $palestrantes->post_title; ?></h2>

                <button class="btn btn-padrao" type="button" data-toggle="collapse" data-target="#palestrante<?php echo $counter; ?>" aria-expanded="false" aria-controls="palestrante<?php echo $counter; ?>">Ler Bio</button>

              <div class="collapse" id="palestrante<?php echo $counter; ?>">
                <p class="card-text"><?php echo ($palestrantes->excerpt); ?></p>
              </div>

            </div>
            <div class="card-footer">
                <h3><?php the_field('especialidade', $palestrantes->ID); ?></h3>
            </div>
            <div class="card-footer">
              <div>
                <p class="palestrante"><?php the_field('empresa', $palestrantes->ID); ?></p>
              </div>
            </div>
            <div class="card-footer">
                  <ul class="nav nav-pills">
                  <?php if($instagram): ?>
                    <li class="nav-item">
                      <a class="nav-link" href=<?php echo $instagram; ?> target="_blank">
                        <i class="fab fa-instagram"></i>
                        <span class="text-escondido">Instagram</span>
                      </a>
                    </li>
                    <?php endif; ?>
                    <?php if($facebook): ?>
                    <li class="nav-item">
                      <a class="nav-link" href=<?php echo $facebook; ?> target="_blank">
                        <i class="fab fa-facebook"></i>
                        <span class="text-escondido">Facebook</span>
                      </a>
                    </li>
                    <?php endif; ?>
                    <?php if($github): ?>
                    <li class="nav-item">
                      <a class="nav-link" href=<?php echo $github; ?> target="_blank">
                        <i class="fab fa-github-alt"></i>
                        <span class="text-escondido">Github</span>
                      </a>
                    </li>
                    <?php endif; ?>
                    <?php if($discord): ?>
                    <li class="nav-item">
                      <a class="nav-link" href=<?php echo $discord; ?> target="_blank">
                        <i class="fab fa-discord"></i>
                        <span class="text-escondido">Discord</span>
                      </a>
                    </li>
                    <?php endif; ?>
                    <?php if($linkedin): ?>
                    <li class="nav-item">
                      <a class="nav-link" href=<?php echo $linkedin; ?> target="_blank">
                        <i class="fab fa-linkedin-in"></i>
                        <span class="text-escondido">Linkedin</span>
                      </a>
                    </li>
                    <?php endif; ?>
                  </ul>
            </div>
          </div>
        </div>
        <?php $counter++; ?>
        <!-- FIM ITEM -->
        <?php endforeach; ?>
      </div>
      <?php endif; ?>


  </section>


<?php
    get_footer();
?>