<?php

/**
 * The template for displaying all single wpdoodle - penguin theme required
 *
 */
wp_enqueue_script( "jquery" );
wp_enqueue_script( "WPdoodlez", plugins_url( 'WPdoodlez.js', __FILE__ ), array('jquery'), null, true);
wp_enqueue_style( "WPdoodlez", plugins_url( 'WPdoodlez.css', __FILE__ ), array(), null, 'all');
if(file_exists(dirname(__FILE__).'user.css')) {
    wp_enqueue_style( "WPdoodlez_user", plugins_url( 'user.css', __FILE__ ), array(), null, 'all');
}
get_header();
?>

<div id="content-area">
	<div id="primary">
    <main id="main" class="site-main" role="main">

        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();
            ?>
	
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php penguin_entry_top(); ?>
	<header class="entry-header">

	<div class="greybox">
	<?php
	$categories_list = get_the_category_list( esc_html__( ', ', 'penguin' ) );
	if ( $categories_list && penguin_categorized_blog() ) : ?>
		<i title="<?php esc_html_e( 'Categories icon', 'penguin' ) ?>" class="fa fa-folder-open"></i>
		<?php echo $categories_list; ?>
	<?php endif; // End if categories ?>

		<?php
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'penguin' ) );
		if ( $tags_list ) :
		?>
		&nbsp;<i title="<?php esc_html_e( 'Tags icon', 'penguin' ) ?>" class="fa fa-tag"></i>
		<?php echo '<span style="font-size:0.8em;">' . $tags_list .'</span>'; 
		endif; // End if $tags_list ?>
	</div>	
		
		<?php
		if ( has_post_thumbnail() == false ) :
		$category = get_the_category(); 
		if ( z_taxonomy_image_url($category[0]->term_id) != NULL ) {
			$cbild = z_taxonomy_image_url($category[0]->term_id);
			echo ('<div class="post-thumbnail"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">');
			echo ('<img src="' . $cbild . '" class="attachment-Penguin800X400 size-Penguin800X400 wp-post-image" style="max-height:220px" /></a></div>');	
		} else {
			$cbild = '';
     		echo ('<br>');
		}
		endif;
		?>

		<?php if ( has_post_thumbnail() ) : ?>
		<?php get_template_part( 'template-parts/the_post_thumbnail' ); ?>
		<?php endif; ?>

		<?php get_template_part( 'template-parts/meta', 'top' ); ?>
	
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
		?>
	</header><!-- .entry-header -->

					<div class="entry-content">
                    <?php
					/* translators: %s: Name of current post */
                    the_content();
                    $suggestions = $votes_cout  = [ ];
                    $customs     = get_post_custom( get_the_ID() );
                    foreach ( $customs as $key => $value ) {
                        if ( !preg_match( '/^_/is', $key ) ) {
                            $suggestions[ $key ] = $value;
                            $votes_cout[ $key ]  = 0;
                        }
                    }
                    // print_r($suggestions);
                    /* password protected? */
                    if ( !post_password_required() ) {
                        ?>
                        <h4><?php echo wpd_translate( 'Voting' ); ?></h4>
                        <table>
                            <thead>
                                <tr>
                                    <th><?php echo wpd_translate( 'User name' ); ?></th>
                                    <?php
                                        foreach ( $suggestions as $key => $value ) {
											if ($key != "post_views_count" && $key != "likes" ) {
	                                            ?><th><?php echo $key; ?></th><?php
											}	
                                        }
                                        ?>
                                    <th><?php echo wpd_translate( 'Manage vote' ); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $myname = $_COOKIE[ 'wpdoodlez-' . md5( AUTH_KEY . get_the_ID() ) ];
                                ?>
                                <tr id="wpdoodlez-form">
                                    <td><input type="text" 
                                               placeholder="<?php echo wpd_translate( 'Your name' ) ?>" 
                                               class="wpdoodlez-input"
                                               id="wpdoodlez-name" size="10"></td>
                                        <?php
                                        foreach ( $suggestions as $key => $value ) {
											if ($key != "post_views_count" && $key != "likes"  ) {
	                                            ?><td><label> <input type="checkbox" name="<?php echo $key; ?>" class="wpdoodlez-input">
                                        <?php
												echo $value[ 0 ]; ?></label>
                                        </td><?php
											}
                                    }
                                    ?><td>
                                        <button id="wpdoodlez_vote"><?php echo wpd_translate( 'Vote!' ); ?>
                                        </button></td><?php ?>
                                </tr>
                                <?php
                                $votes = get_option( 'wpdoodlez_' . md5( AUTH_KEY . get_the_ID() ), array() );
                                foreach ( $votes as $name => $vote ) {
                                    ?><tr id="<?php echo 'wpdoodlez_' . md5( AUTH_KEY . get_the_ID() ) . '-' . md5( $name ); ?>" 
                                            class="<?php echo $myname == $name ? 'myvote' : ''; ?>">
                                        <td><?php
                                            echo $name;
                                            ?></td>
                                        <?php
                                        foreach ( $suggestions as $key => $value ) {
											if ($key != "post_views_count" && $key != "likes") {
												?><td>
                                                    <?php
                                                    if ( $vote[ $key ] ) {
                                                        $votes_cout[ $key ] ++;
                                                        ?>
                                                    <label 
                                                        data-key="<?php echo $key; ?>"
                                                        ><?php echo $value[ 0 ]; ?></label><?php
                                                    } else {
                                                        ?>
                                                    <label></label><?php }
                                                    ?>
                                            </td><?php
	                                        }
										}	
                                        ?>
								<td><?php
                                            if ( current_user_can( 'delete_published_posts' ) ) {
                                                ?>
                                                <button class="wpdoodlez-delete" 
                                                        data-vote="<?php echo md5( $name ); ?>" 
                                                        data-realname="<?php echo $name; ?>"
                                                        ><?php echo wpd_translate( 'delete' ); ?></button><?php
                                                    }
                                                    if ( $myname == $name ) {
                                                        ?>
                                                <button class="wpdoodlez-edit" 
                                                        data-vote="<?php echo md5( $name ); ?>" 
                                                        data-realname="<?php echo $name; ?>"
                                                        ><?php echo wpd_translate( 'edit' ); ?></button><?php
                                            }
                                            ?></td>
                                    </tr><?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?php echo wpd_translate( 'total votes' ); ?></th>
                                    <?php
                                        foreach ( $votes_cout as $key => $value ) {
											if ($key != "post_views_count" && $key != "likes" ) {
	                                            ?><th id="total-<?php echo $key; ?>"><?php echo $value;  $pielabel.=$key.','; $piesum .= $value.','; ?></th><?php
											} }
                                        ?>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                        <?php
						// Chart Pie anzeigen zu den Ergebnissen
						$piesum = rtrim($piesum, ",");
						$pielabel = rtrim($pielabel, ",");
						if( class_exists( 'PB_ChartsCodes' ) ) {
							echo do_shortcode('[chartscodes title="Abstimm-Kuchengrafik" values="'.$piesum.'" labels="'.$pielabel.'" absolute="1"]');
						}	
					
					}
                    /* END password protected? */
                    ?>
                </div><!-- .entry-content -->

                <footer class="entry-footer">
    <?php // edit_post_link( wpd_translate( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
                </footer><!-- .entry-footer -->
                <script>
                    var wpdoodle_ajaxurl = '<?php echo admin_url( 'admin-ajax.php', is_ssl() ? 'https' : 'http' ); ?>';
                    var wpdoodle = '<?php echo md5( AUTH_KEY . get_the_ID() ); ?>';
                </script>
            </article>
            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
        // End the loop.
        endwhile;
        ?>
		
    </main><!-- .site-main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
</div><!-- #content-area -->
<?php get_footer(); ?>
