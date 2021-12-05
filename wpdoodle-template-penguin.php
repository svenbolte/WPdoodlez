<?php
/**
 * The template for displaying all single wpdoodle - penguin theme required
 *
 */
wp_enqueue_script( "jquery" );
wp_enqueue_script( "WPdoodlez", plugins_url( 'WPdoodlez.js', __FILE__ ), array('jquery'), null, true);
wp_enqueue_style( "WPdoodlez", plugins_url( 'WPdoodlez.css', __FILE__ ), array(), null, 'all');
get_header();
?>
<div id="content-area">
	<div id="primary">
    <main id="main" class="site-main" role="main">
		<?php
		while ( have_posts() ) : the_post(); // Start the loop.	?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php penguin_entry_top();
			echo '<header class="entry-header">';
			$tcolor = get_theme_mod( 'link-color', '#006060' );
			$backgd = hexdec(substr($tcolor,1,2)).','.hexdec(substr($tcolor,3,2)).','.hexdec(substr($tcolor,5,2)).',.1';
			echo '<div class="entry-meta-top" style="background-color:rgba('.$backgd.')">';
			meta_icons(); 
			echo '</div>';
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
			echo '</header><!-- .entry-header -->';
			?>
			<div class="entry-content">
				<?php get_doodlez_content(); ?>
            </div><!-- .entry-content -->
			<footer class="entry-footer">
			</footer><!-- .entry-footer -->
			<script>
				var wpdoodle_ajaxurl = '<?php echo admin_url( 'admin-ajax.php', is_ssl() ? 'https' : 'http' ); ?>';
				var wpdoodle = '<?php echo md5( AUTH_KEY . get_the_ID() ); ?>';
			</script>
          </article>
		  <?php // If comments are open or we have at least one comment, load up the comment template.
		  if ( comments_open() || get_comments_number() ) comments_template();
		  setPostViews(get_the_ID());
		  // End the loop.
        endwhile; ?>
    </main><!-- .site-main -->
	</div><!-- #primary -->
<?php get_sidebar(); ?>
</div><!-- #content-area -->
<?php get_footer(); ?>
