
<h3></h3>
<div class="container">
  <?php if ($this->session->flashdata('break_updated')) { ?>
  <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> <?php echo $this->session->flashdata('break_updated'); ?>
  </div>
  <?php } ?>
	<div class="col-sm-offset-3 col-sm-6">
    <div class="panel panel-default">
      <div class="panel-heading"><h4>Add/Edit Break</h4></div>
      <div class="panel-body">
        <?php echo form_open('', ['class'=>'form-horizontal']); ?>
        <div class="form-group">
          <label class="control-label col-sm-1" for="email">Type</label>
          <div class="col-sm-10">
          	<?php echo form_input('label', $break->label, 'class="form-control" required'); ?>
          </div>
        </div>
        <div class="form-group">
	        <div class="col-sm-offset-1 col-sm-10">
	          <div class="checkbox">
	            <label>
	              <?php echo form_checkbox('status', 1, $break->status,  'class="" id=""'); ?> Enable
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


