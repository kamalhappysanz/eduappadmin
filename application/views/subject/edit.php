<div class="main-panel">
<div class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-8">
                   <div class="card">
                       <div class="header">
                           <h4 class="title">Update Subject</h4>
                           <?php if($this->session->flashdata('msg')): ?>
                             <div class="alert alert-success">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                   </div>

             <?php endif; ?>
                       </div>
                       <?php
                       foreach($datas as $rows){}

                          ?>
                       <div class="content">
                           <form action="<?php echo base_url(); ?>subjectadd/save_subject" method="post" enctype="multipart/form-data" id="myformsub">
                               <div class="row">
                                   <div class="col-md-5">
                                       <div class="form-group">
                                           <label>Name</label>
                                           <input type="text" class="form-control"  placeholder="" name="subjectname" value="<?php  echo $rows->subject_name; ?>">
                                           <input type="hidden" class="form-control"  placeholder="" name="subject_id" value="<?php  echo $rows->subject_id; ?>">

                                       </div>
                                   </div>
                               </div>
                           <button type="submit" class="btn btn-info btn-fill pull-left">Update</button>
                               <div class="clearfix"></div>
                           </form>
                       </div>
                   </div>
               </div>
           </div>
       </div>

   </div>


</div>

<script type="text/javascript">

$(document).ready(function () {
jQuery('#subjectmenu').addClass('collapse in');
$('#subject').addClass('active');
$('#subject1').addClass('active');

  $('#myformsub').validate({ // initialize the plugin
      rules: {


          subjectname:{required:true },


      },
      messages: {


            subjectname: "Please Enter Subject Name"


          }
  });
 });





</script>
