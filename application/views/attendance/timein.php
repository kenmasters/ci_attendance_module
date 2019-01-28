<h3></h3>
<div class="container"> 
    <div class="panel panel-default">
      <div class="panel-heading"><h4>Time In</h4></div>
      <div class="panel-body">

        <?php echo form_open('', ['class'=>'form-horizontal']); ?>
        <div class="form-group">
          <label class="control-label col-sm-1" for="email">Date</label>
          <div class="col-sm-10">
            <input type="hidden" name="date" value="<?php echo $current_date; ?>">
            <label class="control-label"><?php echo $current_date; ?></label>

          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-1">Time</label>
          <div class="col-sm-10"> 
            <input type="hidden" name="time" value="<?php echo $current_time; ?>">
            <label class="control-label"><?php echo $current_time; ?>&nbsp;HH:MM</label>
          </div>
        </div>
        
        <div class="form-group">
          <label class="control-label col-sm-1" for="pwd">Note</label>
          <div class="col-sm-10"> 
            <textarea name="notes" class="form-control" rows="3"></textarea>
          </div>
        </div>
        <div class="form-group"> 
          <div class="col-sm-offset-1 col-sm-10">
            <?php echo form_submit('timein', 'Time In', ['class'=>'btn btn-default']); ?>
          </div>
        </div>
      <?php echo form_close(); ?>
      </div>
    </div>

    
</div>