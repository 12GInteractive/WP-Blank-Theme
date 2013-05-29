<?php /* Template Name: Demo Page Template */ get_header(); ?>
	
	<!-- section -->
	<section role="main" class="columns six">
		<div class="test">THIS IS S ATEST</div>
	
		<h1><?php the_title(); ?></h1>
	
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
			<?php the_content(); ?>
			
		</article>
		<!-- /article -->
		
	<?php endwhile; ?>
	
	<?php else: ?>
	
		<!-- article -->
		<article>
			
			<h2><?php _e( 'Sorry, nothing to display.', 'vg' ); ?></h2>
			
		</article>
		<!-- /article -->
	
	<?php endif; ?>
	
	</section>
	<!-- /section -->
	
	<div class="columns four">
		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>