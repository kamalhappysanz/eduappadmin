<div class="main-panel">
<div class="content">
       <div class="container-fluid">
         <div class="col-md-12">

<div class="col-md-6">
                   <div class="card">
                       <div class="header">
                           List Of Student in class
                       </div>
                       <div class="content table-full-width">
                           <table class="table table-striped">
                               <thead>
                                   <tr>
                                       <th class="text-center">#</th>
                                       <th>Name</th>

                                       <th class="text-right">Salary</th>
                                       <th class="text-right">Active</th>
                                   </tr>
                               </thead>
                               <tbody>
                                 <?php  $i=1; foreach($res as $rows){

                                    ?>
                                   <tr>
                                       <td class="text-center"><?php echo $i;  ?></td>

                                       <td><?php echo $rows->name;  ?></td>
                                       <td class="text-right">&euro; 99,225</td>
                                        <td class="text-right">
                                           <div class="switch"
                                                data-on-label=""
                                                data-off-label="">
                                                <input type="checkbox"/>
                                           </div>
                                       </td>
                                   </tr>

                            <?php
                            $i++; }

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
