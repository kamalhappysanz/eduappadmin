
<style>
.profile_detail{

}
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
                                      	Details
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane active" id="description-logo">
                                <div class="" style="border:none;box-shadow: none;">
																	<div class="row profile_detail card">
																	<div class="col-md-6" >
																		<?php $pic= $rows->profile_pic; if(empty($pic)){

																		} else{  ?>
																			<img src="<?php echo base_url(); ?>assets/teacher/profile/<?php echo $rows->profile_pic; ?>" class="img-responsive" style="width:150px;padding-top:20px;">

																	<?php 	}?>
																			</div>
																	<div class="col-md-6">
																		<div class="">
																			<p> Name :<?php echo $rows->name; ?></p>
																			<p> Gender :<?php echo $rows->sex; ?></p>
																			<p>Date Of Birth :<?php echo $rows->dob; ?></p>
																			<p> AGE :<?php echo $rows->age; ?></p>

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
																</div>
																<div class="header">
																		<h4 class="title">Secondary Email</h4>
																		<p class="category"><?php echo $rows->sec_email; ?></p>
																</div>
																	</div>
															<div class="col-md-6">
																<div class="header">
																		<h4 class="title">Phone Number</h4>
																		<p class="category"><?php echo $rows->phone; ?></p>
																</div>
																<div class="header">
																		<h4 class="title">Secondary Phone</h4>
																		<p class="category"><?php echo $rows->sec_phone; ?></p>
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
																	<p class="category"><a> <?php echo $rows->class_name; ?></a></p>
																</div>
																	</div>
															<div class="col-md-6">
																<div class="header">
																		<h4 class="title">Subject Handle</h4>
																		<p class="category"><?php echo $rows->subject_name; ?></p>
																</div>

															</div>
														</div>

                            </div>

                        </div> <!-- end tab content -->

                    </div> <!-- end col-md-8 -->

                </div>
							</div>
		  </div>




    </div>
