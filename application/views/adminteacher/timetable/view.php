<style>th{width:150px;} .txt{background-color: greenyellow;
    color: red;
    font-weight: 700;}</style>
<div class="main-panel">
<div class="content">
<div class="col-md-12">


                            <?php if($this->session->flashdata('msg')): ?>
                              <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button> <?php echo $this->session->flashdata('msg'); ?>
                     </div>
                     <?php endif; ?>

</div>


<div class="content">
  <div class="col-md-12">
    <div class="card">
      <div class="header">
          <legend>Time Table<button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button> <a href="<?php echo base_url(); ?>teachertimetable/reviewview" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go To Review</a></legend>

      </div>

      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
  <!-- <form method="post" action="<?php echo base_url(); ?>timetable/create_timetable" class="form-horizontal" enctype="multipart/form-data" id="timetableform"> -->

                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                      <tr><th>Days</th>
                                    	<th>I</th>
                                    	<th>II</th>
                                    	<th>III</th>
                                    	<th>IV</th>
                                      <th>V</th>
                                      <th>VI</th>
                                      <th>VII</th>
                                      <th>VIII</th>
                                    </tr>
                                  </thead>
                                    <?php
                                  //  print_r($data['restime']['time']);exit;
                                    //print_r($restime);exit;

                                    $prd= count($restime)/5; //echo  $restime[5]->subject_name; ?>
                                    <?php
$period = $prd;
$arr2=array('Mon','Tue','Wednes','Thurs','Friday');
?>

<tr>


</tr>
<?php
$k=0;
foreach($arr2 as $day){

  for($i=1;$i <= 5; $i++){

    ?>
    <tr>
        <th><?php echo $day; ?></th>
        <?php
        for($i=1;$i <= $period; $i++){
            ?>

            <td <?php $t_name =$restime[$k]->name;  $name=$this->session->userdata('name'); if ($name==$t_name){ echo "class=txt"; } ?>>
              <?php echo  $restime[$k]->subject_name;  ?>

                <?php echo "<br>";  echo  $restime[$k]->name;  ?>

            </td>
            <?php
$k++;
        }
      }

}
        ?>
        </tr>

    <?php


?>


                                </table>

                            </div>

                                                        <!-- </form> -->
                        </div>
          </div>
          </div>
      </div>



      <div class="content">
      <div class="row">
        <div class="col-md-6">

                        <div class="card">
                            <div class="header">ReView form</div>
                            <div class="content">
                                <form method="post" action="" id="timetablereviewform">
                                    <div class="form-group">
                                        <label>Current date</label>
                                  <input type="text" placeholder="" name="cur_date" class="form-control" value="<?php $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                             echo $date->format('d-m-Y h:i:s'); ?>" readonly="">
                             <input type="hidden" placeholder="" name="class_id" class="form-control" value="<?php echo $class_id; ?>">
                             <input type="hidden" placeholder="" name="user_id" class="form-control" value="<?php echo $user_id; ?>">
                              <input type="hidden" placeholder="" name="user_type" class="form-control" value="<?php echo $user_type; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Subject</label>
                                          <?php  $sat=$subres['status']; if($sat=="success"){ $subres['status']; $sub_name=$subres['subject_name'];  $sub_id=$subres['subject_id'];  $len=count($sub_name);  ?>
                                        <select   name="subject_id" class="selectpicker" data-title="Select Subject" data-style="btn-block"  data-menu-style="dropdown-blue">
                                          <?php   for($i=0;$i<$len;$i++) { ?>

                                            <option value="<?php  echo $sub_id[$i]; ?>"><?php   echo $sub_name[$i]; ?></option>

                                        <?php  } } else{  ?>
                                            <option value="">No Data</option>
                                        <?php  }?>
                                 </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Comments</label>
                                        <textarea id="comments" name="comments" class="form-control"></textarea>
                                    </div>



                                    <button type="submit" class="btn btn-fill btn-info">Submit</button>
                                </form>
                            </div>
                        </div> <!-- end card -->

                    </div>
      </div>
      </div>
    </div>
  </div>
</div>
<script>
$('#timetablereviewform').validate({ // initialize the plugin
    rules: {
        subject_id:{required:true },
        comments:{required:true },
    },
    messages: {
          comments: "Please Enter Comments",
          subject_id:"Select Subject"
        },
      submitHandler: function(form) {
        //alert("hi");
        swal({
                      title: "Are you sure?",
                      text: "You Want Confrim this form",
                      type: "success",
                      showCancelButton: true,
                      confirmButtonColor: '#DD6B55',
                      confirmButtonText: 'Yes, I am sure!',
                      cancelButtonText: "No, cancel it!",
                      closeOnConfirm: false,
                      closeOnCancel: false
                  },
                  function(isConfirm) {
                      if (isConfirm) {
       $.ajax({
           url: "<?php echo base_url(); ?>teachertimetable/review",
            type:'POST',
           data: $('#timetablereviewform').serialize(),
           success: function(response) {
               if(response=="success"){
                //  swal("Success!", "Thanks for Your Note!", "success");
                  $('#timetablereviewform')[0].reset();
                  swal({
           title: "Wow!",
           text: "Message!",
           type: "success"
       }, function() {
           window.location = "<?php echo base_url(); ?>teachertimetable/reviewview";
       });
               }else{
                 sweetAlert("Oops...", "Something went wrong!", "error");
               }
           }
       });
     }else{
         swal("Cancelled", "Process Cancel :)", "error");
     }
   });
}
});


</script>
