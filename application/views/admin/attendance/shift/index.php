<h3></h3>
<div class="container">
	<?php if ($this->session->flashdata('shift_deleted') || $this->session->flashdata('shift_added')) { ?>
	<div class="alert alert-success alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Success!</strong> <?php echo $this->session->flashdata('shift_deleted'); echo $this->session->flashdata('shift_added'); ?>
	</div>
	<?php } ?>

    <div class="panel panel-default">
		<div class="panel-heading">
			<div><h4 class="pull-left"><strong>All Shifts</strong></h4><a href="<?=current_url()."/add"?>" class="pull-right btn btn-default">Add new</a></div>
			<div class="clearfix"></div>
		</div>
			<table class="table table-hover">
			<thead>
			  <tr>
			    <th>Label</th>
			    <th>Status</th>
			    <th>Start</th>
			    <th>End</th>
			  </tr>
			</thead>
			<tbody>
			<?php
			if ($shifts) {
				foreach ($shifts as $v) {
					?>
					<tr>
					  <td><?=$v->label;?></td>
					  <td><?=$v->status?'Active':'Inactive';?></td>
					  <td><?=$v->start;?></td>
					  <td><?=$v->end;?></td>
					  <td><a href="<?=current_url() ."/edit/{$v->id}" ?>">Edit</a></td>
					</tr>
					<?php
				}
			} else {
				?>
				<tr>
				  <td class="text-center" colspan="4">No result found</td>
				</tr>
				<?php
			}
			
			?>
			</tbody>
			</table>
		</div>
    </div>
</div>


