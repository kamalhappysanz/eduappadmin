
<style>
.fc-scroller{
	overflow-x: hidden;
	overflow-y: hidden;
}
.fc-ltr .fc-basic-view .fc-day-number{text-align: center;}
.fc-today-button,.fc-month-button,.fc-basicWeek-button,.fc-basicDay-button{display:none;}
.fc-month-button{display: none;}
</style>


	<div class="main-panel">

        <div class="content">
            <div class="container-fluid">
							<div class="card">
								<div class="row">

                    <div class="col-md-8 col-md-offset-2">
                        <h4 class="title text-center" style="padding-top:20px;">Personal Information</h4>
                        <br>
												<?php  foreach ($user_details as $rows) {
													# code...
												} ?>
                        <div class="nav-container" style="    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);">
                            <ul class="nav nav-icons" role="tablist">
                                <li class="active">
                                    <a href="#description-logo" role="tab" data-toggle="tab">
                                        <i class="fa fa-info-circle"></i><br>
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="#map-logo" role="tab" data-toggle="tab">
                                        <i class="fa fa-map-marker"></i><br>
                                        Location
                                    </a>
                                  </li>
                                <li class="">
                                    <a href="#legal-logo" role="tab" data-toggle="tab">
                                        <i class="fa fa-legal"></i><br>
                                        Contact
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#help-logo" role="tab" data-toggle="tab">
                                        <i class="fa fa-life-ring"></i><br>
                                      	Student Details
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane active" id="description-logo">
                                <div class="" style="border:none;box-shadow: none;">
																	<div class="row profile_detail card">
																	<div class="col-md-6" >
																		<?php $pic= $rows->father_pic; if(empty($pic)){

																		} else{  ?>
																			<img src="<?php echo base_url(); ?>assets/admission	/profile/<?php echo $rows->father_pic; ?>" class="img-responsive" style="width:150px;padding-top:20px;">

																	<?php 	}?>
																			</div>
																	<div class="col-md-6">
																		<div class="">
																			<?php if(empty($rows->guardn_name)){  ?>
																				<p> Father Name :<?php echo $rows->father_name; ?></p>
																				<p>  Mother name <span>:<?php echo $rows->mother_name; ?></span></p>
																		<?php	} else{  ?>

																			<p>  Mother name <span>:<?php echo $rows->guardn_name; ?></span></p>
																		<?php 	}?>


																		</div>
																	</div>
																</div>

                                </div>
                            </div>


                            <div class="tab-pane" id="map-logo">
															<div class="row profile_detail card">
															<div class="col-md-12" >
																<div class="header">
																		<h4 class="title">Address</h4>
																		<p class="category"><?php echo $rows->address; ?></p>
																</div>

																	</div>

														</div>
                            </div>


                            <div class="tab-pane" id="legal-logo">
															<div class="row profile_detail card">
															<div class="col-md-6" >
																<div class="header">
																		<h4 class="title">Primary Email</h4>
																		<p class="category"><?php echo $rows->email; ?></p>
																		<p class="category"><?php echo $rows->email1; ?></p>
																</div>

																	</div>
															<div class="col-md-6">
																<div class="header">
																		<h4 class="title">Phone Number</h4>
																		<p class="category"><?php echo $rows->mobile; ?></p>
																		<p class="category"><?php echo $rows->home_phone; ?></p>

																</div>

															</div>
														</div>
                            </div>

                            <div class="tab-pane" id="help-logo">
															<div class="row profile_detail card">
															<div class="col-md-6" >
																<div class="header">
																		  <h4 class="title">More information here</h4>

																</div>
																<div class="header">
																		<h6 class="title">Class Teacher </h6>
																	<p class="category"><a> <?php echo $rows->class_name; ?>-<?php echo $rows->sec_name; ?></a></p>
																</div>
																	</div>
															<div class="col-md-6">
																<div class="header">
																		<h4 class="title">Mother Tongue</h4>
																		<p class="category"><?php echo $rows->mother_tongue; ?></p>
																</div>

															</div>
														</div>

                            </div>

                        </div> <!-- end tab content -->

                    </div> <!-- end col-md-8 -->

                </div>
							</div>







    </div>


		<script>
		$(document).ready(function() {

			$('#dash').addClass('active');



		</script>
