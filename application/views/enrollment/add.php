
<div class="main-panel">
<div class="content">
<div class="col-md-12">

                        <div class="card">
                            <div class="header">
                                <legend>Student Registration</legend>
                            </div>
                            <?php if($this->session->flashdata('msg')): ?>
                              <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button> <?php echo $this->session->flashdata('msg'); ?>
                     </div>

                     <?php endif; ?>

                            <div class="content">
                                <form method="post" action="<?php echo base_url(); ?>enrollment/create" class="form-horizontal" enctype="multipart/form-data" id="admissionform">

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Academic Year</label>
                                            <div class="col-sm-4">
<?php  $status=$years['status']; if($status=="success"){
            foreach($years['all_years'] as $rows){}
              ?>
            <input type="hidden" name="year_id"  value="<?php  echo $rows->year_id; ?>">
            <input type="text" name="year_name"  class="form-control" value="<?php echo date('Y', strtotime($rows->from_month));  echo "-"; echo date('Y', strtotime( $rows->to_month));  ?>" readonly="">

        <?php   }else{  ?>
          <input type="text" name=""  class="form-control" value="" readonly="">

      <?php     } ?>

                                            </div>

                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Admission No</label>
                                          <div class="col-sm-4">
                                         <select name="admisn_no" id="admission_no" onchange="checknamefun(this.value)" class="selectpicker form-control" data-title="Select Admission Number" >
                                                    <?php foreach ($admisno as $row) {  ?>
                                                <option value="<?php echo $row->admisn_no; ?>"><?php echo $row->admisn_no; ?></option>
                                              <?php      } ?>
                                                  </select>
            <!-- <input type="hidden" class="form-control" name="admisn_no" id="admission_no" onkeyup="checknamefun(this.value)"> 
                 <p id="msg1" style="color:red;"></p>  <p id="msg2" style="color:green;"></p>-->
                                          </div>

                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Student Name</label>
                                            <div class="col-sm-4">
                                                <p id="msg" name="name">  </p>
								<input type="text" name="name" id="name" readonly  class="form-control">
                                            </div>

                                        </div>
                                    </fieldset>

									 <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Registration Date</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="admit_date" class="form-control datepicker" placeholder="Registration Date"/>

                                            </div>

                                        </div>
                                    </fieldset>


                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Class</label>
                                            <div class="col-sm-4">
											
											 <select name="class_section" class="selectpicker form-control" data-title="Select Class" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                    <?php foreach ($getall_class as $rows) {  ?>
                                                    <option value="<?php echo $rows->class_sec_id; ?>"><?php echo $rows->class_name; ?>&nbsp; - &nbsp;<?php echo $rows->sec_name; ?></option>
                                              <?php      } ?>
                                                  </select>
												  
                                            </div>

                                        </div>
                                    </fieldset>
                                
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-10">
                                        <button type="submit" id="save1" class="btn btn-info btn-fill center">Save </button>
                                            </div>

                                        </div>
                                    </fieldset>
                                </form>

                            </div>
                        </div>  <!-- end card -->

                    </div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function () {

 $('#admissionform').validate({ // initialize the plugin
     rules: {
         year_id:{required:true, number: true },
		 year_name:{required:true },
         admisn_no:{required:true },
         admit_date:{required:true },
         name:{required:true },
         admit_date:{required:true },
         class_section:{required:true },
         section:{required:true }

     },
     messages: {
           year_id:"Admission Year not enable",
		   year_name:"Admission Year not enable",
           admisn_no: "Select Admission No",
           admit_date: "Select Admission Date",
           name: "Enter Name",
            admit_date: "Select The Date",
           class_section: "Select Class",
           section: "Select Section"

         }
 });
});

</script>

<script type="text/javascript">
      $().ready(function(){
 $('#enrollmentmenu').addClass('collapse in');
 $('#enroll').addClass('active');
 $('#enroll1').addClass('active');
        $('.datepicker').datetimepicker({
          format: 'DD-MM-YYYY',
          icons: {
              time: "fa fa-clock-o",
              date: "fa fa-calendar",
              up: "fa fa-chevron-up",
              down: "fa fa-chevron-down",
              previous: 'fa fa-chevron-left',
              next: 'fa fa-chevron-right',
              today: 'fa fa-screenshot',
              clear: 'fa fa-trash',
              close: 'fa fa-remove'
          }
       });
      });
  </script>

<script type="text/javascript">
   function checknamefun(val)
   { //alert(val);
      $.ajax({
			type:'post',
			url:'<?php echo base_url(); ?>/enrollment/checker',
			data:'admisno='+val,

			success:function(test)
			{
				//alert(test);
				if(test!='')
				{
				    $('#name').val(test);
					$('#name1').val(test);
					 checknamefun1(val);
			        //$("#msg").html(test);
				}
				else{
					alert("Admission Number not found");
					$("#save1").hide();
					//$("#msg").html(test);
					
				}
			}
	  });
}
</script>

<script type="text/javascript">
  function checknamefun1(val)
   {//alert(val);
      $.ajax({
			type:'post',
			url:'<?php echo base_url(); ?>/enrollment/checker1',
			data:'admisno='+val,

			success:function(test1)
			{
				//alert(test1);
				if(test1=="Already Enrollment Added")
				{

			        $("#msg1").html(test1);
					$("#msg2").html(test1).hide();
				}
				else{
					$("#msg2").html(test1);

				}
			}
	  });
}

</script>
