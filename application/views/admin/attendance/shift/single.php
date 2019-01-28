<h3></h3>
<div class="container">
	<div class="col-sm-offset-3 col-sm-6">
    <div class="panel panel-default">
      <div class="panel-heading"><h4>Add/Edit Shift</h4></div>
      <div class="panel-body">
        <?php echo form_open('', ['class'=>'form-horizontal']); ?>
        <div class="form-group">
          <label class="control-label col-sm-1">Employee</label>
          <div class="col-sm-10">
          	
          </div>
        </div>
        <div class="form-group">
	        <div class="col-sm-offset-1 col-sm-10">
	          <div class="checkbox">
	            <label>
	              <?php echo form_checkbox('active', '1', $break_type->active,  'class="" id=""'); ?> Enable
	            </label>
	          </div>
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


