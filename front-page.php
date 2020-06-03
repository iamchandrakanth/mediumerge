<?php get_header() ; ?>

<div class="mainheading">
	<h1 class="sitetitle"><?php echo bloginfo( 'name' ); ?></h1>
	<p class="lead">
				 <?php echo bloginfo( 'description' ); ?>
	</p>
</div>

	<!-- Begin Featured
	================================================== -->
	<section class="featured-posts">
	<div class="section-title">
		<h2><span>Featured</span></h2>
	</div>
	<div class="card-columns listfeaturedtag">
	
	<?php
  		$args = array(
        'posts_per_page' => 4,
        'meta_key' => 'meta-checkbox',
        'meta_value' => 'yes'
    );
    $featured = new WP_Query($args);
 
	if ($featured->have_posts()): while($featured->have_posts()) : $featured->the_post(); ?>

		<!-- begin post -->
		<div class="card">
			<div class="row">
				<div class="col-md-5 wrapthumbnail">
					<a href="<?php the_permalink(); ?>">
						<div class="thumbnail" style="background-image:url(
							<?php if (has_post_thumbnail()) {
								echo get_the_post_thumbnail_url($post_id); } 
								else echo get_theme_file_uri('/assets/img/demopic/bg.jpg')?>
							);">
						</div>
					</a>
				</div>
				<div class="col-md-7">
					<div class="card-block">
						<h2 class="card-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 12); ?></a></h2>
						<h4 class="card-text"><?php echo wp_trim_words(get_the_content(), 24) ?></h4>
						<div class="metafooter">
							<div class="wrapfooter">
								<span class="meta-footer-thumb">
								<a href="/author/<?php echo get_the_author_link() ?>"><img class="author-thumb" src="<?php echo get_avatar_url($author->ID, 150); ?>" alt="Author"></a>
								</span>
								<span class="author-meta">
								<span class="post-name"><a href="/author/<?php echo get_the_author_link() ?>"><?php echo get_the_author(); ?></a></span><br/>
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
	<?php
	endwhile; 
	endif; 
	?>	

	</div>
	</section>
	<!-- End Featured
	================================================== -->

	<!-- Begin List Posts
	================================================== -->
	<section class="recent-posts">
	<div class="section-title">
		<h2><span>All Stories</span></h2>
	</div>
	<div class="card-columns listrecent">
	<?php 
	while(have_posts()) {
		the_post(); ?>
		<!-- begin post -->
		<div class="card">
			<a href="<?php the_permalink(); ?>">
				<img class="img-fluid" src="<?php if (has_post_thumbnail()) {
								echo get_the_post_thumbnail_url($post_id); } 
								else echo get_theme_file_uri('/assets/img/demopic/bg.jpg')?>" alt="">
			</a>
			<div class="card-block">
				<h2 class="card-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 12); ?></a></h2>
				<h4 class="card-text"><?php echo wp_trim_words(get_the_content(), 24) ?></h4>
				<div class="metafooter">
					<div class="wrapfooter">
						<span class="meta-footer-thumb">
						<a href="/author/<?php echo get_the_author_link() ?>"><img class="author-thumb" src="<?php echo get_avatar_url($author->ID, 150); ?>" alt="Author"></a>
						</span>
						<span class="author-meta">
						<span class="post-name"><a href="#"><?php the_author_posts_link(); ?></a></span><br/>
						<span class="post-date"><?php the_time('d F Y'); ?></span><span class="dot"></span><span class="post-read"><?php echo reading_time(); ?> read</span>
						</span>
						<span class="post-read-more"><a href="<?php the_permalink(); ?>" title="Read Story"><svg class="svgIcon-use" width="25" height="25" viewbox="0 0 25 25"><path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path></svg></a></span>
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
	<!-- End List Posts
	================================================== -->
	
	<?php get_footer(); 

 ?>