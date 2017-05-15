<?php
$student_array_generate = function($stu,&$student_arr) use ($subject_name,$subject_id){
	foreach ($stu as $v) {
		$cnt= count($subject_name);
		for($i=0;$i<$cnt;$i++)
		{
			if($subject_id[$i] == $v->subject_id)
			{
				$student_arr[$v->name][$subject_id[$i]] = $v;
			}else{
				if(!isset($student_arr[$v->name][$subject_id[$i]]))
					$student_arr[$v->name][$subject_id[$i]] = array();
			}
		}
	}
}

?>

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
                                <h4 class="title">Enter Exam Mark <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button> </h4>
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
									      
                                  ?>
								
								<input type="hidden" name="examid" value="<?php echo $id; ?>"/>
                                    <thead>
									 <th>Sno</th>
                                     <th>Name</th>
								<?php
  								      if($status=="Success")
									  { 
                                       $cnt= count($subject_name);
                                     for($i=0;$i<$cnt;$i++)
									 { ?>
										<th> <?php echo $subject_name[$i]; ?> <?php //echo $subject_id[$i]; ?></th>
									<?php  }
									}else{  ?>
									 <th style="color:red;">Subject Not Found</th>
									 <?php  }?> 
                                    </thead>
									<?php 
									$tecid=$marks1[0]->teacher_id;
									echo '<input type="hidden" name="teaid" value="'.$tecid.'" />';
                                     ?>
                                    <tbody>
										<?php 
										$student_arr = array();
										 
										$student_array_generate($stu,$student_arr);
										
										/* echo '<pre>';
										print_r($stu);
										print_r($student_arr);
										die;
										 */
										$i = 1;
										foreach ($student_arr as $k => $s1) 
										{
											echo '<tr>';
											echo '<td>' . $i . '</td>';
											echo '<td>' . $k . '</td>';	
											$k = 1;
											foreach ($s1 as $k1 => $s) 
											{
												if(empty($s) === false && $k == 1){
													echo '<input type="hidden" name="sutid[]" value="'.$s->enroll_id.'" />';
													echo '<input type="hidden" name="clsmastid" value="'.$s->class_id.'" />';
													$k++;
												}
												if($status=="Success")
											   {
												   
												    echo '<td><input type="hidden" required name="subid" value="'.$k1.'" class="form-control"/>';
													
													if(!empty($s))
													{	
														echo '<input style="width:60%;" type="text" required name="marks1[]" value="'.$s->marks.'" class="form-control"/></td>';														
													}else{
														echo '<input style="width:60%;" type="text"  name="marks[]" value="" class="form-control"/>';
														echo '<input type="hidden" required name="subjectid[]" value="'.$k1.'" class="form-control"/></td>';
													}
												}
											}
											echo '</tr>';
											$i++;
										}
										?>
										<tr>
										 <td><div class="col-sm-10">
                                             <button type="submit" class="btn btn-info btn-fill center">Save</button>
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