<div class="main-panel">
<div class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-8">
                   <div class="card">
                       <div class="header">
                         <?php if($this->session->flashdata('msg')): ?>
                           <div class="alert alert-success">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                         ×</button> <?php echo $this->session->flashdata('msg'); ?>
                 </div>

           <?php endif; ?>
                           <h4 class="title">Edit Profile</h4>
                       </div>
                       <?php
                      // print_r($result);
                       foreach ($result as $rows) {

                       }
                        ?>
                       <div class="content">
                           <form action="<?php echo base_url(); ?>adminlogin/profileupdate" method="post" enctype="multipart/form-data">
                               <div class="row">
                                   <div class="col-md-5">
                                       <div class="form-group">
                                           <label>User Name</label>
                          <input type="text" class="form-control" readonly placeholder="" name="name" value="<?php echo $rows->name; ?>">
                          <input type="hidden" class="form-control" readonly placeholder="" name="user_id" value="<?php echo $rows->teacher_id; ?>">
                          <input type="hidden" class="form-control" readonly placeholder="" name="user_pic_old" value="<?php echo $rows->profile_pic; ?>">
                          
                                       </div>
                                   </div>

                                   <div class="col-md-7">
                                       <div class="form-group">
                                           <label for="exampleInputEmail1"> Name</label>
                                           <input type="text" class="form-control" name="name" placeholder="Email" value="<?php echo $rows->name; ?>">
                                       </div>
                                   </div>
                               </div>

						
							   
			           <div class="row">
                                   <div class="col-md-5">
                                       <div class="form-group">
                                           <label>Gender</label>
                          <select name="sex" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                              <option value="Male">Male</option>
                                              <option value="Female">Female</option>
                                            </select>

                                            <script language="JavaScript">document.teacherform.sex.value="<?php echo $rows->sex; ?>";</script>
                          
                                       </div>
                                   </div>

                                   <div class="col-md-7">
                                       <div class="form-group">
                                           <label for="exampleInputEmail1"> Mobile</label>
                                           <input type="text" placeholder="Mobile Number" name="mobile" class="form-control" value="<?php echo $rows->phone; ?>">
                                       </div>
                                   </div>
                               </div>
							   
							   
							                                  <div class="row">
                                   <div class="col-md-5">
                                       <div class="form-group">
                                           <label>Date of birth</label>
                        <input type="text" name="dob" id="dob" class="form-control datepicker" placeholder="Date of Birth " value="<?php echo $rows->dob; ?>"/>
                          
                                       </div>
                                   </div>

                                   <div class="col-md-7">
                                       <div class="form-group">
                                           <label for="exampleInputEmail1"> Nationality</label>
                                           <input type="text" placeholder="Nationality" name="nationality" class="form-control"  value="<?php echo $rows->nationality; ?>">
                                       </div>
                                   </div>
                               </div>
							   
                          <div class="row">
                                   <div class="col-md-5">
                                       <div class="form-group">
                                           <label>Age</label>
                         <input type="text" placeholder="Age" name="age" id="age" class="form-control"  value="<?php echo $rows->age; ?>">
                         
                                       </div>
                                   </div>

                                   <div class="col-md-7">
                                       <div class="form-group">
                                           <label for="exampleInputEmail1"> Religion</label>
                                             <input type="text" placeholder="Religion" name="religion" class="form-control"  value="<?php echo $rows->religion; ?>">
                                       </div>
                                   </div>
                               </div>
							  
							    <div class="row">
                                   <div class="col-md-5">
                                       <div class="form-group">
                                           <label>Address</label>
                         <textarea name="address" class="form-control" rows="4" cols="80"><?php echo $rows->address; ?></textarea>
                         
                                       </div>
                                   </div>

                                   <div class="col-md-7">
                                       <div class="form-group">
                                           <label for="exampleInputEmail1"> Subject</label>
                                             <select   name="subject"  class="selectpicker" data-style="btn-block"  data-menu-style="dropdown-blue">
                                                    <?php foreach ($resubject as $rows3) {  ?>
                                                    <option value="<?php echo $rows3->subject_id; ?>"><?php echo $rows3->subject_name; ?></option>
                                              <?php      } ?>
                                                  </select>
												  <script language="JavaScript">document.teacherform.subject.value="<?php echo $rows->subject; ?>";</script>
                                       </div>
                                   </div>
                               </div>
							    <div class="row">
                                   <div class="col-md-5">
                                       <div class="form-group">
                                           <label>Class Teacher</label>
                        <select   name="class_teacher"  class="selectpicker" data-style="btn-block"  data-menu-style="dropdown-blue">
                                                <?php foreach ($getall_class as $rows2) {  ?>
                                                <option value="<?php echo $rows2->class_sec_id; ?>"><?php echo $rows2->class_name; ?>&nbsp; - &nbsp;<?php echo $rows2->sec_name; ?></option>
                                          <?php      } ?>
                                              </select>
                                                  <script language="JavaScript">document.teacherform.class_teacher.value="<?php echo $rows->class_sec_id; ?>";</script>
                         
                                       </div>
                                   </div>

                                   <div class="col-md-7">
                                       <div class="form-group">
                                           <label for="exampleInputEmail1"> Class</label>
                                           <select multiple  name="class_name[]" id="multiple-class" class="selectpicker" data-style="btn-block" onchange="select_class('classname')" data-menu-style="dropdown-blue">

                                        <?php
                                         $sPlatform=$rows->class_name;
                                        $sQuery = "SELECT c.class_name,s.sec_name,cm.class_sec_id,cm.class FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id ORDER BY c.class_name";
                                         $objRs=$this->db->query($sQuery);
                                      //print_r($objRs);
                                      $row=$objRs->result();
                                      foreach ($row as $rows1) {
                                      $s= $rows1->class_sec_id;
                                      $sec=$rows1->class;
                                      $clas=$rows1->class_name;
                                        $sec_name=$rows1->sec_name;
                                      $arryPlatform = explode(",", $sPlatform);
                                     $sPlatform_id  = trim($s);
                                     $sPlatform_name  = trim($sec);
                                     if (in_array($sPlatform_id, $arryPlatform )) {
                              //echo "<input type=\"checkbox\" name=\"chkPlatform[]\" value=\"$sPlatform_id\" checked />$sPlatform_name&nbsp;&nbsp;";
                              // echo "<option  value=\"$sPlatform_id\" selected  />$sPlatform_name&nbsp;&nbsp; </option>";
                              ?>

                          <?php
                                       echo "<option  value=\"$sPlatform_id\" selected  />$clas-$sec_name &nbsp;&nbsp; </option>";
                                   ?>

                                <?php }
                                 

                                      }
                                        ?>

                                  </select>
                                       </div>
                                   </div>
                               </div>
							   
							   
					   
                               <div class="row">
                                   <div class="col-md-6">
                                       <div class="form-group">
                                         <label>Profile Pic</label>
                                         <input type="file" class="form-control" placeholder="" value="" name="profile" onchange="loadFile(event)" accept="image/*" >
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                   </div>
                               </div>

                               <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                               <div class="clearfix"></div>
                           </form>
                       </div>
                   </div>
               </div>
               <div class="col-md-4">
                   <div class="card card-user">
                       <div class="image">
                           <img src="<?php echo base_url(); ?>assets/img/full-screen-image-3.jpg" alt="..."/>
                       </div>
                       <div class="content">
                           <div class="author">
                                <a href="#">
								
                               <img class="avatar border-gray" id="output" src="<?php echo base_url(); ?>assets/teacher/profile/<?php echo $rows->profile_pic; ?>" alt="..."/>

									
                                 <h4 class="title"><?php echo $rows->name;  ?><br />
                                    
                                 </h4>
                               </a>
                           </div>

                       </div>


                   </div>
               </div>

           </div>
       </div>
   </div>
</div>

<script type="text/javascript">
var loadFile = function(event) {
 var output = document.getElementById('output');
 output.src = URL.createObjectURL(event.target.files[0]);
};
</script>
