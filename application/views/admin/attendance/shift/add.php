<h3></h3>
<div class="container">
	<div class="col-sm-offset-3 col-sm-6">
    <div class="panel panel-default">
      <div class="panel-heading"><h4>Add/Edit Shift</h4></div>
      <div class="panel-body">
        <?php echo validation_errors(); ?>

        <?php echo form_open('', ['class'=>'form-horizontal']); ?>
        <div class="form-group">
          <label class="control-label col-sm-2">Label</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="label" value="<?php echo set_value('label'); ?>">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2">Start</label>
          <div class="col-sm-10" >
            <div class="input-group date" id='dtstart'>
              <input type="text" class="form-control" name="start" value="<?php echo set_value('start'); ?>">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
            </div> 
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2">End</label>
          <div class="col-sm-10" >
            <div class="input-group date" id='dtend'>
              <input type="text" class="form-control" name="end" value="<?php echo set_value('end'); ?>">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
            </div> 
          </div>
        </div>  

        <div class="form-group">
          <label class="control-label col-sm-2">Status</label>
          <div class="col-sm-10">
            <select class="form-control" name="status">
              <option value="" <?php echo set_select('status', ''); ?>></option>
              <option value="1" <?php echo set_select('status', 1); ?>>Active</option>
              <option value="0" <?php echo set_select('status', 0); ?>>Inactive</option>
            </select>
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


