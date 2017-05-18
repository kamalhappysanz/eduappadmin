
<div class="main-panel">
<div class="content">
<div class="col-md-12">

                        <div class="card">
                            <div class="header">
                                <legend>Admission</legend>
                            </div>
                            <?php if($this->session->flashdata('msg')): ?>
                              <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button> <?php echo $this->session->flashdata('msg'); ?>
                     </div>

                     <?php endif; ?>

                     <?php foreach ($res as $rows) {

                     } ?>
                            <div class="content">
                                <form method="post" action="<?php echo base_url(); ?>admission/save_ad" class="form-horizontal" enctype="multipart/form-data" id="admissionform" name="formadmission">
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Admission Year</label>
                                            <div class="col-sm-4">
<input type="text" class="form-control" name="admission_year" id="admission_year" value="<?php echo $rows->admisn_year; ?>" readonly>
                                            </div>
                                            <label class="col-sm-2 control-label">Admission No</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="admission_no" id="admission_no" value="<?php echo $rows->admisn_no; ?>" readonly>
                                                <input type="hidden" class="form-control" name="admission_id" id="admission_no" value="<?php echo $rows->admission_id; ?>" readonly>

                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Admission Date</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="admission_date" class="form-control datepicker" value="<?php echo $rows->admisn_date; ?>"  placeholder="Admission Date "/>
                                            </div>
                                            <label class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="email" class="form-control " placeholder="Email Address" value="<?php echo $rows->email; ?>"/>
                                            </div>

                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="name" class="form-control"  value="<?php echo $rows->name; ?>" >

                                            </div>
                                            <label class="col-sm-2 control-label">Gender</label>
                                            <div class="col-sm-4">
                                              <select name="sex" class="selectpicker form-control" data-style="btn-default btn-block" >
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>

                                              </select>
                                           <script language="JavaScript">document.formadmission.sex.value="<?php echo $rows->sex; ?>";</script>

                                            </div>
											
											
											
                                        </div>
                                    </fieldset>


                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Date of birth</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="dob" class="form-control datepicker" placeholder="Date of Birth " value="<?php echo $rows->dob; ?>"/>

                                            </div>
                                            <label class="col-sm-2 control-label">Age</label>
                                            <div class="col-sm-4">
                                              <input type="text" placeholder="Age" name="age" class="form-control" value="<?php echo $rows->age; ?>">

                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Nationality</label>
                                            <div class="col-sm-4">
                                                <input type="text" placeholder="Nationality" name="nationality" class="form-control" value="<?php echo $rows->nationality; ?>">
                                            </div>
                                            <label class="col-sm-2 control-label">Religion</label>
                                            <div class="col-sm-4">
                                                <input type="text" placeholder="Religion" name="religion" class="form-control" value="<?php echo $rows->religion; ?>">
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Community Class</label>
                                            <div class="col-sm-4">
                                                <input type="text" placeholder="Community Class" name="community_class" class="form-control" value="<?php echo $rows->community_class; ?>">
                                            </div>
                                            <label class="col-sm-2 control-label">Community</label>
                                            <div class="col-sm-4">
                                                <input type="text" placeholder="Community" name="community" class="form-control" value="<?php echo $rows->community; ?>">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Mother Tongue</label>
                                            <div class="col-sm-4">
                                                <input type="text" placeholder="Mother Tongue" name="mother_tongue" class="form-control" value="<?php echo $rows->mother_tongue; ?>">
                                            </div>
                                            <label class="col-sm-2 control-label">Mobile</label>
                                            <div class="col-sm-4">
                                                <input type="text" placeholder="Mobile Number" name="mobile" class="form-control" value="<?php echo $rows->mobile; ?>">
                                            </div>
                                        </div>
                                    </fieldset>

									 <fieldset>
                                        <div class="form-group">
                                           <label class="col-sm-2 control-label">Certificates</label>
                                           <div class="col-sm-4">
										   <?php $t=$rows->transfer_certificate;
                                                 $s=$rows->record_sheet; 	
												  ?>
								 <label class="checkbox checkbox-inline">
                                       <input type="checkbox" data-toggle="checkbox" name="trn_cert" value="1"<?php $rows->transfer_certificate=='1'?> checked="checked">Transfer Certificate
                                     </label> 
									 
									<label class="checkbox checkbox-inline">
										<input type="checkbox" data-toggle="checkbox" name="rec_sheet" value="2"<?php $rows->transfer_certificate=='2'?> checked="checked">Record Sheet
									</label>
	 
                                           </div>
									 <label class="col-sm-2 control-label">Language Proposed</label>
                                      <div class="col-sm-4">
                    <select name="lang" class="selectpicker"  data-style="btn-default btn-block" >
                       <option value="English">English</option>
					   <option value="Tamil">Tamil</option>
                        </select>
						<script language="JavaScript">document.formadmission.lang.value="<?php echo $rows->language; ?>";</script>
                                            </div>
                                        </div>
                               </fieldset>
							   
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Student New Pic</label>
                                            <div class="col-sm-4">
                                                <input type="file" name="student_pic" class="form-control" onchange="loadFile(event)" accept="image/*" >
                                            </div>
                                            <label class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-4">
                                              <img  id="output" class="img-circle" style="width:110px;">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Current  Pic</label>
                                            <div class="col-sm-4">
                                                <input type="hidden" placeholder="Mobile Number" name="user_pic_old" class="form-control" value="<?php echo $rows->student_pic; ?>">
                                              <img src="<?php echo base_url(); ?>assets/admission/profile/<?php echo $rows->student_pic; ?>" class="img-circle" style="width:110px;">
                                            </div>

                                        </div>
                                    </fieldset>


                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-10">
                                                   <button type="submit" class="btn btn-info btn-fill center">Save</button>
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
var loadFile = function(event) {
 var output = document.getElementById('output');
 output.src = URL.createObjectURL(event.target.files[0]);
};

$(document).ready(function () {
jQuery('#admissionmenu').addClass('collapse in');
$('#admission').addClass('active');
$('#admission2').addClass('active');
 $('#admissionform').validate({ // initialize the plugin
     rules: {
         admission_no:{required:true, number: true },
         admission_year:{required:true },
         admission_date:{required:true },
         name:{required:true },
         email:{required:true,email:true},
         sex:{required:true },
         dob:{required:true },
         age:{required:true,number:true,maxlength:2 },
         nationality:{required:true },
         religion:{required:true },
         community_class:{required:true },
         community:{required:true },
         mother_tongue:{required:true },
         mobile:{required:true }

     },
     messages: {
           admission_no: "Enter Admission No",
           admission_year: "Enter Admission Year",
           admission_date: "Select Admission Date",
           name: "Enter Name",
            email: "Enter Email Address",
           sex: "Select Gender",
           dob: "Select Date of Birth",
           age: "Enter AGE",
           nationality: "Nationality",
           religion: "Enter the Religion",
           community:"Enter the Community",
           community_class:"Enter the Community Class",
           mother_tongue:"Enter The Mother tongue",
           mobile:"Enter the mobile Number",
           student_pic:"Enter the Student Picture"
         }
 });
});

</script>
<script type="text/javascript">
     /*  $().ready(function(){

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
      }); */
  </script>
