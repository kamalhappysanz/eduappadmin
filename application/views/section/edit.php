<div class="main-panel">
<div class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-8">
                   <div class="card">
                       <div class="header">
                           <h4 class="title">Update Section</h4>
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
                           <form action="<?php echo base_url(); ?>sectionadd/save_section" method="post" enctype="multipart/form-data" id="myformsection">
                               <div class="row">
                                   <div class="col-md-5">
                                       <div class="form-group">
                                           <label>Name</label>
                                           <input type="text" class="form-control"  placeholder="" name="sectionname" id="sectionname" value="<?php  echo $rows->sec_name; ?>">
                                            <input type="hidden" class="form-control"  placeholder="" name="sec_id" value="<?php  echo $rows->sec_id; ?>">

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
  $('#mastersmenu').addClass('collapse in');
  $('#master').addClass('active');
  $('#masters3').addClass('active');


  $('#myformsection').validate({ // initialize the plugin
      rules: {


          sectionname:{required:true },


      },
      messages: {


            sectionname: "Please Enter Section Name"


          }
  });
 });





</script>
