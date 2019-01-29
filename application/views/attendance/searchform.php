
<div class="panel panel-default">
  <div class="panel-heading">Search</div>
  <div class="panel-body">
    <?php echo form_open('', 'class="form-inline"'); ?>
      <div class="form-group">
        <label for="email">Start Date</label>
        <input type="email" class="form-control" id="email">
      </div>
      <div class="form-group">
        <label for="pwd">End Date:</label>
        <input type="password" class="form-control" id="pwd">
      </div>
      <button type="submit" class="btn btn-default">Search</button>
    <?php echo form_close(); ?>
  </div>
</div>
  
