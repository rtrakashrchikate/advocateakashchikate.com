<?php
/**
 * Default Page Template
 */
get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

<section class="page-hero">
  <div class="page-hero-grid"></div>
  <div class="container">
    <div class="page-hero-content">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
        <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
        <span class="current"><?php the_title(); ?></span>
      </nav>
      <h1><?php the_title(); ?></h1>
    </div>
  </div>
</section>

<section class="section-py section-white">
  <div class="container" style="max-width:800px;">
    <div class="article-body" style="line-height:1.9; font-size:1rem; color:var(--gray-600);">
      <?php the_content(); ?>
    </div>
  </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
