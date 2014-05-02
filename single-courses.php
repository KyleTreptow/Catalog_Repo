<?php 

/**

 * Template Name: Courses Single View

 */ 



$dept = get_query_var( 'department_shortname' );
$deptterm = get_term_by( 'slug', $dept, 'department_shortname' );
$deptdesc = $deptterm->description;

$single=$double=false;

preg_match("/([A-Z]{2,4}) ([0-9]{3})(.{0,8})\. (.)* \(([0-9]|[0-9]\/[0-9]|[0-9]-[0-9])\)/", get_the_title() , $course_info);

if($course_info[3]== ""){		//Basic Class
	$course_title = strtolower($course_info[1]).'-'.$course_info[2];
	$single = true;
}
elseif(strpos($course_info[3], '/') !== false){		//Class with activity
	$double=$single= true;
	
	//In case of classes like PHYS220A and PHYS220AL
	$suffix = explode('/', $course_info[3]);
	
	$course_title = strtolower($course_info[1]).'-'.$course_info[2].$suffix[0];
	$activity_title = $course_title.$suffix[1];
}
elseif(strpos($course_info[3], '-') === false){	//All other classes that AREN'T A-F types
	$single = true;
	$course_title = strtolower($course_info[1]).'-'.$course_info[2].$course_info[3];
}
	

get_header(); ?>

<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<a class="dept-title-small" href="<?php echo get_csun_archive('courses', $dept); ?>">Courses</a>
					<a href="<?php echo get_csun_archive('departments', $dept); ?>"><h1 class="prog-title"><?php echo $deptdesc; ?></h1></a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div id="catalog-subnav">
					<ul class="clearfix">
						<li><a href="<?php echo get_csun_archive('departments', $dept); ?>">Overview</a></li>
						<li><a href="<?php echo get_csun_archive('programs', $dept); ?>">Programs</a></li>
						<li><a href="<?php echo get_csun_archive('faculty', $dept); ?>">Faculty</a></li>
						<li class="active"><a href="<?php echo get_csun_archive('courses', $dept); ?>">Courses</a><div class="arrow-wrap"><span class="subnav-arrow"></span></div></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-title-wrap">
				<a class="no-line" href="<?php the_permalink(); ?>"><h2 class="inner-title dark"><span class="red">Course:</span> <?php the_title(); ?></h2></a>
				<div class="row">
					<div id="breadcrumbs-wrap" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<span><?php echo the_breadcrumb(); ?></span>
					</div>
				</div>
			</div>
			<div class="pad-box">
				<div id="inset-content">
				<?php if(have_posts()): while (have_posts()) : the_post(); ?>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="section-content">
								<div class="row">
									<?php the_content();?>
								</div>
								<?php if($single): ?>
								<div class="row">
									<h6 id="course-header"></h6>
									<table class="csun-table" id="class-info" summary="Class sections"><tbody>
										<tr><th>Course Number</th><th>Location</th><th>Day</th><th>Time</th><tr>
									</tbody></table>
								</div>
									
								<?php if($double) : ?>
								<div class="row">
									<h6 id="activity-header"></h6>
									<table class="csun-table" id="activity-info" summary="Activity sections"><tbody>
										<tr><th>Class Number</th><th>Location</th><th>Day</th><th>Time</th><tr>
									</tbody></table>
								</div>
								<?php endif; ?>
							</div>
								
								<script>
									/**
									 * Course Information Request
									 *
									 * Requests information in JSON format from OMAR via AJAX 
									 *
									 * Formats and displays the information in a table
									 */
									(function($) { 
									   $(document).ready(function(){
										  $.ajax({
											   url: "http://curriculum.ptg.csun.edu/classes/<?php echo $course_title; ?>",
											   type: 'get',
											   cache: 'false',
											   dataType: 'json',
											   success: function(data_back){
													var html = "";
													var title;
													var data = data_back.data;
													var meeting;
													
													if(data.length<1){
														html = '<tr><td colspan="4">No sections offered this semester</td></tr>'
													}
													else{
														title = data[0].subject+' '+data[0].catalog_number+' - '+data[0].title+' -- '+data[0].term;
														
														// run through the data and add it to the final markup
														 $(data).each(function(){
															meeting = this.class_meeting;
															var day = meeting.days;
															var start = meeting.start_time;
															var end = meeting.end_time;
															
															day = day.replace("ARR", "ONLINE");
															day = day.replace("M", "Mo");
															day = day.replace("T", "Tu");
															day = day.replace("W", "We");
															day = day.replace("R", "Th");
															day = day.replace("F", "Fr");
															day = day.replace("S", "Sa");
															
															start = start.slice(0,2)+':'+start.slice(2,4);
															end = end.slice(0,2)+':'+end.slice(2,4);
															
															// this is not processing
															html += '<tr><td>'+this.class_number+'</td><td>'+meeting.location+'</td><td>'+day+'</td><td>'+start+'-'+end+'</td><tr>';
														 });
													}
													
													 $("#class-info").append(html);
													 $("#course-header").html(title);
												}
											});
											
											<?php if($double) : ?>
											$.ajax({
											   url: "http://curriculum.ptg.csun.edu/classes/<?php echo $activity_title; ?>",
											   type: 'get',
											   cache: 'false',
											   dataType: 'json',
											   success: function(data_back){
													var html = "";
													var title;
													var data = data_back.data;
													var meeting;
													
													if(data.length<1){
														html = '<tr><td colspan="4">No sections offered this semester</td></tr>'
													}
													else{
														title = data[0].subject+' '+data[0].catalog_number+' - '+data[0].title+' -- '+data[0].term;
													
														// run through the data and add it to the final markup
														 $(data).each(function(){
															meeting = this.class_meeting;
															var day = meeting.days;
															var start = meeting.start_time;
															var end = meeting.end_time;
															
															day = day.replace("ARR", "ONLINE");
															day = day.replace("M", "Mo");
															day = day.replace("T", "Tu");
															day = day.replace("W", "We");
															day = day.replace("R", "Th");
															day = day.replace("F", "Fr");
															day = day.replace("S", "Sa");
															
															start = start.slice(0,2)+':'+start.slice(2,4);
															end = end.slice(0,2)+':'+end.slice(2,4);
															
															// this is not processing
															html += '<tr><td>'+this.class_number+'</td><td>'+meeting.location+'</td><td>'+day+'</td><td>'+start+'-'+end+'</td><tr>';
														 });
													}
													
													 $("#activity-info").append(html);
													 $("#activity-header").append(title);
												}
											});
											<?php endif; ?>
									   });
									})(jQuery);
								</script>							
						</div>
						<?php endif; ?>
					</div>
				<?php endwhile; endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>


<?php get_footer(); ?>