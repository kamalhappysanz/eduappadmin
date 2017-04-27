<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-10">
               <div class="card">
                  <div class="header">
                     <h4 class="title">Teacher Class & Section</h4>
                  </div>
                  <div class="content">
                     <div class="row">
                        <?php
                           if(empty($class_id)){   ?>
                        <div class="col-md-2">
                           <p>No Records Found</p>
                        </div>
                        <?php  }  else{   ?>
                        <?php   $cnt= count($class_id);
                           for($i=0;$i<$cnt;$i++){
                           ?>
                        <div class="col-md-2">
                           <a rel="tooltip" href="" onclick="changeText(<?php echo $class_id[$i]; ?>)" data-toggle="modal" data-target="#addmodel" data-id="<?php echo $class_id[$i]; ?>"  class=" open-AddBookDialog  btn btn-wd"><?php echo $class_name[$i]."-".$sec_name[$i]; ?></a>
                        </div>
                        <?php  } }  ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- row -->
         <?php if($this->session->flashdata('msg')): ?>
         <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            ×</button> <?php echo $this->session->flashdata('msg'); ?>
         </div>
         <?php endif; ?>
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="content">
                     <div class="fresh-datatables">
                        <table id="bootstrap-table" class="table">
                           <thead>
                              <th>S.no</th>
                              <th>Teacher</th>
                              <th>Class/Section</th>
                              <th>Subject</th>
                              <th>Homework Type</th>
                              <th>Title</th>
                              <th>Test DATE</th>
                              <th>Details</th>
                              <th class="disabled-sorting text-right">Actions</th>
                           </thead>
                           <tbody>
                              <?php
                                 $i=1;
                                 foreach ($result as $rows) {
                                 $type=$rows->hw_type;
                                 $sta=$rows->homework;
								 
                                 
                                  ?>
                              <tr>
                                 <td><?php   echo $i; ?></td>
                                 <td>
                                    <?php 
                                       $id=$rows->teacher_id;
                                       $query="SELECT * FROM edu_teachers WHERE teacher_id='$id'";
                                       $resultset=$this->db->query($query);
                                       $row=$resultset->result();
                                       foreach($row as $rows1)
                                       {}
                                       $name=$rows1->name;
                                       ?>
                                    <?php    echo $name ; ?>
                                 </td><?php $cid=$rows->class_id;
                                            $query="SELECT * FROM edu_class WHERE class_id='$cid'";
											   $resultset=$this->db->query($query);
											   $row=$resultset->result();
											   foreach($row as $rows1)
											   {}								 ?>
                                 <td><?php echo $rows1->class_name; ?> - <?php echo $rows-> sec_name ?></td>
                                 <td><?php echo $rows->subject_name; ?></td>
                                 <td><?php echo $rows->hw_type; ?></td>
                                 <td><?php echo $rows->title; ?></td>
                                 <td><?php $date=date_create($rows->test_date);
                                    echo date_format($date,"d-m-Y");
                                    ?></td>
                                 <td><?php echo $rows->hw_details; ?></td>
                                 <!-- <td><?php //echo $sta;?></td> -->
                                 <td class="text-right">
                                    <?php if($sta==0 && $type=="Class Test")
                                       {?>
                                    <a href="<?php echo base_url();?>homework/add_mark/<?php echo $rows->hw_id; ?>" rel="tooltip" title="Add Mark Details" class="btn btn-simple btn-info btn-icon table-action view" >
                                    <i class="fa fa-list-ol" aria-hidden="true"></i></a>
                                    <?php }elseif($sta==1){?>  <a href="<?php echo base_url();?>homework/edit_mark/<?php echo $rows->hw_id; ?>" title="Edit Mark Details" rel="tooltip" class="btn btn-simple btn-warning btn-icon edit" style="color:red;"><i class="fa fa-id-card-o" aria-hidden="true"></i>	<?php }?>
                                    <a href="<?php echo base_url();?>homework/edit_test/<?php echo $rows->hw_id; ?>" title="Edit Mark Details" rel="tooltip" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i>	 
                                 </td>
                              </tr>
                              <?php $i++;  }  ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- end content-->
               </div>
               <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
         </div>
         <!-- end row -->
         <!--<div id="test" style="display: none" >  </div>-->
         <div class="modal fade" id="addmodel" role="dialog" >
            <div class="modal-dialog">
               <!-- Modal content-->
               <div class="modal-content">
                  <div class="modal-header" style="padding:10px;">
                     <button type="button" class="close" style="margin:25px;" data-dismiss="modal">&times;</button>
                     <h4 class="title">Home Work And Class Test</h4>
                  </div>
                  <div class="modal-body">
                     <p id="msg" style="text-align:center;"></p>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="card">
                              <div class="content">
                                 <form method="post" action="<?php echo base_url(); ?>homework/create" class="form-horizontal" enctype="multipart/form-data" id="classsection">
                                    <fieldset>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Type of Test</label>
                                          <div class="col-sm-10">
                                             <label class="radio">
                                             <input type="radio" data-toggle="radio" name="test_type" value="Class Test">Class Test
                                             </label>
                                             <label class="radio">
                                             <input type="radio" data-toggle="radio" name="test_type" value="Home Work">Home Work
                                             </label>
                                             <input type="hidden" id="event_id" name="class_id"  class="form-control" value="<?php ?>"/>
											 
											
											 
                                          </div>
                                       </div>
                                    </fieldset>hidden
                                    <fieldset>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Title</label>
                                          <div class="col-sm-6">
                                             <input type="text" placeholder="Title" name="title" class="form-control">
                                          </div>
                                       </div>
                                    </fieldset>
                                    <fieldset>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Subject</label>
                                          <div class="col-sm-6">
                                             <select id="ajaxres" name="subject_name"  class="form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                <option  value="">Select Subject</option>
                                             </select>
                                          </div>
                                       </div>
                                    </fieldset>
                                    <fieldset>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Date</label>
                                          <div class="col-sm-6">
                                             <input type="text" placeholder="Select Date" name="tet_date" class="form-control datepicker" >
                                          </div>
                                       </div>
                                    </fieldset>
                                    <fieldset>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Details</label>
                                          <div class="col-sm-6">
                                             <textarea name="details" class="form-control" rows="4" cols="80"></textarea>
                                          </div>
                                       </div>
                                    </fieldset>
                                    <fieldset>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">&nbsp;</label>
                                          <div class="col-sm-10">
                                             <button type="submit" class="btn btn-info btn-fill center">Save </button>
                                          </div>
                                       </div>
                                    </fieldset>
                                 </form>
                              </div>
                           </div>
                           <!--  end card  -->
                        </div>
                        <!-- end col-md-12 -->
                     </div>
                     <!-- end row -->
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
</script>
<script type="text/javascript">
   $().ready(function(){
   
     $('.datepicker').datetimepicker({
       format: 'DD-MM-YYYY',
       icons: {
           time: "fa fa-clock-o",
           date: "fa fa-calendar",
           up: "fa fa-chevron-up",
           down: "fa fa-chevron-down",
           previous: 'fa fa-chevron-left',
           next: 'fa fa-chevron-right',
           today: 'fa fa-screenshot',
           clear: 'fa fa-trash',
           close: 'fa fa-remove'
       }
    });
   });
</script>
<script type="text/javascript">
   function changeText(id) 
   {
    $('#myModal').modal('show');
    //alert(id);
       $.ajax({
             type: 'post',
             url: '<?php echo base_url(); ?>homework/checker',
             data: {
                 id:id
             },
           dataType: 'json',
   
            success: function(test1)
      {
   	    
   		
                 if (test1.status=='Success') {
                  
                     var sub = test1.subject_name;
   			//alert(sub.length);
                     var sub_id = test1.subject_id;
                     var len=sub.length;
   			//alert(len);
                     var i;
                     var name = '';
                   
                     for (i = 0; i < len; i++) {
                         name += '<option value='+ sub_id[i] +'>'+ sub[i] + '</option> ';
                         $("#ajaxres").html(name);
                         $('#msg').html('');
                     }
                 } else {
   			
   			$('#msg').html('<span style="color:red;text-align:center;">Subject Not Found</p>');
   			  $("#ajaxres").html('');
   
                 }  
             }
    
    
   });
   }
   
   $(document).on("click", ".open-AddBookDialog", function () {
      var eventId = $(this).data('id');
      $(".modal-body #event_id").val( eventId );
   });
   
</script>

