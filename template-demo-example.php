<?php 
//
// Template Name: Demo Template 
//
get_header(); 
?>
	
	<section role="main">
	
		<?php $recent = new WP_Query("post_type=vehicles"); while($recent->have_posts()) : $recent->the_post();?>
			<?php the_title_attribute(); ?>
		<?php
			$image = get_post_meta( $post->ID, 'vehicle_photo', true ); 
			foreach( $image as $photo){
				$image_id = $photo['vehicle-photo'];
			}
			$attachment_image = wp_get_attachment_image_src( $image_id, 'full' ); 
			$src = $attachment_image[0]; 
			
			if( !empty( $src ) ) 		
				echo '<img src="'.$src.'"/>';



			$amenities = get_post_meta( $post->ID, 'vehicle_amenities', true ); 

			foreach( $amenities as $item){
				echo '<br />';
				echo $item['amenities-name'];
			}

		?>

		<?php endwhile;?>
	</section>
	

<?php get_footer(); ?>