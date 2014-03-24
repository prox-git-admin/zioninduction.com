
			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'schoolfun' ); ?>
				</p>
			</div><!-- #comments -->
<?php
		return;
	endif;
?>

<?php
	
?>

<?php if ( have_comments() ) : ?>
	<h2 class="title-comment"><?php
	printf( _n( 'One Comment', '%1$s Comments', get_comments_number(), 'schoolfun' ),
	number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );?> on <span><?php the_title();?></span></h2>
	<ul id="list-comments">
		<?php wp_list_comments( array( 'callback' => 'schoolfun_comment' ) ); ?>
	</ul>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<div class="navigation">
					<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'schoolfun' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'schoolfun' ) ); ?></div>
					<div class="clear"></div>
				</div><!-- .navigation -->
	<?php endif; ?>
<?php else : 
	if ( ! comments_open() ) : ?>
		<p class="nocomments"><?php _e( '', 'schoolfun' ); // Comments are closed ?></p> 
	<?php endif; // end ! comments_open() ?>
<?php endif; // end have_comments() ?>
<?php
if ( null === $post_id )
		$post_id = $id;
	else
		$id = $post_id;
	$commenter = wp_get_current_commenter();

	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$fields =  array(
		'author' => '<label for="author">Name (required)</label>
		            <input id="author" name="author" type="text" class="input required" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" />',
		'email'  => '<label for="email">Email (required)</label>
		            <input id="email" name="email" type="text" class="input required email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" />',
		'url'    => '<label for="url">Website</label>' .
		            '<input id="url" name="url" type="text" class="input url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />',
	);

	$required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );
	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<label for="comment">' . _x( 'Comment', 'noun' ) . ' (required)</label><textarea id="comment" name="comment" cols="45" rows="8" class="input textarea required"></textarea><br/>',
		'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) . '</p>',
		'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
		'id_form'              => 'form-comment',
		'id_submit'            => 'submit',
		'title_reply'          => __( 'Leave a Reply' ),
		'title_reply_to'       => __( 'Leave a Reply to %s' ),
		'cancel_reply_link'    => __( 'Cancel reply' ),
		'label_submit'         => __( 'Post Comment' ),
	);

	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	?>
		<?php if ( comments_open() ) : ?>
			<?php do_action( 'comment_form_before' ); ?>
			<div id="respond" class="clearfix">
				<h2 id="reply-title" class="title-comment"><strong><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?></strong> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h2>
				<div class="clear"></div>
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo $args['must_log_in']; ?>
					<?php do_action( 'comment_form_must_log_in_after' ); ?>
				<?php else : ?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="clearfix">
					<div>
						<?php do_action( 'comment_form_top' ); ?>
						<?php if ( is_user_logged_in() ) : ?>
							<?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
							<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
						<?php else : ?>
							<?php echo $args['comment_notes_before']; ?>
							<?php
							do_action( 'comment_form_before_fields' );
							foreach ( (array) $args['fields'] as $name => $field ) {
								echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
							}
							do_action( 'comment_form_after_fields' );
							?>
						<?php endif; ?>
						<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>

						
							<input name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" class="button" />
							<?php comment_id_fields(); ?>					
						<?php do_action( 'comment_form', $post_id ); ?>
					</div>
					</form>
				<?php endif; ?>
			</div><!-- #respond -->
			<?php do_action( 'comment_form_after' ); ?>
		<?php else : ?>
			<?php do_action( 'comment_form_comments_closed' ); ?>
		<?php endif; ?>



</div>
