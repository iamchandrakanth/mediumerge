<?php 
get_header(); ?>

<section class="featured-posts">
<div class="section-title">
	<h2><span><?php the_archive_title(); ?></span></h2>
	<span class="author-description"><?php the_archive_description(); ?></span>	
</div>
<div class="card-columns listfeaturedtag">
<?php 
while(have_posts()) {
		the_post(); ?>
	
	<!-- begin post -->
	<div class="card">
		<div class="row">
			<div class="col-md-5 wrapthumbnail">
				<a href="<?php the_permalink(); ?>">
					<div class="thumbnail" style="background-image:url(<?php if (has_post_thumbnail()) {
								echo get_the_post_thumbnail_url($post_id); } 
								else echo get_theme_file_uri('/assets/img/demopic/bg.jpg')?>);">
					</div>
				</a>
			</div>
			<div class="col-md-7">
				<div class="card-block">
					<h2 class="card-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 12); ?></a></h2>
					<h4 class="card-text"><?php echo wp_trim_words(get_the_content(), 28) ?></h4>
					<div class="metafooter">
						<div class="wrapfooter">
							<span class="meta-footer-thumb">
							<a href="/author/<?php echo get_the_author_link() ?>"><img class="author-thumb" src="<?php echo get_avatar_url($author->ID, 150); ?>" alt="Author"></a>
							</span>
							<span class="author-meta">
							<span class="post-name">By <a href="#"><?php the_author_posts_link(); ?></a> in <?php echo get_the_category_list(', ') ?></span><br/>
							<span class="post-date"><?php the_time('d F Y'); ?></span><span class="dot"></span><span class="post-read"><?php echo reading_time(); ?> read</span>
							</span>
							<span class="post-read-more"><a href="<?php the_permalink(); ?>" title="Read Story"><svg class="svgIcon-use" width="25" height="25" viewbox="0 0 25 25"><path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path></svg></a></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end post -->

<?php }
	echo paginate_links();
 ?>
</div>
</section>
<?php get_footer();
 ?>