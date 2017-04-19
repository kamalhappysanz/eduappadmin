<div class="main-panel">
<div class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-12">
                   <div class="card">
                       <div class="header">
                           <h4 class="title">Examination Calender</h4>

                       </div>

                       <div class="content">
                            <form method="post" action="<?php echo base_url(); ?>examination/add_exam_details" class="form-horizontal" enctype="multipart/form-data" id="examform">
								 <fieldset>
                                        <div class="form-group">

                                            <label class="col-sm-2 control-label">Exam</label>
                                            <div class="col-sm-4">

											 <select name="exam_year" class="selectpicker" data-title="Select Exam Year" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                  <?php foreach ($year as $sect)
												  {
													  $fyear=$sect->from_month;
    												$month= strtotime($fyear);

													$eyear=$sect->to_month;
													$month1= strtotime($eyear);
													  ?>
												  <?php  echo $sect->exam_id; ?>
                                              <option value="<?php  echo $sect->exam_id; ?>"><?php  echo  date('Y',$month); ?> (To) <?php  echo  date('Y',$month1); ?> (<?php  echo $sect->exam_name; ?>)</option>
                                              <?php } ?>
                                          </select>

                                            </div>

											    <label class="col-sm-2 control-label">Class </label>
                                            <div class="col-sm-4">
											 <select name="class_name" class="selectpicker" data-title="Select class" data-style="btn-default btn-block" data-menu-style="dropdown-blue">


                                       <?php foreach ($getall_class as $rows) {  ?>
                                      <option value="<?php echo $rows->class_sec_id; ?>"><?php echo $rows->class_name; ?>&nbsp; - &nbsp;<?php echo $rows->sec_name; ?></option>
                                        <?php      } ?>
                                                  </select>
                                            </div>
                                           <!--  <label class="col-sm-2 control-label">Exam Name</label>
                                           <div class="col-sm-4">

										   <select name="exam_name" class="selectpicker" data-title="Select Exam Name" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                  <?php foreach ($result as $sect) {  ?>
                                              <option value="<?php // echo $sect->exam_id; ?>"><?php  //echo $sect->exam_name; ?></option>
                                              <?php } ?>
                                          </select>


                                            </div>-->
				                     </div>
                                    </fieldset>
                                   <fieldset>
                                        <div class="form-group">
             <input type="hidden" name="exam_id" class="form-control" placeholder="" >

                                            <label class="col-sm-2 control-label">Select Subject</label>
                                            <div class="col-sm-4">
                                               <select name="subject_name" class="selectpicker" data-title="Select Subject" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                  <?php foreach ($sec as $sect) {  ?>
                                              <option value="<?php  echo $sect->subject_id; ?>"><?php  echo $sect->subject_name; ?></option>
                                              <?php } ?>
                                          </select>
                                            </div>

                                            <label class="col-sm-2 control-label">Exam Date</label>
                                           <div class="col-sm-4">
                  <input type="text" name="exam_date" class="form-control datepicker"  placeholder="Enter Exam Date" value="">
                                            </div>
				                     </div>

                                    </fieldset>


								   <fieldset>
                                        <div class="form-group">


                                          <label class="col-sm-2 control-label">Notes</label>
                                            <div class="col-sm-4">
                                        <textarea name="notes" class="form-control" rows="4" cols="80"></textarea>
                                            </div>

                                        </div>
                                    </fieldset>


									 <fieldset>
                                        <div class="form-group">

											<label class="col-sm-2 control-label">&nbsp;</label>

                                            <div class="col-sm-4">
                                       <button type="submit" id="save" class="btn btn-info btn-fill center">Save </button>
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
                                <th data-field="id" class="text-center">ID</th>
                                <th data-field="name" class="text-center" data-sortable="true">	Subject</th>
                                <th data-field="email" class="text-center" data-sortable="true">Exam Date</th>
                                <th data-field="mobile" class="text-center" data-sortable="true">Class/Section</th>
                                <th data-field="Section" class="text-center" data-sortable="true">Notes</th>
								<th class="text-center" >Action</th>

                              </thead>
                              <tbody>
                                <?php
                                $i=1;
                                foreach ($result as $rows)
								 {
                                ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $rows->subject_name; ?></td>
                                    <td><?php $date=date_create($rows->exam_date);
echo date_format($date,"d-m-Y");  ?></td>
                                    <td><?php echo $rows->class_name;?><?php echo $rows->sec_name; ?></td>
									<td><?php echo $rows->notes; ?></td>
                                    <td>
   <a href="<?php echo base_url(); ?>examination/edit_exam_details/<?php echo $rows->exam_detail_id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
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
        $('#exammenu').addClass('collapse in');
        $('#exam').addClass('active');
        $('#exam1').addClass('active');

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
