<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="header">
                     <h4 class="title">Class & Section</h4>
                  </div>
                  <div class="content">
                     <div class="row">
                        <?php
                           if(empty($cls)){   ?>
                        <div class="col-md-2">
                           <p>No Records Found</p>
                        </div>
                        <?php  }  else{ 
                                  foreach($cls as $rows){
 					 ?>
                        
                        <div class="col-md-2">
                           <a rel="tooltip" href="" class="btn btn-wd"><?php echo $rows->classmaster_id; ?></a>
                        </div>
                        <?php  } }  ?>
						
						
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- row -->
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function () {
   $('#mastersmenu').addClass('collapse in');
   $('#master').addClass('active');
   $('#masters2').addClass('active');
    $('#classsection').validate({ // initialize the plugin
        rules: {
            test_type:{required:true },
			title:{required:true },
			subject_name:{required:true },
			tet_date:{required:true },
			details:{required:true },
			class_id:{required:true }
        },
        messages: {
              test_type: "Please Select Type Of Test",
			  title: "Please Enter Title Name",
			  subject_name: "Please Select Subject Name",
			  tet_date: "Please Select Date",
			  details: "Please Enter Details",
			  class_id: "Please Enter Class Name"

            }
    });
   });
   
</script>



