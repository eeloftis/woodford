<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package BookMe Theme
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'bookme' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( esc_html__( 'Older posts', 'bookme' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( esc_html__( 'Newer posts', 'bookme' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'bookme_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function bookme_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>

	<div class="bookme-paginate content-post">		
		<nav class="navigation post-navigation">
			<ul class="pager">
				<?php
					previous_post_link( '<li class="previous nav-previous">%link</li>', '<span class="lnr lnr-arrow-left"></span>' );
					next_post_link( '<li class="next nav-next">%link</li>', '<span class="lnr lnr-arrow-right"></span>' );
				?>
			</ul>
			<ul class="pager">
				<?php
					previous_post_link( '<li class="previous nav-previous"><div class="title"><h4>%link</h4></div></li>', '%title' );
					next_post_link( '<li class="next nav-next"><div class="title"><h4>%link</h4></div></li>', '%title' );
				?>
			</ul>
		</nav>
	</div>

	<?php
}
endif;

if ( ! function_exists( 'bookme_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function bookme_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'bookme' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'bookme' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'bookme_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function bookme_entry_footer() {
	// Hide category and tag text for pages.
	edit_post_link( esc_html__( 'Edit', 'bookme' ), '<span class="edit-link">', '</span>' );
	echo '<div class="clearfix"></div>';
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( esc_html__( 'Category: %s', 'bookme' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( esc_html__( 'Tag: %s', 'bookme' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( esc_html__( 'Author: %s', 'bookme' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( esc_html__( 'Year: %s', 'bookme' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'bookme' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( esc_html__( 'Month: %s', 'bookme' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'bookme' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( esc_html__( 'Day: %s', 'bookme' ), get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'bookme' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = esc_html_x( 'Asides', 'post format archive title', 'bookme' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = esc_html_x( 'Galleries', 'post format archive title', 'bookme' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = esc_html_x( 'Images', 'post format archive title', 'bookme' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = esc_html_x( 'Videos', 'post format archive title', 'bookme' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = esc_html_x( 'Quotes', 'post format archive title', 'bookme' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = esc_html_x( 'Links', 'post format archive title', 'bookme' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = esc_html_x( 'Statuses', 'post format archive title', 'bookme' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = esc_html_x( 'Audio', 'post format archive title', 'bookme' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = esc_html_x( 'Chats', 'post format archive title', 'bookme' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( esc_html__( 'Archives: %s', 'bookme' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( esc_html__( '%1$s: %2$s', 'bookme' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = esc_html__( 'Archives', 'bookme' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;  // WPCS: XSS OK.
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;  // WPCS: XSS OK.
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function bookme_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'bookme_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'bookme_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so bookme_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so bookme_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in bookme_categorized_blog.
 */
function bookme_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'bookme_categories' );
}
add_action( 'edit_category', 'bookme_category_transient_flusher' );
add_action( 'save_post',     'bookme_category_transient_flusher' );


if ( !function_exists('bookme_related') ) {
	function bookme_related() {
		global $post;
		$orig_post = $post;
    	
    	$tags = wp_get_post_tags($post->ID);
     
    	if ($tags) {
    		$tag_ids = array();
			foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
    		$args=array(
    			'tag__in' => $tag_ids,
    			'post__not_in' => array($post->ID),
    			'posts_per_page'=>2, // Number of related posts to display.
    			'ignore_sticky_posts'=>1
    		);
     
    		$my_query = new wp_query( $args );
    		if ( $my_query->have_posts() ) :
    			echo '<div class="related-post content-post"><div class="title"><h3>' . esc_attr( __('Related posts', 'bookme') ) . '</h3></div><div class="row">'; 
 
    			while( $my_query->have_posts() ) {
    				$my_query->the_post(); ?>
    				    <div class="col-md-6">
							<div class="post-media">
								<?php 
									if ( has_post_thumbnail() ) {
										the_post_thumbnail('bookme_related_thumbnail'); 
									} else {
										echo '<img src="http://lorempixel.com/360/162/">';
									}
								?>
							</div>
							<div class="title"><h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5></div>
							<div class="post-cat"><?php echo esc_html__('IN', 'bookme'); ?> <?php bookme_post_cat(); ?></div>
						</div><?php 
				}
				$post = $orig_post;
    			wp_reset_postdata(); 
    			    		
    			echo '</div></div>';
    		endif;
    	}
	}
}

if ( !function_exists('bookme_post_tag') ) {
	function bookme_post_tag() {
		$posttags = get_the_tags();
		$count=0;
		if ($posttags) {
		 		foreach($posttags as $tag) {
		   		$count++;
		   		if (1 == $count) {
		   			echo '<div class="small-title"><h4><a href="'. get_tag_link($tag->term_id) .'">' . $tag->name . '</a></h4></div>';
		   		}
			}
		}
	}
}

if ( !function_exists('bookme_post_cat') ) {
	function bookme_post_cat() {
		$categories = '';
		if ( is_singular('post') || is_home() && ! is_front_page() ) $categories = get_the_terms( get_the_ID(), 'category' );
		if ( is_page_template('template-portfolio.php') || is_singular('bookme_portfolio') ) $categories = get_the_terms(get_the_ID(), 'portfolio_category'); 
		$separator = ', ';
		$output = '';
		if ( ! empty( $categories ) ) {
    		foreach( $categories as $category ) {
    		$term_url = get_term_link( $category );
        		$output .= '<a href="' . $term_url . '">' . esc_html( $category->name ) . '</a>' . $separator;
    		}
    		echo trim( $output, $separator );
		}
	}
}

if ( !function_exists('bookme_post_meta') ) {
	function bookme_post_meta() { ?>
		<div class="post-meta">
			<ul>
				<li><?php echo esc_html__('on: ', 'bookme'); ?><a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d')); ?>"><?php the_time('F j, Y'); ?></a></li>
				<li><?php echo bookme_comments_number(); ?></li>
				<li><?php echo esc_html__('Posted by: ', 'bookme'); ?><?php the_author_posts_link(); ?></li>
				<li><?php echo esc_html__('in ', 'bookme'); ?><?php bookme_post_cat(); ?></li>
			</ul>
		</div><?php
	}
}

if ( !function_exists('bookme_comments_number') ) {
	function bookme_comments_number() {
		$num_comments = get_comments_number(); // get_comments_number returns only a numeric value

		if ( comments_open() ) {
			if ( $num_comments == 0 ) {
				$comments = __('No Comments', 'bookme');
			} elseif ( $num_comments > 1 ) {
				$comments = '<a href="' . get_comments_link() .'">'. $num_comments .'</a>'. __(' Comments', 'bookme');
			} else {
				$comments = '<a href="' . get_comments_link() .'">1</a>'. __(' Comment', 'bookme');
			}
			$write_comments = $comments;
		} else {
			$write_comments =  __('Comments are off for this post.', 'bookme');
		}
		return $write_comments;
	}
}

if ( !function_exists('bookme_author_info') ) {
	function bookme_author_info() { ?>
		<div class="content-post">
			<div class="comment-author">
				<div class="row">
					<div class="col-md-3">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'bookme_author_bio_avatar_size', 150 ) ); ?>
					</div>
					<div class="col-md-9">
						<h3><?php echo get_the_author(); ?> <span><?php echo esc_html__('(Author)', 'bookme'); ?></span></h3> 
						<p><?php echo the_author_meta('description'); ?></p>
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="btn btn-one">View Post</a>
					</div>
				</div>
			</div>
		</div><?php 
	}
}


if ( !function_exists('bookme_more_link') ) { 
	function bookme_more_link() {
		return '<a class="more-link btn btn-one" href="' . get_permalink() . '">' . __('Read More', 'bookme') . '</a>';
	}
}
add_filter( 'the_content_more_link', 'bookme_more_link' );

function bookme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP); ?>
	
	<li <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<article id="div-comment-1" class="comment-body">
		<footer class="comment-meta">
			<div class="comment-author vcard">
				<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
				<?php printf( __( '<b class="fn">%s</b> ', 'bookme' ), get_comment_author_link() ); ?>
			
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'bookme' ); ?></em>
					<br />
				<?php endif; ?>
				<div class="comment-meta comment-metadata"><?php echo esc_html__('On: ', 'bookme'); ?><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
					<?php printf( __('%1$s &nbsp;', 'bookme'), get_comment_date() ); ?></a> <?php printf( __('%1$s', 'bookme'), get_comment_time() ); ?>
					</a><?php edit_comment_link( __( '(Edit)', 'bookme' ), '  ', '' );	?>
				</div>
			</div>

			<?php comment_text(); ?>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
	</article>
	</li><?php
}


function bookme_excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt);
	} else {
		$excerpt = implode(" ",$excerpt);
	}	
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	return $excerpt;
	}
     
function bookme_content($limit) {
	$content = explode(' ', get_the_content(), $limit);
	if (count($content)>=$limit) {
		array_pop($content);
		$content = implode(" ",$content);
	} else {
		$content = implode(" ",$content);
	}	
	$content = preg_replace('/\[.+\]/','', $content);
	$content = apply_filters('the_content', $content); 
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}
