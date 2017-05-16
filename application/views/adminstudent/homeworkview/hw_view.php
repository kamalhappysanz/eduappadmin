<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="header">
                     <h4 class="title">Homework & Class Test</h4>
                  </div>
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
                              <th>View Marks </th>
                           </thead>
                           <tbody>
                              <?php
                                 $i=1;
                                 foreach ($result as $rows) 
								 {
                                 $type=$rows->hw_type;
                                 $sta=$rows->mark_status;
								 $hw=$rows->hw_type;
                                  ?>
                              <tr>
                                 <td><?php   echo $i; ?></td>
                                <td>
                                    <?php 
                                       $id=$rows->teacher_id;
                                       $query="SELECT name,teacher_id FROM edu_teachers WHERE teacher_id='$id'";
                                       $resultset=$this->db->query($query);
                                       $row=$resultset->result();
                                       echo $row[0]->name;//echo $rows->hw_id; ?>
							  </td>
                                 <td><?php echo $rows->class_name; ?> - <?php echo $rows->sec_name ;?></td>
                                 <td><?php $su=$rows->subject_id;
                                       $sub="SELECT * FROM edu_subject WHERE subject_id='$su'";
                                       $result=$this->db->query($sub);
                                       $row=$result->result();
                                       echo $row[0]->subject_name;

								 ?></td>
                                 <td><?php if($hw=="HT")
								 {echo "Class Test";}else{ echo "Home Work";}?></td>
                                 <td><?php echo $rows->title; ?></td>
                                 <td><?php $date=date_create($rows->test_date);
                                    echo date_format($date,"d-m-Y");
                                    ?></td>
                                 <td><?php echo $rows->hw_details; ?></td>
                                 <!-- <td><?php //echo $sta;?></td> -->
                                 <td>
                                    <?php if($sta==0 && $type=="HT")
                                       {?>
                                    <a href="" rel="tooltip" title="Doesn't Add Mark Details" class="btn btn-simple btn-info btn-icon table-action view" >
                                    <i class="fa fa-id-card-o" aria-hidden="true"></i></a>
                                    <?php }elseif($sta==1){?> <a href="<?php echo base_url();?>student/view_mark/<?php echo $rows->hw_id; ?>" title="View Mark Details" rel="tooltip" class="btn btn-simple btn-warning btn-icon edit" style="color:red;"><i class="fa fa-id-card-o" aria-hidden="true"></i></a>	<?php }?>
                                    <!--<a href="<?php echo base_url();?>homework/edit_test/<?php //echo $rows->hw_id; ?>" title="Edit Mark Details" rel="tooltip" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i>
                                    </a>-->									
                                 </td>
                              </tr>
                              <?php $i++;  }  ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  </div>
               </div>
            </div> <!-- row -->
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
