<style>th{width:150px;}</style>
<div class="main-panel">
<div class="content">
<div class="col-md-12">

                        <div class="card">
                            <?php if($this->session->flashdata('msg')): ?>
                              <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button> <?php echo $this->session->flashdata('msg'); ?>
                     </div>
                     <?php endif; ?>
                   </div>
</div>


<div class="content">
  <div class="col-md-12">
    <div class="card">
      <div class="header">
          <legend>Time Table</legend>
          <button onclick="history.go(-1);" class="btn btn-wd btn-default">Go Back</button>
      </div>

      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
  <form method="post" action="<?php echo base_url(); ?>timetable/create_timetable" class="form-horizontal" enctype="multipart/form-data" id="timetableform">

                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                      <tr><th>Days</th>
                                    	<th>I</th>
                                    	<th>II</th>
                                    	<th>III</th>
                                    	<th>IV</th>
                                      <th>V</th>
                                      <th>VI</th>
                                      <th>VII</th>
                                      <th>VIII</th>
                                    </tr>
                                  </thead>
                                    <?php $prd= count($restime)/5; //echo  $restime[5]->subject_name; ?>
                                    <?php
$period = $prd;
$arr2=array('Mon','Tue','Wednes','Thurs','Friday');
?>

<tr>


</tr>
<?php
$k=0;
foreach($arr2 as $day){

  for($i=1;$i <= 5; $i++){

    ?>
    <tr>
        <th><?php echo $day; ?></th>
        <?php
        for($i=1;$i <= $period; $i++){
            ?>

            <td>
              <?php echo  $restime[$k]->subject_name;  ?>

                <?php echo "<br>";  echo  $restime[$k]->name;  ?>

            </td>
            <?php
$k++;
        }
      }

}
        ?>
        </tr>

    <?php


?>


                                </table>

                            </div>

                                                        </form>
                        </div>
          </div>
          </div>
      </div>
    </div>
  </div>
</div>
<script>
jQuery('#timetablemenu').addClass('collapse in');
$('#time').addClass('active');
$('#time2').addClass('active');
</script>
