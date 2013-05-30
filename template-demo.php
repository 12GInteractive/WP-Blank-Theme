<?php /* Template Name: Demo Page Template */ get_header(); ?>
	
	<!-- section -->
	<section role="main" class="columns six">

		<h1>This is just a simple header TEXT</h1>
		<h2>This is just a simple header TEXT</h2>
		<h3>This is just a simple header TEXT</h3>
		<h4>This is just a simple header TEXT</h4>
		<h5>This is just a simple header TEXT</h5>
		<p>For body copy won by a landslide. However, many of the designs avoid the high contrast of pure white on pure black; text color is often made a bit lighter than pure black. Designers clearly focus on legibility and avoid experimenting with background colors. The contrast of black on white is easy to read and is, at least among these websites, the status quo.</p>


	
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