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
                                <h4 class="title">Enter Exam Marks <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button> </h4>
                                <p class="category"></p>
                            </div>
                            <div class="content table-responsive table-full-width">
					<form method="post" action="<?php echo base_url(); ?>examinationresult/marks_details" class="form-horizontal" enctype="multipart/form-data" id="markform">
                                <table class="table table-hover table-striped">
								<?php if(!empty($result))
									  { foreach($result as $exam)
								         {}
									        $id=$exam->exam_id;
											//echo $id;
											 }else{ echo "";}
									           //echo $id; 
											   /* if(!empty($stu))
										       { foreach($stu as $row)
									            { 
												 $tname=$row->enroll_id;
												 $su=$row->subject;
												 $clsid=$row->class_teacher;}
											   }else{ echo "";}  */
                                  ?>
								
								<input type="hidden" name="examid" value="<?php echo $id; ?>"/>
                                    <thead>
									 <th>Sno</th>
                                     <th>Name</th>
									 <?php 
                                      if(empty($res))
									  {?>
										  <p style="padding:15px;">Student Not Found </p>
									 <?php  }else{
										foreach($res as $row)
										      { }?>
				<th><?php echo $row->subject_name; ?><input type="hidden" name="subid" value="<?php echo $row->subject_id; ?>" /></th>	  
									<?php 
									  }?>
                                    </thead>
                                    <tbody>
										<?php 
										$i=1;
										foreach($res as $row)
										      { ?>
										<tr>
										<td><?php echo $i;?></td>
										<td style="">
										<?php echo $row->name; ?>
										<input type="hidden" name="sutid[]" value="<?php echo $row->enroll_id; ?>" />
										<input type="hidden" name="teaid" value="<?php echo $row->teacher_id; ?>" />
                                        <input type="hidden" name="clsmastid" value="<?php echo $row->class_id; ?>" />
										</td>	
										<td><input style="width:60%;" type="text" required name="marks[]" value class="form-control"/></td>	
										</tr>
										<?php $i++;} ?>
										<tr>
										<td></td><td></td>	
										 <td><div class="col-sm-10">
                                             <button type="submit" class="btn btn-info btn-fill center">Save </button>
                                          </div> </td>
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