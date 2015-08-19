<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && ! post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'jibber' ); ?></p>
	<?php else: ?>
		<iframe id="jibber-frame" width="100%" height="auto" src="http://www.jibber.social/comments?url=<?php the_permalink(); ?>" frameborder="0"></iframe>
	<? endif; ?>

</div><!-- .comments-area -->