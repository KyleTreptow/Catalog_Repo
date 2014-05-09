<?php /**

 * Template Name: Policies Archive View

 */ 

// $dept = get_query_var( 'department_shortname' );
// $deptterm = get_term_by( 'slug', $dept, 'department_shortname' );
// $deptdesc = $deptterm->description;

$perm = get_permalink();
$url = get_bloginfo( 'url' );
$order = get_query_var( 'orderby' );

get_header(); ?>



<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
				
				<?php if ($order === 'policy_categories' ) { ?>
				
					<a class="dept-title-small" href="<?php echo site_url('/policies/appendix/'); ?>">Policy Index</a>
					
				<?php } else if ( $order === 'title' ) { ?>
				
					<a class="dept-title-small" href="<?php echo site_url('/policies/alphabetical/'); ?>">Alphabetical</a>
					
				<?php } ?>
				
					<a href="<?php echo site_url('/policies/alphabetical/'); ?>"><h1 class="prog-title">Policies</h1></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="row">
			<div class="section-content">
				<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3 left-sidebar ">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix noborder">
						<span class="section-title"><span><h2>Categories</h2></span></span>
						<?php
						$terms = get_terms('policy_categories');
						if ( !empty( $terms ) && !is_wp_error( $terms ) ) : ?>
							<section id="policy-cats">
							<?php foreach ($terms as $term) : ?>
								<a href="<?php echo get_term_link( $term ); ?>" title="View all policies filed under <?php echo $term->name; ?>">
									<button type="button" class="btn btn-primary btn-sm">
										<?php echo $term->name; ?>
									</button>
								</a>
							<?php endforeach;?>
							</section>
						<?php endif; ?>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix noborder">
						<span class="section-title"><span><h2>Keywords</h2></span></span>
						<?php
						$terms = get_terms('policy_tags');
						if ( !empty( $terms ) && !is_wp_error( $terms ) ) : ?>
							<section id="policy-tags">
							<?php foreach ($terms as $term) : ?>
								<a href="<?php echo get_term_link( $term ); ?>" title="View all policies filed under <?php echo $term->name; ?>">
									<button type="button" class="btn btn-info btn-sm">
										<?php echo $term->name; ?>
									</button>
								</a>
							<?php endforeach;?>
							</section>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
				<?php 
				if(have_posts()): 

					if($order == 'policy_categories'):
						$terms = get_terms('policy_categories');

						foreach($terms as $term) :
							echo '<span class="section-title"><span><h2>' . $term->name .'</h2></span></span>';
							
							$query_policies = new WP_Query(array('post_type' => 'policies', 'orderby' => 'title', 'order' => 'ASC',  'policy_categories' => $term->slug, 'posts_per_page' => 1000,));
							
							if($query_policies->have_posts()) : while($query_policies->have_posts()) : $query_policies->the_post(); ?>
							
								<h3><a href="<?php the_permalink();?>"/><?php the_title(); ?></a></h3>

							<?php endwhile; endif; 
						endforeach;
						
						wp_reset_query(); ?> 

					<?php else: while (have_posts()) : the_post(); ?>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 small-marg-bottom clearfix">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</div>

					<?php endwhile; endif; ?>
					
				<?php else: ?>
						<p><?php _e('Sorry, no policies matched your criteria.'); ?></p>
				<?php endif; ?>

				</div>
			</div>
		</div>
	</div>
</div>


<?php get_footer(); ?>