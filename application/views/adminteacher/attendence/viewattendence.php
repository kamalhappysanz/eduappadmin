<style>
.txt{
  font-weight: 200;
}
</style>
<div class="main-panel">
<div class="content">
       <div class="container-fluid">
         <div class="col-md-12">

<div class="col-md-10">

                   <div class="card">
                       <div class="header">
                           <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button>

                       <div class="content table-full-width">

                              <table id="bootstrap-table" class="table">
                               <thead>
                                   <tr>
                                       <th class="text-center">S.No</th>
                                       <th class="text-center">Name</th>
                                        <!-- <th  data-field="email" class="text-center" data-sortable="true">Attendence Date</th> -->
                                       <th class="text-center">Status</th>
                                   </tr>
                               </thead>
                               <tbody>
                                 <?php  $i=1;
                                 foreach($result as $rows){
                                    ?>
                                   <tr>
                                       <td class="text-center"><?php echo $i;  ?></td>

                                       <td class="text-center  txt" ><?php echo $rows->name; ?></td>

                                        <td class="text-center"><?php $stat=$rows->a_status;
                                          if(empty($stat)){ ?> <button class="btn btn-success btn-fill btn-wd">Present</button> <?php }else{ ?> <button class="btn btn-danger btn-fill btn-wd">Absent</button> <?php }

                                         ?></td>

                                   </tr>

                            <?php
                            $i++;
}
                            ?>

                               </tbody>

                           </table>



                       </div>
                   </div>
               </div>

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
                    showRefresh: false,
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
            $('#admissionmenu').addClass('collapse in');
            $('#admission').addClass('active');
            $('#admission3').addClass('active');
     </script>
