<style>
.fc-month-button{
	display: none;
	}
.fc-basicWeek-button{display: none;} .fc-basicDay-button{display: none;}
.red{    background-color: red;
    color: red;
    padding-left: 10px;}
		.Words{
			padding-left: 10px;
    font-size: 20px;
		}
.fc-event{
	background-color: red;
	}	</style>

	<div class="main-panel">

        <div class="content">
            <div class="container-fluid">
							<div class="content">
								<div class="header">
									<!-- <?php  echo json_encode($res); ?> -->
										<legend>Attendance Calender </legend>

								</div>
								<div class="container-fluid">
									<div class="row">
									<div class="col-md-8">
										<center>
											<div class="card card-calendar">
													<div class="content">

															<div id="fullCalendar"></div>

													</div>
											</div>
										</center>
									</div>

									<div class="col-md-4 text-center">
										<div class="noote" style="    display: inline-flex;    padding-top: 180px;">
										<div class="notice">
											<p class="red">1</p>
										</div>
										<div class="Words">
											Absent
										</div>
									</div>
										</div>

							</div>
					</div>
			</div>
		  		  </div>
    		</div>
				</div>
				<script>

	$(document).ready(function() {

		$('#fullCalendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: new Date(),
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			// events:"<?php echo base_url() ?>event/getall_act_event",
			events: 	<?php  echo json_encode($res); ?>,

eventMouseout: function(calEvent, jsEvent) {
    $(this).css('z-index', 8);
    $('.tooltipevent').remove();
},

		});




	});

		    </script>
