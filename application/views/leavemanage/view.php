<div class="main-panel">
  <div class="content">
    <?php if($this->session->flashdata('msg')): ?>
      <div class="alert alert-success">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
    ×</button> <?php echo $this->session->flashdata('msg'); ?>
    </div>

<?php endif; ?>
    <div class="col-md-12">
      <div class="card">
        <div class="content">
          <p>Regular Holiday</p>
          <table id="bootstrap-table" class="table">
              <thead>
                    <th data-field="id">S.No</th>
                    <th data-field="year">Year</th>
                    <th data-field="no">Day</th>
                    <th data-field="name">On week</th>
                    <th data-field="status">Status</th>
                    <th data-field="Section">Action</th>
              </thead>
              <tbody>
                <?php
                $i=1;
                //print_r($regular);
                foreach ($regular as $rows) {

                ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                      <td><?php echo $rows->leave_year; ?></td>
                      <td><?php echo $rows->day; ?></td>
                        <td><?php echo $rows->on_week; ?></td>
                      <td><?php  if($rows->status=='A'){ ?>
                        <button class="btn btn-success btn-fill btn-wd">Active</button>
                    <?php  }else{  ?>
                      <button class="btn btn-danger btn-fill btn-wd">De-Active</button>
                    <?php  } ?></td>
                    <td>
                      <!-- <a rel="tooltip" title="View" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)"><i class="fa fa-image"></i>
                        </a> -->
                      <a href="<?php echo base_url(); ?>leavemanage/edit/<?php echo $rows->id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                      <a href="<?php echo base_url(); ?>leavemanage/viewdates/<?php echo $rows->leave_masid; ?>" rel="tooltip" title="View Dates" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-list-ol" aria-hidden="true"></i></a>



                      <a rel="tooltip" title="" class="btn btn-simple btn-danger btn-icon table-action remove" href="javascript:void(0)" data-original-title="Remove"><i class="fa fa-remove"></i></a>

                        </td>
                  </tr>
                  <?php $i++;  }  ?>
              </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="card">
        <div class="content">
          <p>Special Holiday</p>
          <table id="bootstrap-table1" class="table">
              <thead>
                    <th data-field="id">S.No</th>
                    <th data-field="year">Leave Type</th>
                    <th data-field="no">Leave Date</th>
                    <th data-field="name">Leave Name</th>
                    <th data-field="status">Status</th>
                    <th data-field="Section">Action</th>
              </thead>
              <tbody>
                <?php
                $i=1;
                //print_r($regular);
                foreach ($special as $rows) {

                ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                      <td><?php echo $rows->leave_type; ?></td>
                      <td><?php $date=date_create($rows->leave_date);
                      echo date_format($date,"d-m-Y");  ?></td>
                        <td><?php echo $rows->leaves_name; ?></td>
                        <td><?php  if($rows->status=='A'){ ?>
                          <button class="btn btn-success btn-fill btn-wd">Active</button>
                      <?php  }else{  ?>
                        <button class="btn btn-danger btn-fill btn-wd">De-Active</button>
                      <?php  } ?></td>
                    <td>

  <a href="<?php echo base_url(); ?>leavemanage/specialedit/<?php echo $rows->id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
  <a rel="tooltip" title="" class="btn btn-simple btn-danger btn-icon table-action remove" href="javascript:void(0)" data-original-title="Remove"><i class="fa fa-remove"></i></a>
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
<script type="text/javascript">
var $table = $('#bootstrap-table');
      $().ready(function(){
        //  jQuery('#enrollmentmenu').addClass('collapse in');
        //  $('#enroll').addClass('active');
        //  $('#enroll2').addClass('active');
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
      var $table = $('#bootstrap-table1');
            $().ready(function(){
              //  jQuery('#enrollmentmenu').addClass('collapse in');
              //  $('#enroll').addClass('active');
              //  $('#enroll2').addClass('active');
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
