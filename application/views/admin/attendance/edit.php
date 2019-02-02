<h3></h3>
<div class="container">
  <?php if ($this->session->flashdata('record_updated')) { ?>
  <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> <?php echo $this->session->flashdata('record_updated'); ?>
  </div>
  <?php } ?>
	<div class="col-sm-12">
    <div class="panel panel-default">
      <div class="panel-heading"><h4>Edit</h4></div>
      <div class="panel-body">
        <?php echo validation_errors(); ?>
        <?php echo form_open('', ['class'=>'form-horizontal']); ?>
        <div class="form-group">
          <label class="control-label col-sm-2">Time In</label>
          <div class="col-sm-10" >
            <div class="input-group date" id='timein'>
              <input type="text" class="form-control" name="timein" value="<?=nice_date(unix_to_human($attendance->timein), 'm/d/Y H:s A');?>">
              <span class="input-group-addon">
                  <span class="glyphicon glyphicon-time"></span>
              </span>
            </div> 
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2">Time In Notes</label>
          <div class="col-sm-10">
            <textarea rows="3" class="form-control" name="timein_notes" placeholder="Additional timein notes"><?=$attendance->timein_note?></textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2">Time Out</label>
          <div class="col-sm-10" >
            <div class="input-group date" id='timeout'>
              <input type="text" class="form-control" name="timeout" value="<?=nice_date(unix_to_human($attendance->timeout), 'm/d/Y H:s A');?>">
              <span class="input-group-addon">
                  <span class="glyphicon glyphicon-time"></span>
              </span>
            </div> 
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2">Time Out Notes</label>
          <div class="col-sm-10">
            <textarea rows="3" class="form-control" name="timeout_notes" placeholder="Additional timeout notes"><?=$attendance->timeout_note?></textarea>
          </div>
        </div>
 
        <div class="form-group"> 
          <div class="col-sm-offset-1 col-sm-10">
            <?php echo form_submit('', 'Save', ['class'=>'btn btn-default']); ?>
          </div>
        </div>
      <?php echo form_close(); ?>
      </div>
    </div>
   </div> 
</div>


