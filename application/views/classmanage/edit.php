<div class="main-panel">
<div class="content">
       <div class="container-fluid">
                    <div class="row">
              <div class="col-md-12">

                <?php

                 foreach ($res as $rows) { }

                 ?>

                <div class="card">
                    <div class="header">Class Management</div>
                    <div class="content">
                      <br>

                        <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>classmanage/update_cs" name="edit_cs" enctype="multipart/form-data" id="myformclassmange">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Class</label>
                                <div class="col-md-6">
                                  <input type="hidden" name="class_sec_id" value="<?php echo $rows->class_sec_id; ?>">
                                  <select name="class_name" class="selectpicker" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                    <?php   foreach ($clas as $row) {  ?>
                                      <option value="<?php  echo $row->class_id; ?>"><?php  echo $row->class_name; ?></option>
                                <?php     } ?>

                                  </select>
                                  <script language="JavaScript">document.edit_cs.class_name.value="<?php echo $rows->class_id; ?>";</script>

                                </div>
                            </div>
                           

                            <div class="form-group">
                                <label class="col-md-4 control-label">Section</label>
                                <div class="col-md-6">
                                  <select name="section_name" class="selectpicker"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                      <?php   foreach ($sec as $rows1) {  ?>
                                        <option value="<?php  echo $rows1->sec_id; ?>"><?php  echo $rows1->sec_name; ?></option>
                                  <?php     } ?>
                                </select>
                                <script language="JavaScript">document.edit_cs.section_name.value="<?php echo $rows->sec_id; ?>";</script>
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-sm-4 control-label">Subject </label>
                            <div class="col-sm-6">
                             <select multiple  name="subject[]" id="multiple-class" class="selectpicker" data-style="btn-block" onchange="select_class('classname')" data-menu-style="dropdown-blue">

                            <?php
                            $sPlatform=$rows->subject;
                            $sQuery = "SELECT * FROM edu_subject";
                             $objRs=$this->db->query($sQuery);
                          //print_r($objRs);
                          $row=$objRs->result();
                          foreach ($row as $rows1) {
                          $s= $rows1->subject_id;
                          $sec=$rows1->subject_name;
                          // $clas=$rows1->class_name;
                          //   $sec_name=$rows1->sec_name;
                          $arryPlatform = explode(",", $sPlatform);
                         $sPlatform_id  = trim($s);
                         $sPlatform_name  = trim($sec);
                         if (in_array($sPlatform_id, $arryPlatform )) {
                  ?>

                      <?php
                           echo "<option  value=\"$sPlatform_id\" selected  /> $sec&nbsp; </option>";
                       ?>

                    <?php }
                      else {
                    echo "<option value=\"$sPlatform_id\" />$sec&nbsp;</option>";
                     }

                          }
                            ?>
                      </select>
                    </div>
                    </div>


                            <div class="form-group">
                                <label class="col-md-4"></label>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-fill btn-info">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> <!-- end card -->


                  <!--  end card  -->
              </div> <!-- end col-md-12 -->
          </div> <!-- end row -->
       </div>
   </div>
</div>
<script type="text/javascript">
$('#classmenu').addClass('collapse in');
$('#class').addClass('active');
$('#class3').addClass('active');
</script>
