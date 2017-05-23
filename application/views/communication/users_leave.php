

<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
	  <div class="col-md-12">
               <?php if($this->session->flashdata('msg')): ?>
         <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            ×</button> <?php echo $this->session->flashdata('msg'); ?>
         </div>
         <?php endif; ?>
         <div class="row">
            
               <div class="card">
                  <div class="header">
                     <legend> Users Leave Details</legend>
                  </div>
                  <div class="content">
                           <div class="fresh-datatables">
                        <table id="bootstrap-table" class="table">
                           <thead>
                              <th>S.no</th>
                              <th>Users Name</th>
                              <th>Leave Type</th>
                              <th>Leave Date</th>
                              <th>Leave Description</th>
                              <th>Status</th>
                              <th></th>
                           </thead>
                           <tbody>
                              <?php
                                 $i=1;
                                 foreach($result as $rows) 
								 { $status=$rows->status;
								 $type=$rows->leave_date;
                                  ?>
                              <tr>
                                 <td><?php   echo $i; ?></td>
                                  <td>
                                    <?php 
                                       $id=$rows->user_id;
                                       $query="SELECT * FROM edu_teachers WHERE teacher_id='$id'";
                                       $resultset=$this->db->query($query);
                                       $row=$resultset->result();
                                       foreach($row as $rows1)
                                       {}
                                       $name=$rows1->name;
                                       ?>
                                    <?php    echo $name ; ?>
                                 </td>
                                 <td><?php echo $rows->type_leave; ?></td>
                                 <td><?php $date=date_create($rows->leave_date);
                                     echo date_format($date,"d-m-Y");?> 
									 <?php if($type='Permission')
									 {?>
									 <?php echo $rows->frm_time; ?> <?php echo $rows->to_time; ?>
									 <?php }?>
									 </td>
                                 <td><?php echo $rows->leave_description; ?></td>
								 
                                 <td><?php if($status=='P'){ ?>
								 <button class="btn btn-warning btn-fill btn-wd">Pending </button>
								 <?php }else if($status=='R'){?>
								 <button class="btn btn-danger btn-fill btn-wd"> Reject</button>
								 <?php }else{ ?>
								   <button class="btn btn-success btn-fill btn-wd">Approval</button>
								 <?php }?>
								  </td>

                                 <td>
                           <a href="<?php echo base_url();?>communication/user_leave_approval/<?php echo $rows->leave_id; ?>" title="Edit Details" rel="tooltip" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit" aria-hidden="true"></i> 
                                 </td>
                              </tr>
                              <?php $i++;  }  ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
		 
		
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function () {
     $('#communcicationmenu').addClass('collapse in');
     $('#communication').addClass('active');
     $('#communication3').addClass('active');
    $('#myformsection').validate({ // initialize the plugin
       rules: {
         leave_type:{required:true },
   		 leave_date:{required:true },
   		 leave_description:{required:true },
        },
        messages: {
              leave_type:"Select Type Of Leave",
              leave_date:"Select Leave Date",
              leave_description:"Enter The Leave Description",
            }
    });
	demo.initFormExtendedDatetimepickers();
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




   $().ready(function(){

     $('.datepicker').datetimepicker({
       format: 'DD-MM-YYYY',
	    minDate: new Date(),
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
