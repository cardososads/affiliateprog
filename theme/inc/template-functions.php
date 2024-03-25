<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package AffiliateProg
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function affiliateprog_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'affiliateprog_pingback_header' );

/**
 * Changes comment form default fields.
 *
 * @param array $defaults The default comment form arguments.
 *
 * @return array Returns the modified fields.
 */
function affiliateprog_comment_form_defaults( $defaults ) {
	$comment_field = $defaults['comment_field'];

	// Adjust height of comment form.
	$defaults['comment_field'] = preg_replace( '/rows="\d+"/', 'rows="5"', $comment_field );

	return $defaults;
}
add_filter( 'comment_form_defaults', 'affiliateprog_comment_form_defaults' );

/**
 * Filters the default archive titles.
 */
function affiliateprog_get_the_archive_title() {
	if ( is_category() ) {
		$title = __( 'Category Archives: ', 'affiliateprog' ) . '<span>' . single_term_title( '', false ) . '</span>';
	} elseif ( is_tag() ) {
		$title = __( 'Tag Archives: ', 'affiliateprog' ) . '<span>' . single_term_title( '', false ) . '</span>';
	} elseif ( is_author() ) {
		$title = __( 'Author Archives: ', 'affiliateprog' ) . '<span>' . get_the_author_meta( 'display_name' ) . '</span>';
	} elseif ( is_year() ) {
		$title = __( 'Yearly Archives: ', 'affiliateprog' ) . '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'affiliateprog' ) ) . '</span>';
	} elseif ( is_month() ) {
		$title = __( 'Monthly Archives: ', 'affiliateprog' ) . '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'affiliateprog' ) ) . '</span>';
	} elseif ( is_day() ) {
		$title = __( 'Daily Archives: ', 'affiliateprog' ) . '<span>' . get_the_date() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$cpt   = get_post_type_object( get_queried_object()->name );
		$title = sprintf(
			/* translators: %s: Post type singular name */
			esc_html__( '%s Archives', 'affiliateprog' ),
			$cpt->labels->singular_name
		);
	} elseif ( is_tax() ) {
		$tax   = get_taxonomy( get_queried_object()->taxonomy );
		$title = sprintf(
			/* translators: %s: Taxonomy singular name */
			esc_html__( '%s Archives', 'affiliateprog' ),
			$tax->labels->singular_name
		);
	} else {
		$title = __( 'Archives:', 'affiliateprog' );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'affiliateprog_get_the_archive_title' );

/**
 * Determines whether the post thumbnail can be displayed.
 */
function affiliateprog_can_show_post_thumbnail() {
	return apply_filters( 'affiliateprog_can_show_post_thumbnail', ! post_password_required() && ! is_attachment() && has_post_thumbnail() );
}

/**
 * Returns the size for avatars used in the theme.
 */
function affiliateprog_get_avatar_size() {
	return 60;
}

/**
 * Create the continue reading link
 *
 * @param string $more_string The string shown within the more link.
 */
function affiliateprog_continue_reading_link( $more_string ) {

	if ( ! is_admin() ) {
		$continue_reading = sprintf(
			/* translators: %s: Name of current post. */
			wp_kses( __( 'Continue reading %s', 'affiliateprog' ), array( 'span' => array( 'class' => array() ) ) ),
			the_title( '<span class="sr-only">"', '"</span>', false )
		);

		$more_string = '<a href="' . esc_url( get_permalink() ) . '">' . $continue_reading . '</a>';
	}

	return $more_string;
}

// Filter the excerpt more link.
add_filter( 'excerpt_more', 'affiliateprog_continue_reading_link' );

// Filter the content more link.
add_filter( 'the_content_more_link', 'affiliateprog_continue_reading_link' );

/**
 * Outputs a comment in the HTML5 format.
 *
 * This function overrides the default WordPress comment output in HTML5
 * format, adding the required class for Tailwind Typography. Based on the
 * `html5_comment()` function from WordPress core.
 *
 * @param WP_Comment $comment Comment to display.
 * @param array      $args    An array of arguments.
 * @param int        $depth   Depth of the current comment.
 */
function affiliateprog_html5_comment( $comment, $args, $depth ) {
	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

	$commenter          = wp_get_current_commenter();
	$show_pending_links = ! empty( $commenter['comment_author'] );

	if ( $commenter['comment_author_email'] ) {
		$moderation_note = __( 'Your comment is awaiting moderation.', 'affiliateprog' );
	} else {
		$moderation_note = __( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.', 'affiliateprog' );
	}
	?>
	<<?php echo esc_attr( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $comment->has_children ? 'parent' : '', $comment ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
					if ( 0 !== $args['avatar_size'] ) {
						echo get_avatar( $comment, $args['avatar_size'] );
					}
					?>
					<?php
					$comment_author = get_comment_author_link( $comment );

					if ( '0' === $comment->comment_approved && ! $show_pending_links ) {
						$comment_author = get_comment_author( $comment );
					}

					printf(
						/* translators: %s: Comment author link. */
						wp_kses_post( __( '%s <span class="says">says:</span>', 'affiliateprog' ) ),
						sprintf( '<b class="fn">%s</b>', wp_kses_post( $comment_author ) )
					);
					?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<?php
					printf(
						'<a href="%s"><time datetime="%s">%s</time></a>',
						esc_url( get_comment_link( $comment, $args ) ),
						esc_attr( get_comment_time( 'c' ) ),
						esc_html(
							sprintf(
							/* translators: 1: Comment date, 2: Comment time. */
								__( '%1$s at %2$s', 'affiliateprog' ),
								get_comment_date( '', $comment ),
								get_comment_time()
							)
						)
					);

					edit_comment_link( __( 'Edit', 'affiliateprog' ), ' <span class="edit-link">', '</span>' );
					?>
				</div><!-- .comment-metadata -->

				<?php if ( '0' === $comment->comment_approved ) : ?>
				<em class="comment-awaiting-moderation"><?php echo esc_html( $moderation_note ); ?></em>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div <?php affiliateprog_content_class( 'comment-content' ); ?>>
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
			if ( '1' === $comment->comment_approved || $show_pending_links ) {
				comment_reply_link(
					array_merge(
						$args,
						array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<div class="reply">',
							'after'     => '</div>',
						)
					)
				);
			}
			?>
		</article><!-- .comment-body -->
	<?php
}

// Redireciona usuários não logados para a página de login personalizada
function redirect_to_custom_login() {
	if (!is_user_logged_in() && !is_page_template('login.php')) {
		wp_redirect(home_url('/login/'));
		exit();
	}
}
add_action('template_redirect', 'redirect_to_custom_login');

// Redireciona usuários após o login
// Função para redirecionar usuários após o login
function redirect_after_login($redirect_to, $requested_redirect_to, $user) {

	$redirect_to = home_url();

	return $redirect_to;
}
add_filter('login_redirect', 'redirect_after_login', 10, 3);


// Redireciona usuários após o logout
function redirect_after_logout() {
	wp_redirect(home_url('/login/'));
	exit();
}
add_action('wp_logout', 'redirect_after_logout');
