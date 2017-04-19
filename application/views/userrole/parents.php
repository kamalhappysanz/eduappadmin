<div class="main-panel">
<div class="content">

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

                              <h4 class="title">List of Parents</h4>


                                <div class="fresh-datatables">


                          <table id="bootstrap-table" class="table">
                              <thead>

                                  <th data-field="id" class="text-center">S.No</th>
                                    <th data-field="year" class="text-center" data-sortable="true"> Name</th>
                                      <th data-field="no" class="text-center" data-sortable="true">Username</th>
                                <th data-field="name" class="text-center" data-sortable="true">Created Date</th>

                                <th data-field="status" class="text-center" data-sortable="true">Status</th>
                                <th data-field="Section" class="text-center" data-sortable="true">Action</th>


                              </thead>
                              <tbody>
                                <?php
                                $i=1;
                                foreach ($parents as $rows) {

                                ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $rows->name; ?></td>
                                    <td><?php echo $rows->user_name; ?></td>

                                    <td><?php echo  $new_date = date('d-m-Y - h:i', strtotime($rows->created_date)); ?></td>


                                      <td>
                                        <?php if($rows->status=='A'){ ?>
                                          <button class="btn btn-success btn-fill btn-wd">Active</button>
                                      <?php  }else{ ?>
                                        <button class="btn btn-danger btn-fill btn-wd">De-Active</button>
                                      <?php } ?></td>
                                    <td>



                                      <a href="<?php echo base_url(); ?>userrolemanage/get_user_parents/<?php echo $rows->user_id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
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
 var $table = $('#bootstrap-table');
       $().ready(function(){
         $('#usermanagement').addClass('collapse in');
         $('#user').addClass('active');
         $('#user2').addClass('active');
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
