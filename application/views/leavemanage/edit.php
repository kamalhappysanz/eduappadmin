
<div class="main-panel">
<div class="content">
<div class="col-md-12">

                        <div class="card">
                            <div class="header">
                                <legend>Edit Regular Leave  </legend>

                            </div>
                            <?php if($this->session->flashdata('msg')): ?>
                              <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button> <?php echo $this->session->flashdata('msg'); ?>
                            </div>

                     <?php endif; ?>
                     <?php  foreach ($res as $rows) {
                      // print_r($res);
                     } ?>

                            <div class="content">
                                <form method="post" action="<?php echo base_url(); ?>leavemanage/update_regular" class="form-horizontal" enctype="multipart/form-data" id="leaveform" name="leaveform">
                                  <fieldset>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">Leave Type</label>

                                          <div class="col-sm-4">
                                              <input type="text" name="leave_type" class="form-control" placeholder="" readonly="" value="<?php echo $rows->leave_type; ?>"/>
                                              <input type="hidden" name="leave_id" class="form-control" placeholder="" readonly="" value="<?php echo $rows->leave_id; ?>"/>
                                                <input type="hidden" name="leave_masid" class="form-control" placeholder="" readonly="" value="<?php echo $rows->leave_mas_id; ?>"/>
                                          </div>

                                      </div>
                                  </fieldset>

                                  <fieldset id="">
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">Years</label>
                                          <div class="col-sm-4">
                                            <select name="years" id="years" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                <option value="2017">2017</option>
                                                <option value="2018">2018</option>
                                              <option value="2019">2019</option>
                                              <option value="2020">2020</option>

                                            </select>
                                              <script language="JavaScript">document.leaveform.years.value="<?php echo $rows->leave_year; ?>";</script>
                                          </div>
                                      </div>
                                  </fieldset>
                                  <fieldset id="">
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">Days</label>
                                          <div class="col-sm-4">
                                            <select name="days" id="days" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                <option value="Sunday">Sunday</option>
                                                <option value="Monday">Monday</option>
                                              <option value="Tuesday">Tuesday</option>
                                              <option value="Wednesday">Wednesday</option>
                                              <option value="Thursday">Thursday</option>
                                              <option value="Friday">Friday</option>
                                              <option value="Saturday">Saturday</option>
                                            </select>
                                            <script language="JavaScript">document.leaveform.days.value="<?php echo $rows->days; ?>";</script>
                                          </div>
                                      </div>
                                  </fieldset>
                                  <fieldset>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">Weeks</label>
                                          <div class="col-sm-4">
                                            <select name="weeks" id="weeks" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                            </select>
                                              <script language="JavaScript">document.leaveform.weeks.value="<?php echo $rows->week; ?>";</script>
                                          </div>
                                      </div>
                                  </fieldset>



                                    <fieldset id="">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Leave Status</label>
                                            <div class="col-sm-4">
                                              <select name="leave_status" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                <option value="A">Active</option>
                                                <option value="DA">De-Active</option>

                                              </select>
                                              <script language="JavaScript">document.leaveform.leave_status.value="<?php echo $rows->status; ?>";</script>

                                            </div>

                                        </div>
                                    </fieldset>
                                    <fieldset>

                                 <div id="div_name"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-10">
                                               <!-- <input type="button" id="more" value="Add more" /> -->
                                                   <button type="submit" class="btn btn-info btn-fill center">Update </button>
                                            </div>

                                        </div>
                                    </fieldset>
                                </form>

                            </div>

                        </div>  <!-- end card -->

                    </div>

</div>
</div>

<script type="text/javascript">

$('#eventmenu').addClass('collapse in');
$('#event').addClass('active');
$('#leave1').addClass('active');
</script>
