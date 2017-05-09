<div class="main-panel">
<div class="content">
       <div class="container-fluid">
         <div class="col-md-12">

<div class="col-md-6">
  <?php  if($status=="success"){ ?>
                   <div class="card">
                       <div class="header">
                           List Of Student in class
                       </div>
                       <?php

                        if(empty($res)){   ?>
                           <p class="text-center" style="margin-top:20px;">No Record Found</p>
                      <?php     }else{ ?>

                       <div class="content table-full-width">
                         <form action="<?php echo base_url(); ?>teacherattendence/take_attendence" method="post" enctype="multipart/form-data">
                           <table class="table table-striped">
                               <thead>
                                   <tr>
                                       <th class="text-center">#</th>
                                       <th class="text-center">Name</th>


                                       <th class="text-center">Present  / Absent</th>
                                   </tr>
                               </thead>
                               <tbody>
                                 <?php  $i=1;


                                 foreach($res as $rows){

                                    ?>
                                   <tr>
                                       <td class="text-center"><?php echo $i;  ?></td>

       <td class="text-center"><?php echo $rows->name;  ?> <input type="hidden" name="student_id[]" value="<?php echo $rows->enroll_id; ?>">
         <input type="hidden" name="class_id[]" value="<?php echo $class_id; ?>">
          <input type="hidden" name="user_id[]" value="<?php echo $user_id=$this->session->userdata('user_id'); ?>">

                                       </td>

                                        <td class="text-center">
                                           <div class="switch"
                                                data-on-label=""
                                                data-off-label="" onclick="addfunction()">
                                                <input type="checkbox" name="attendence_val[]" value="A,<?php echo $rows->enroll_id; ?>,<?php
$dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
echo $dateTime->format("A");
?>"/>
                                           </div>
                                       </td>
                                   </tr>

                            <?php
                            $i++; } }

                            ?>

                               </tbody>

                           </table>
                          <input type="submit" value="submit Attendnce" class="btn btn-warning btn-fill btn-wd pull-right" style="margin-top:20px;">
                         </form>

                       </div>
                   </div>
                   <?php  } else{  ?>
                     <div class="card-header" data-background-color="purple">
	                        <h4 class="title">Sorry</h4>
	                        <p class="category"><?php echo $status; ?> </p>
	                    </div>

                  <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button>
                  <?php  } ?>
               </div>

               </div>
            </div>
        </div>
     </div>


<script type="text/javascript">
// function addfunction(){
//   alert("hi");
// }
</script>
