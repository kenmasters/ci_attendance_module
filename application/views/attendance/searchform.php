<div class="panel panel-default">
  <div class="panel-heading">Search</div>
  <div class="panel-body">
    <?php echo form_open('', 'method="GET" class="form-inline form"'); ?>
      <div class="form-group">
        <div class="input-group date" id="minDate">
          <input name="min" type="text" class="form-control" placeholder="From date" value="<?=isset($_GET['min'])?$_GET['min']:'';?>">
          <span class="input-group-addon">
              <span class="glyphicon glyphicon-time"></span>
          </span>
        </div>
      </div>
      <div class="form-group">
        <div class="input-group date" id="maxDate">
        <input name="max" type="text" class="form-control" placeholder="To date" value="<?=isset($_GET['max'])?$_GET['max']:'';?>">
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-time"></span>
        </span>
        </div>
      </div>
      <button type="submit" class="btn btn-default">Search</button>
      <a href="<?=current_url();?>" class="btn btn-disabled">Reset</a>
    <?php echo form_close(); ?>
  </div>
</div>