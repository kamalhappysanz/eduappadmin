
<div class="main-panel">
<div class="content">
<div class="col-md-12">

                        <div class="card">
                            <div class="header">
                                <legend>Update Examination Calender</legend>
                            </div>
                            <?php if($this->session->flashdata('msg')): ?>
                              <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button> <?php echo $this->session->flashdata('msg'); ?>
                     </div>
                     <?php endif; ?>
					       <?php
						   foreach($res as $rows)
						   {
						   }
						   ?>
                            <div class="content">
                              <form method="post" action="<?php echo base_url(); ?>examination/update_exam_details" class="form-horizontal" enctype="multipart/form-data" name="examform" id="examform">
								 <fieldset>
                                        <div class="form-group">

                                            <label class="col-sm-2 control-label">Exam</label>
                                            <div class="col-sm-4">
									<input type="hidden" name="id" value="<?php echo $rows->exam_detail_id; ?>">
											  <select name="exam_year" class="selectpicker" data-style="btn-default btn-block" data-menu-style="dropdown-blue">

                                    <?php
										  $tea_name=$rows->exam_id;
										  $sQuery = "SELECT ed.*,ex.exam_id,ex.exam_year,ex.exam_name,ea.year_id,ea.from_month,ea.to_month FROM edu_examination AS ex,edu_academic_year AS ea,edu_exam_details AS ed WHERE ed.exam_id=ex.exam_id AND ex.exam_year=ea.year_id";
										  $objRs=$this->db->query($sQuery);
										  $row=$objRs->result();
										  foreach ($row as $rows1)
										  {
											     $id=$rows1->exam_id;
												 $s= $rows1->from_month;
												 $month= strtotime($s);
												 $ye=date('Y',$month);

												 $tm=$rows1->to_month;
												 $tm1= strtotime($tm);
												 $ye1=date('Y',$tm1);

												 $sec=$rows1->exam_name;

												 $arryPlatform = explode(",",$tea_name);
												 $sPlatform_id  = trim($s);
												 $sPlatform_name  = trim($sec);
												 if (in_array($sPlatform_id,$arryPlatform ))
												  {
													   echo "<option  value=\"$id\" selected  />$ye-$ye1($sec)</option>";
												  }
												 else {
												echo "<option value=\"$id\" /> $ye-$ye1($sec) </option>";
												 }
													  }
                                        ?>

                                          </select>

                                            </div>

										 <label class="col-sm-2 control-label">Class </label>
                                            <div class="col-sm-4">
								 <select multiple data-title="Select More Than one class" name="class_name" id="multiple-class" class="selectpicker" onchange="select_class('classname')" data-menu-style="dropdown-blue">

										<?php
												$sPlatform=$rows->classmaster_id;
												$sQuery = "SELECT c.class_name,s.sec_name,cm.class_sec_id,cm.class FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id ORDER BY c.class_name";
												$objRs=$this->db->query($sQuery);
											  //print_r($objRs);
											  $row=$objRs->result();
											  foreach ($row as $rows1)
											  {
											  $s= $rows1->class_sec_id;
											  $sec=$rows1->class;
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
                                            </div>

				                     </div>
                                    </fieldset>
                                   <fieldset>
                                        <div class="form-group">


                                            <label class="col-sm-2 control-label">Select Subject</label>
                                            <div class="col-sm-4">
                                               <select name="subject_name" class="selectpicker" data-title="Select Subject" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                  <?php
                          $tea_name=$rows->subject_id;
                          $sQuery = "SELECT * FROM edu_subject";
                          $objRs=$this->db->query($sQuery);
                          $row=$objRs->result();
                          foreach ($row as $rows1)
						  {
								 $s= $rows1->subject_id;
								 $sec=$rows1->subject_name;
								 $arryPlatform = explode(",",$tea_name);
								 $sPlatform_id  = trim($s);
								 $sPlatform_name  = trim($sec);
								 if (in_array($sPlatform_id, $arryPlatform ))
								  {
                                       echo "<option  value=\"$s\" selected  /> $sec &nbsp;&nbsp; </option>";
                                  }
                                 else {
                                echo "<option value=\"$s\" />$sec &nbsp;&nbsp;</option>";
                                 }
                                      }
                                        ?>
                                  </select>
                                            </div>

                                            <label class="col-sm-2 control-label">Exam Date</label>
                                           <div class="col-sm-2">
                            <input type="text" name="exam_date" class="form-control datepicker"  placeholder="Enter Exam Date" value="<?php $date=date_create($rows->exam_date);echo date_format($date,"d-m-Y");?>">
                                            </div>
					 <div class="col-sm-2"> 
					<select name="time" class="selectpicker" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                   <option value="AM">AM</option>
								   <option value="PM">PM</option>
                    </select>
					<script language="JavaScript">document.examform.time.value="<?php echo $rows->times; ?>";</script>
				  
                                            </div>
				                     </div>

                                    </fieldset>


								   <fieldset>
                                        <div class="form-group">


                                          <label class="col-sm-2 control-label">Notes</label>
                                            <div class="col-sm-4">
                                        <textarea name="notes" class="form-control" rows="4" cols="80"><?php echo $rows->notes; ?></textarea>
                                            </div>

                                        </div>
                                    </fieldset>


									 <fieldset>
                                        <div class="form-group">

											<label class="col-sm-2 control-label">&nbsp;</label>

                                            <div class="col-sm-4">
                                       <button type="submit" id="save" class="btn btn-info btn-fill center">Update </button>
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


 $(document).ready(function ()
 {
   $('#examform').validate({ // initialize the plugin
     rules: {
         exam_id:{required:true, number: true },
         subject_name:{required:true },
         exam_date:{required:true },
         class_name:{required:true },
         notes:{required:true }

  },
     messages: {
           exam_id: "Enter exam_id",
           subject_name: "Select Subject",
           exam_date: "Enter Exam Date",
           class_name: "Select Class",
           notes: "Enter Notes",


         }
 });
});
</script>
<script type="text/javascript">
    $().ready(function(){
      $('#exammenu').addClass('collapse in');
      $('#exam').addClass('active');
      $('#exam2').addClass('active');
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
