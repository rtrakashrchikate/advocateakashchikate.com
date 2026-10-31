<?php
/**
 * Blog Index / Fallback Template
 */
get_header();
?>

<section class="page-hero">
  <div class="page-hero-grid"></div>
  <div class="container">
    <div class="page-hero-content">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
        <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
        <span class="current"><?php is_home() ? bloginfo( 'name' ) : the_archive_title(); ?></span>
      </nav>
      <h1><?php is_home() ? _e( 'Legal <span>Insights</span>', 'akashchikate' ) : the_archive_title(); ?></h1>
      <p class="page-desc">Practical legal knowledge to help you understand your rights and options in criminal, family, and corporate matters.</p>
    </div>
  </div>
</section>

<section class="section-py section-white">
  <div class="container">
    <?php if ( have_posts() ) : ?>
      <div class="blog-grid">
        <?php $i = 0; while ( have_posts() ) : the_post(); ?>
          <?php
          $cat      = get_the_category();
          $cat_name = $cat ? $cat[0]->name : 'Legal';
          $icons    = [ 'fa-gavel', 'fa-shield-halved', 'fa-wifi', 'fa-house-heart', 'fa-building-columns' ];
          $ico      = $icons[ $i % 5 ];
          ?>
          <a href="<?php the_permalink(); ?>" class="blog-card reveal">
            <div class="blog-img-wrap">
              <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'medium', [ 'style' => 'width:100%;height:100%;object-fit:cover;' ] ); ?>
              <?php else : ?>
                <div style="width:100%; height:100%; background:linear-gradient(135deg,#0d1b3e,#1a2f5a); display:flex; align-items:center; justify-content:center;">
                  <i class="fa-solid <?php echo esc_attr( $ico ); ?>" style="font-size:3rem; color:rgba(201,160,48,0.4);"></i>
                </div>
              <?php endif; ?>
              <span class="blog-category"><?php echo esc_html( $cat_name ); ?></span>
            </div>
            <div class="blog-body">
              <div class="blog-meta">
                <span><i class="fa-regular fa-calendar"></i> <?php echo get_the_date( 'M j, Y' ); ?></span>
                <span><i class="fa-regular fa-clock"></i> <?php echo ceil( str_word_count( get_the_content() ) / 200 ); ?> min read</span>
              </div>
              <h3><?php the_title(); ?></h3>
              <p><?php echo wp_trim_words( get_the_excerpt(), 18 ); ?></p>
              <span class="blog-read-more">Read Article <i class="fa-solid fa-arrow-right"></i></span>
            </div>
          </a>
        <?php $i++; endwhile; ?>
      </div>

      <div style="text-align:center; margin-top:3rem;">
        <?php the_posts_pagination( [ 'mid_size' => 2 ] ); ?>
      </div>

    <?php else : ?>
      <div style="text-align:center; padding:4rem 0;">
        <i class="fa-solid fa-pen-to-square" style="font-size:3rem; color:var(--gold); margin-bottom:1rem;"></i>
        <h3 style="color:var(--navy);">Legal insights coming soon.</h3>
        <p style="color:var(--gray-600);">Check back soon — we'll be publishing practical legal guides here.</p>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
