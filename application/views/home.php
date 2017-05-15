<style>
.box{        padding: 12px 0px 66px 0px;

    border: 2px solid #9a8585;}
		.head-count{  text-align: center; border-bottom: 2px solid #9a8585;
    }
		.cnt{font-size: 20px;}
</style>
	<div class="main-panel">
        <div class="content">
					<div class="card">
            <div class="container-fluid">
							<h2>Admin Dashboard</h2>

							<br />

<div class="">
	<div class="row">
<div class="col-md-12">
	<div class="col-md-9">
	</div>
	<div class="col-md-3">
		<div class="box">
		<p class="head-count">Total Count</p>
		<br>
		<div class="col-md-6 text-center">
			<p class="cnt"><?php
			if(empty($res)){
				echo "No data";
			}else{
				foreach ($res as $user_to) {}
						echo $user_to->user_count;
			}
			 ?></p>

			<p><a href="">Students</a></p>

		</div>
		<div class="col-md-6 text-center">
			<p class="cnt"><?php
			if(empty($parents)){
				echo "No data";
			}else{
				foreach ($parents as $user_parents) {}
						echo $user_parents->user_count;
			}
			 ?><p>

			<p><a href="">Parents</a></p>

		</div>

	</div>
		<p></p>
	</div>
</div>
<hr>

<div class="col-md-12">
	<div class="col-md-4">
		<div class="card ">
                            <div class="header">
                                <h4 class="title">UpComing Events</h4>

                            </div>
                            <div class="content">
                                <div class="table-full-width">
                                    <table class="table">
                                        <tbody>
																					<?php  if(empty($das_events)){

																					} else {
																						 $i=1;
																						foreach ($das_events as $rows) { ?>
																							<tr>
																									<td>
																											<label class="checkbox">
																												<?php echo $i; ?>
																												</label>
																									</td>
																									<td><?php echo $new_date = date('d-m-Y', strtotime($rows->event_date));  ?> &nbsp; <?php echo $rows->event_name; ?></td>

																							</tr>

																				<?php  $i++; } 	}?>




                                        </tbody>
                                    </table>
                                </div>
                            </div>
														<div class="footer">
																<hr>
																<div class="stats">
																		<i class="fa fa-history"></i> View Calender
																</div>
														</div>


                        </div>
	</div>
	<div class="col-md-4">
		<div class="card ">
														<div class="header">
																<h4 class="title">Recent Users</h4>

														</div>
														<div class="content">
																<div class="table-full-width">
																		<table class="table">
																				<tbody>
																					<?php  if(empty($das_users)){

																					} else {
																						 $i=1;
																						foreach ($das_users as $rows) { ?>
																							<tr>
																									<td>
																											<label class="checkbox">
																												<?php echo $i; ?>
																												</label>
																									</td>
																									<td><?php echo $rows->user_name;  ?>  ->&nbsp; <?php echo $rows->name; ?></td>

																							</tr>

																				<?php  $i++; } 	}?>

																				</tbody>
																		</table>
																</div>
														</div>
														<div class="footer">
																<hr>
																<div class="stats">
																		<i class="fa fa-history"></i> Updated 3 minutes ago
																</div>
														</div>

												</div>
	</div>

	<div class="col-md-4">
		<div class="card ">
														<div class="header">
																<h4 class="title">Recent Circular</h4>

														</div>
														<div class="content">
																<div class="table-full-width">
																		<table class="table">
																			<tbody>
																				<?php  if(empty($dash_comm)){

																				} else {
																					 $i=1;
																					foreach ($dash_comm as $rows) { ?>
																						<tr>
																								<td>
																										<label class="checkbox">
																											<?php echo $i; ?>
																											</label>
																								</td>
																								<td><?php echo $rows->commu_title;  ?> </td>

																						</tr>

																			<?php  $i++; } 	}?>

																			</tbody>
																		</table>
																</div>
														</div>
														<div class="footer">
																<hr>
																<div class="stats">
																		<i class="fa fa-history"></i> Updated 3 minutes ago
																</div>
														</div>

												</div>
	</div>

</div>

	</div>
</div>


						</div>

				</div>
			</div>
