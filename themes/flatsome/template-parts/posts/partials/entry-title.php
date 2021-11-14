
<?php
if ( is_single() ) {
	echo '<h1 class="entry-title">' . get_the_title() . '</h1>';
} else {
	echo '<h2 class="entry-title"><a href="' . get_the_permalink() . '" rel="bookmark" class="plain">' . get_the_title() . '</a></h2>';
}
?>
<div class="header-meta-info"><span class="fa fa-folder"></span><span><?php echo get_the_category_list( __( ', ', 'flatsome' ) ) ?></span><?php
$single_post = is_singular( 'post' );
if ( $single_post && get_theme_mod( 'blog_single_header_meta', 1 ) ) : ?><span class="fa fa-clock-o"></span><span><?php flatsome_posted_on(); ?></span><?php elseif ( ! $single_post && 'post' == get_post_type() ) : ?><span class="fa fa-clock-o"></span><span><?php flatsome_posted_on(); ?></span></div>


<?php endif; ?>
