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
          <legend>Time Table <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button></legend>

      </div>

      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <p>NO Data Found</p>

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
