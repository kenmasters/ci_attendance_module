<h3></h3>
<div class="container">
	<?php if ($this->session->flashdata('break_deleted') || $this->session->flashdata('break_added')) { ?>
	<div class="alert alert-success alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Success!</strong> <?php echo $this->session->flashdata('break_deleted'); echo $this->session->flashdata('break_added'); ?>
	</div>
	<?php } ?>
    <div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="pull-left">All Breaks</h4><a href="<?=current_url()."/add"?>" class="pull-right btn btn-default">Add new</a>
			<div class="clearfix"></div>
		</div>
			<table class="table table-hover">
			<thead>
			  <tr>
			    <th>Type</th>
			    <th>Status</th>
			    <th>Action</th>
			  </tr>
			</thead>
			<tbody>
				<?php
				foreach ($break_types as $v) {
					?>
					<tr>
					  <td><?=$v->label;?></td>
					  <td><?=$v->status?'Active':'Inactive';?></td>
					  <td><a href="<?=current_url() . "/edit/{$v->id}";?>">Edit</a></td>
					</tr>
					<?php
				}
				?>
			</tbody>
			</table>
		</div>
    </div>
</div>


