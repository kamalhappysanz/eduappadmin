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
	</style>

	<div class="main-panel">

        <div class="content">
            <div class="container-fluid">
							<div class="content">
								<div class="header">
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
										<div class="row" style="padding-top: 150px;">
											<h5>Total Working days</h5>
											<p> <?php if(empty($total)){

											} else{
												echo count($total);
											}?> </p>
										</div>
										<div class="noote" style="    display: inline-flex;   ">
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
			eventSources: [
	 {
		 url: '<?php echo base_url() ?>adminparent/get_stude',
		 color: 'red'

	 }

 ],

eventMouseout: function(calEvent, jsEvent) {
    $(this).css('z-index', 8);
    $('.tooltipevent').remove();
},

		});




	});

		    </script>
