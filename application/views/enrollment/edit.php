
<div class="main-panel">
<div class="content">
<div class="col-md-12">

                        <div class="card">
                            <div class="header">
                                <legend>Enrollment</legend>
                            </div>
                            <?php if($this->session->flashdata('msg')): ?>
                              <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button> <?php echo $this->session->flashdata('msg'); ?>
                     </div>

                     <?php endif; ?>
                     <?php foreach ($res as $rows) { } ?>
                            <div class="content">
                                <form method="post" action="<?php echo base_url(); ?>enrollment/save" name="enrollform" class="form-horizontal" enctype="multipart/form-data" id="admissionform">

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Admission Year</label>
                                            <div class="col-sm-4">

											
				<select name="admit_year" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
											
											<?php
		    $sPlatform=$rows->admit_year;
			$sQuery = "SELECT * FROM edu_academic_year";
			$objRs=$this->db->query($sQuery);
		  //print_r($objRs);
		  $row=$objRs->result();
		  foreach ($row as $rows1)
		  {
		  $s= $rows1->year_id;
		 
		 
		 $fyear=$rows1->from_month;
		 $month= strtotime($fyear);											 
		 $clas=date('Y',$month);
		 
		 $eyear=$rows1->to_month;
		 $month1= strtotime($eyear);
													
		 $sec_name=date('Y',$month1);
		  
		  
		  $arryPlatform = explode(",", $sPlatform);
		 $sPlatform_id  = trim($s);
		 $sPlatform_name  = trim($sec);
		 if (in_array($sPlatform_id, $arryPlatform )) {
  ?>
          <?php
                  echo "<option  value=\"$sPlatform_id\" selected  />$clas-$sec_name &nbsp;&nbsp; </option>";
             ?>

                                <?php }
                                  else {
                                echo "<option value=\"$sPlatform_id\" />$clas-$sec_name &nbsp;&nbsp;</option>";
                                 }
                                      }
                                        ?>

                                  </select>
								  
								  
                                               <!-- <select name="admit_year" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                  <option value="2017-2018">2017-2018</option>
                                                  <option value="2018-2019">2018-2019</option>
                                                    <option value="2019-2020">2019-2020</option>
                                                </select> -->
                                                  <script language="JavaScript">document.enrollform.admit_year.value="<?php echo $rows->admit_year; ?>";</script>
                                            </div>

                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Admission No</label>
                                          <div class="col-sm-4">
                                              <input type="text" class="form-control" name="admisn_no" id="admission_no" value="<?php echo $rows->admisn_no; ?>" readonly="">
                                              <input type="hidden" class="form-control" name="enroll_id" id="admission_no" value="<?php echo $rows->enroll_id; ?>" readonly="">
                                          </div>

                                        </div>
                                    </fieldset>




                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Admission Date</label>
                                            <div class="col-sm-4">


                                                <input type="text" name="admit_date" class="form-control datepicker" placeholder="Admission Date"  value="<?php $date=date_create($rows->admit_date);
echo date_format($date,"d-m-Y");  ?>" />

                                            </div>

                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="name" class="form-control"  value="<?php echo $rows->name; ?>">

                                            </div>

                                        </div>
                                    </fieldset>



                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Class</label>
                                            <div class="col-sm-4">
											
											 <select multiple name="class_name" class="selectpicker"  data-menu-style="dropdown-blue">

	<?php
		    $sPlatform=$rows->class_id;
			$sQuery = "SELECT c.class_name,s.sec_name,cm.class_sec_id,cm.class FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id ORDER BY c.class_name";
			$objRs=$this->db->query($sQuery);
		  //print_r($objRs);
		  $row=$objRs->result();
		  foreach ($row as $rows1)
		  {
		  $s= $rows1->class_sec_id;
		 // $sec=$rows1->class;
		  $clas=$rows1->class_name;
		  $sec_name=$rows1->sec_name;
		  $arryPlatform = explode(",", $sPlatform);
		 $sPlatform_id  = trim($s);
		 $sPlatform_name  = trim($sec);
		 if (in_array($sPlatform_id, $arryPlatform )) {
  ?>
          <?php
                  echo "<option  value=\"$sPlatform_id\" selected  />$clas-$sec_name &nbsp;&nbsp; </option>";
             ?>

                                <?php }
                                  else {
                                echo "<option value=\"$sPlatform_id\" />$clas-$sec_name &nbsp;&nbsp;</option>";
                                 }
                                      }
                                        ?>

                                  </select>
								  
								  
										
                                              <!--<select name="class" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                <?php foreach ($clas as $rows1) { ?>
                                                  <option value="<?php echo $rows1->class_id; ?>"><?php echo $rows1->class_name; ?></option>
                                              <?php  } ?>
                                                </select> -->
                                                  <script language="JavaScript">document.enrollform.class.value="<?php echo $rows->class_id; ?>";</script>
                                            </div>

                                        </div>
                                    </fieldset>
                                  <!--  <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Section</label>
                                            <div class="col-sm-4">
                                              <select name="section" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                <?php foreach ($sec as $rows2) { ?>
                                                  <option value="<?php echo $rows2->sec_id; ?>"><?php echo $rows2->sec_name; ?></option>
                                              <?php  } ?>
                                              </select>
                                              <script language="JavaScript">document.enrollform.section.value="<?php echo $rows->sec_name; ?>";</script>
                                            </div>

                                        </div>
                                    </fieldset> -->
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Status</label>
                                            <div class="col-sm-4">
                                              <select name="status" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">

                                                  <option value="A">Active</option>
                                                    <option value="DA">DE-Active</option>

                                              </select>
                                              <script language="JavaScript">document.enrollform.status.value="<?php echo $rows->status; ?>";</script>
                                            </div>

                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-10">
                                                   <button type="submit" class="btn btn-info btn-fill center">Update Enrollment</button>
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
 jQuery('#enrollmentmenu').addClass('collapse in');
 $('#admissionform').validate({ // initialize the plugin
     rules: {
         admit_year:{required:true },
         admisn_no:{required:true },
         admit_date:{required:true },
         name:{required:true },
         admit_date:{required:true },
         class:{required:true },
         section:{required:true }

     },
     messages: {
           admit_year: "Enter Admission Year",
           admisn_no: "Enter Admission No",
           admit_date: "Select Admission Date",
           name: "Enter Name",
            admit_date: "Select The Date",
           class: "Select Class",
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
