<div class="main-panel">
<div class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-8">
                   <div class="card">
                       <div class="header">
                           <h4 class="title">Add Examination</h4>

                       </div>

                       <div class="content" style="padding-left:10%;">
                           <form method="post" action="<?php echo base_url(); ?>examination/create" class="form-horizontal" enctype="multipart/form-data" id="myformsection">

                                <fieldset>
                                        <div class="form-group">

                                            <label class="col-sm-2 control-label">Exam Year</label>
                                            <div class="col-sm-4">
             <select name="exam_year" required class="selectpicker" data-title="Select From & To Year" data-menu-style="dropdown-blue">
                                                  <?php
												  $query= "SELECT * FROM edu_academic_year";
												  $year=$this->db->query($query);
												  $row=$year->result();
												  foreach ($row as $rows1)
												  {

												    $fyear=$rows1->from_month;
    												$month= strtotime($fyear);

													$eyear=$rows1->to_month;
													$month1= strtotime($eyear);
  												  ?>
     <option value="<?php echo $rows1->year_id; ?>"><?php  echo  date('Y',$month); ?> (To) <?php  echo  date('Y',$month1); ?></option>
                                              <?php } ?>
                                          </select>
										  <!--<input type="text" name="exam_year" class="form-control datepicker" id="yexam" placeholder="Enter Exam Year" required value="">-->
                                            </div>

											 </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Exam Name</label>
                                           <div class="col-sm-4">
                                                <input type="text" name="exam_name" class="form-control" placeholder="Enter Exam Name" required value="">
                                            </div>
				                     </div>
                                    </fieldset>

          					 <fieldset>
                                        <div class="form-group">


											<label class="col-sm-2 control-label">&nbsp;</label>

                                            <div class="col-sm-4">
                                                   <button type="submit" id="save" class="btn btn-info btn-fill center">Save</button>
                                            </div>

                                            </div>
                                    </fieldset>

                             </form>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <?php if($this->session->flashdata('msg')): ?>
         <div class="alert alert-success">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
       ×</button> <?php echo $this->session->flashdata('msg'); ?>
</div>

<?php endif; ?>
       <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="content">

                                <div class="fresh-datatables">
                          <table id="bootstrap-table" class="table">
                              <thead>

                                <th>S.no</th>
                                <th>Exam Year</th>
								<th>Exam Name</th>
                                <th class="disabled-sorting text-right">Actions</th>
                              </thead>
                              <tbody>
                                <?php
                                $i=1;
                                foreach ($result as $rows) {
									               $fyear=$rows->from_month;
    												$month= strtotime($fyear);

													$eyear=$rows->to_month;
													$month1= strtotime($eyear);
                                ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php  echo  date('Y',$month); ?> (To) <?php  echo  date('Y',$month1); ?></td>
									 <td><?php echo $rows->exam_name; ?></td>
                                    <td class="text-right">
								<!--	<a href="<?php echo base_url(); ?>examination/add_exam_subject/<?php echo $rows->exam_id; ?>" rel="tooltip" title="Added Exam Details" class="btn btn-simple btn-info btn-icon table-action view" >
									<i class="fa fa-id-card-o" aria-hidden="true"></i></a> -->

                                      <a href="<?php echo base_url();  ?>examination/edit_exam/<?php echo $rows->exam_id; ?>" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>


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


</div>

<script type="text/javascript">

$(document).ready(function () {

 $('#myformsection').validate({ // initialize the plugin
     rules: {


         exam_year:{required:true },
         exam_name:{required:true },


     },
     messages: {


           exam_year: "Please Enter Section Name",
              exam_name: "Please Enter Exam name"


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
        $('#exammenu').addClass('collapse in');
        $('#exam').addClass('active');
        $('#exam1').addClass('active');

        $('.datepicker').datetimepicker({
          format: 'YYYY',
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
