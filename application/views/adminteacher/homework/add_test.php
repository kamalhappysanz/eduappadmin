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
                            <div class="content">
                                <div class="fresh-datatables">
                          <table id="bootstrap-table" class="table">
                              <thead>

                                <th>S.no</th>
								<th>Class/Section</th>
                                <th>Teacher</th>
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
                                ?>
                                  <tr>
								     <td><?php   echo $i; ?></td>
                                     <td><?php   echo $rows->class_id; ?></td>
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
									 </td>
									 <td><?php    echo $rows->hw_type; ?></td>
									  <td><?php   echo $rows->title; ?></td>
									 <td><?php    echo $rows->test_date	 ; ?></td>
									 <td><?php    echo $rows->hw_details; ?></td>
									 
									 	
                                    <td class="text-right">
								<!--	<a href="<?php // echo base_url(); ?>examination/add_exam_subject/<?php //echo $rows->exam_id; ?>" rel="tooltip" title="Added Exam Details" class="btn btn-simple btn-info btn-icon table-action view" >
									<i class="fa fa-id-card-o" aria-hidden="true"></i></a>

 <a href="<?php echo base_url();  ?>years/edit_terms/<?php echo $rows->term_id; ?>" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>									-->

                                     


                                      </td>
                                  </tr>
                                  <?php $i++;  }  ?>
                              </tbody>
                          </table>


                        </div>
                            </div><!-- end content-->
                        </div><!--  end card  -->
                    </div> <!-- end col-md-12 -->
                </div> <!-- end row -->

            </div>
        </div>

   </div>




<script type="text/javascript">

$(document).ready(function () {
$('#mastersmenu').addClass('collapse in');
$('#master').addClass('active');
$('#masters2').addClass('active');
 $('#myformsection').validate({ // initialize the plugin
     rules: {


         yexam:{required:true },


     },
     messages: {


           yexam: "Please Enter Section Name"


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
