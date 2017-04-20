<div class="main-panel">
<div class="content">
       <div class="container-fluid">
         <div class="col-md-12">

                        <div class="card">
                            <div class="header">List of Class For Attendence</div>
                            <div class="content">
                                <div class="row">
                              <?php

                                if(empty($class_id)){   ?>
                                <div class="col-md-2">  <p>No Records Found</p></div>
                                  <?php  }  else{   ?>
                                  <?php   $cnt= count($class_id);
                                   for($i=0;$i<$cnt;$i++){
                                   ?>
                               <div class="col-md-2">
                                     <a href="<?php echo $class_id[$i]; ?>" class="btn btn-wd"><?php echo $class_name[$i]."-".$sec_name[$i]; ?></a></div>


                              <?php  } }  ?>
                              </div>
                            </div>
                        </div> <!-- end card -->

          </div>
       </div>
   </div>
</div>

<script type="text/javascript">
 var $table = $('#bootstrap-table');
       $().ready(function(){
           $table.bootstrapTable({
               toolbar: ".toolbar",
               clickToSelect: true,
               showRefresh: true,
               search: true,
               showToggle: true,
               showColumns: true,
               pagination: true,
               searchAlign: 'left',
               pageSize: 8,
               clickToSelect: false,
               pageList: [8,10,25,50,100],

               formatShowingRows: function(pageFrom, pageTo, totalRows){
                   //do nothing here, we don't want to show the text "showing x of y from..."
               },
               formatRecordsPerPage: function(pageNumber){
                   return pageNumber + " rows visible";
               },
               icons: {
                   refresh: 'fa fa-refresh',
                   toggle: 'fa fa-th-list',
                   columns: 'fa fa-columns',
                   detailOpen: 'fa fa-plus-circle',
                   detailClose: 'fa fa-minus-circle'
               }
           });

           //activate the tooltips after the data table is initialized
           $('[rel="tooltip"]').tooltip();

           $(window).resize(function () {
               $table.bootstrapTable('resetView');
           });


       });


$(document).ready(function () {
  $('#classmenu').addClass('collapse in');
  $('#class').addClass('active');
  $('#class3').addClass('active');
 $('#myformclassmange').validate({ // initialize the plugin
     rules: {

          class_name:{required:true },
         section_name:{required:true },
     },
     messages: {
           class_name: "Select Class Name",
           section_name:"Select Section Name"

         }
 });
});




</script>
