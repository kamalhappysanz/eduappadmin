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
                                                    <?php  //echo $sect->exam_id; ?>
                                                        <option value="<?php  echo $sect->exam_id; ?>">
                                                            <?php  echo  date('Y',$month); ?> (To)
                                                                <?php  echo  date('Y',$month1); ?> (
                                                                    <?php  echo $sect->exam_name; ?>)</option>
                                                        <?php } ?>
                                            </select>

                                        </div>

                                        <label class="col-sm-2 control-label">Class</label>
                                        <div class="col-sm-4">
                                            <select name="class_name"  class="selectpicker" data-title="Select class" onchange="checknamefun(this.value)" >
                                                <?php foreach ($getall_class as $rows) {  ?>
                                                    <option value="<?php echo $rows->class_sec_id; ?>">
                                                        <?php echo $rows->class_name; ?>&nbsp; - &nbsp;
                                                            <?php echo $rows->sec_name; ?>
                                                    </option>
                                                    <?php      } ?>
                                            </select>
                                        </div>

                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group">
                         <p id="msg" style="text-align:center;"></p>
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-2">
                                            <div id="ajaxres"></div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div id="ajaxres1"></div>

                                        </div>

                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-2">
                                            <div id="ajaxres3"></div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div id="ajaxres2"></div>

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
                    ×</button>
                <?php echo $this->session->flashdata('msg'); ?>
            </div>

            <?php endif; ?>


                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">

                                    <div class="content">

                                        <div class="fresh-datatables">
										 <div class="col-sm-4">

                                            <select name="class_name" style="margin-top:30px;" class="selectpicker">
                                                 <?php     foreach ($result1 as $rows)
								             { ?> <option value=""><?php echo $rows->class_name;?>
                                                                    <?php echo $rows->sec_name; ?></option>
																	<?php } ?>
                                            </select>

                                        </div>
                                            <table id="bootstrap-table" class="table">

                                                <thead>
                                                    <th data-field="id" class="text-center">ID</th>
                                                    <th data-field="name" class="text-center" data-sortable="true"> Subject</th>
                                                    <th data-field="email" class="text-center" data-sortable="true">Exam Date</th>
                                                    <th data-field="mobile" class="text-center" data-sortable="true">Class/Section</th>
                                                    <th data-field="Section" class="text-center" data-sortable="true">Teacher</th>
                                                    <th class="text-center">Action</th>

                                                </thead>
                                                <tbody>
                                                    <?php
                                $i=1;
                                foreach ($result as $rows)
								 {
                                ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $i; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $rows->subject_name; ?>
                                                            </td>
                                                            <td>
                                                     <?php $date=date_create($rows->exam_date);
                                                       echo date_format($date,"d-m-Y");  ?> (<?php echo $rows->times; ?> ) </td>
                                                            <td>
                                                                <?php echo $rows->class_name;?>
                                                                    <?php echo $rows->sec_name; ?>
                                                            </td>
                                                            <?php
									 $id=$rows->teacher_id;
									 $query = "SELECT * FROM edu_teachers WHERE teacher_id='$id' ";
									 $resultset = $this->db->query($query);
									 $res=$resultset->result();
									 foreach($res as $row)
									 {
										 $name=$row->name;
									 }
									?>
                                                                <td>
                                                                    <?php echo $name; ?>
                                                                </td>
                                                                <td>
                                                                    <a href="<?php echo base_url(); ?>examination/edit_exam_details/<?php echo $rows->exam_detail_id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
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

                    </div>
                </div>

    </div>

</div>
<script type="text/javascript">
    function checknamefun(classid) {
        //alert(classid);
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>examination/checker',
            data: {
                classid:classid
            },
           dataType: 'json',

            success: function(test1) {
				//alert(test1.status);
				//console.log(test1);
				//var test=test1.status;
				//alert(test);
                if (test1.status=='Success') {

                    var sub = test1.subject_name;
					//alert(sub.length);
                    var sub_id = test1.subject_id;
                    var len=sub.length;
					//alert(len);
                    var i;
                    var name = '';
                    var exam_date = '';
                    var exam_secction = '';
                    var teacher = '';
                    for (i = 0; i < len; i++) {
                        name += '<input name="subject_name" type="text" required class="form-control"  value="' + sub[i] + '"><input name="subject_id[]" required type="hidden" class="form-control"  value="' + sub_id[i] + '"></br>';

                        exam_date += '<input type="text" required id="datepicker1" placeholder="Ender Exam Date" name="exam_date[]" class="form-control datePick" value=""></br>';

                        exam_secction += '<select name="time[]" required class="form-control" data-title="Select Time" data-style="btn-default btn-block" data-menu-style="dropdown-blue"><option value="">Select</option><option value="AM">AM</option><option value="PM">PM</option></select></br>';

                        teacher += '<select name="teacher_id[]" required id="teacher_id" class="form-control" ><option value="">Select Teacher</option><?php foreach ($teacheres as $rows) {  ?><option value="<?php echo $rows->teacher_id; ?>"><?php echo $rows->name; ?></option><?php  } ?></select></br>';

                        $("#ajaxres").html(name);
                        $("#ajaxres1").html(exam_date);
                        $("#ajaxres2").html(exam_secction);
                        $("#ajaxres3").html(teacher);
                        $('#msg').html('');
                    }
                } else {

					$('#msg').html('<span style="color:red;text-align:center;">Subject Not Found</p>');

					    $("#ajaxres").html('');
                        $("#ajaxres1").html('');
                        $("#ajaxres2").html('');
                        $("#ajaxres3").html('');
					//$('#examform')[0].reset();
                    //alert("Subject Not Found");
                }
            }
        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {

        $('#examform').validate({ // initialize the plugin
            rules: {
                exam_year: {required: true},
                class_name: {required: true},
                subject_name: {required: true},
                exam_date: {required: true},
                time: {required: true},
				teacher_id: {required: true}
            },
            messages: {
                exam_year: "Please Select Exam Year",
				class_name: "Please Select Class and Section Name",
				subject_name: "Please Select Subject Name",
				exam_date: "Please Enter Exam Date",
				time: "Please Select Time",
				teacher_id: "Please Select Teacher Name"
            }
        });
    });

    var $table = $('#bootstrap-table');
    $().ready(function() {
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
            pageList: [8, 10, 25, 50, 100],

            formatShowingRows: function(pageFrom, pageTo, totalRows) {
                //do nothing here, we don't want to show the text "showing x of y from..."
            },
            formatRecordsPerPage: function(pageNumber) {
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

        $(window).resize(function() {
            $table.bootstrapTable('resetView');
        });

    });
</script>
<script type="text/javascript">
    $().ready(function() {
        $('#exammenu').addClass('collapse in');
        $('#exam').addClass('active');
        $('#exam1').addClass('active');



        /*$('#datepicker').datepicker({
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
        }); */
    });


	$(function(){
    $(document).on("focusin",".datePick", function () {
		//alert("hi");
       $(this).datepicker({
            dateFormat: "dd/mm/yy",
            changeMonth: true,
            changeYear: true,
            onClose: function () { $(this).valid(); }
        });
    });
	    });
</script>
