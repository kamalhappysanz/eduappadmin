<div class="main-panel">

 <div class="content">
            <div class="container-fluid">
			<?php if($this->session->flashdata('msg')): ?>
         <div class="alert alert-success">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
       ×</button> <?php echo $this->session->flashdata('msg'); ?>
         </div>
       <?php endif; ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Exam Mark <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button></h4>
                                <p class="category"></p>
                            </div>
                            <div class="content table-responsive table-full-width">
					<form method="post" action="<?php echo base_url(); ?>examinationresult/update_marks_details" class="form-horizontal" enctype="multipart/form-data" id="markform">
                                <table class="table table-hover table-striped">

                                    <thead>
									 <th>Sno</th>
                                     <th>Name</th>	
                                   <?php foreach($edit as $row)
										      {   $sid=$row->subject_id;
											      $sql="SELECT * FROM edu_subject WHERE subject_id='$sid' ";
								                  $resultset=$this->db->query($sql);
												  $row=$resultset->result();
												  foreach($row as $row1)
												 {}}?>
												  <th><?php echo $row1->subject_name;?></th>	
											  <?php 
												 ?>									 
                                    </thead>
                                    <tbody>
										<?php 
										$i=1;
										if($status="success")
									    { 
									     foreach($edit as $row)
										      { ?>
										<tr>
										<td><?php echo $i;?></td>
										<td style="">
										<?php echo $row->name; ?>
										<input type="hidden" name="examid" value="<?php echo $row->exam_id; ?>" />
										<input type="hidden" name="subid" value="<?php echo $row->subject_id; ?>" />
										<input type="hidden" name="sutid[]" value="<?php echo $row->stu_id; ?>" />
										<input type="hidden" name="teaid" value="<?php echo $row->teacher_id; ?>" />
                                        <input type="hidden" name="clsmastid" value="<?php echo $row->classmaster_id; ?>" />
										</td>	
										<td><input style="width:60%;" type="text" readonly name="marks[]" value="<?php echo $row->marks; ?>" class="form-control"/></td>	
										</tr>
									 <?php $i++;} 
     									}else{
										foreach($edit as $row)
										      { ?>
										<tr>
										<td><?php echo $i;?></td>
										<td style="">
										<?php echo $row->name; ?>
										<input type="hidden" name="examid" value="<?php echo $row->exam_id; ?>" />
										<input type="hidden" name="subid" value="<?php echo $row->subject_id; ?>" />
										<input type="hidden" name="sutid[]" value="<?php echo $row->stu_id; ?>" />
										<input type="hidden" name="teaid" value="<?php echo $row->teacher_id; ?>" />
                                        <input type="hidden" name="clsmastid" value="<?php echo $row->classmaster_id; ?>" />
										</td>	
										<td><input style="width:60%;" type="text"  name="marks[]" value="<?php echo $row->marks; ?>" class="form-control"/></td>	
										</tr>
									 <?php $i++;} 
									 }?>
										<tr>
										<td></td><td></td>	
										 <td><?php if($status="success")
										   { echo ""; 
										   }else{?>
										 <div class="col-sm-10">
                                             <button type="submit" class="btn btn-info btn-fill center">Update </button>
                                          </div>
										 <?php } ?>	  </td>
										</tr>

                                    </tbody>
                                </table>
								
								</form>

                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
	</div>	