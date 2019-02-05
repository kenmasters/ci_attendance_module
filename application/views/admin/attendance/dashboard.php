<div class="container">
	<h1>Manage User Attendance</h1>
	<table class="table table-condensed" id="users-table">
		<thead>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>

<script type="text/javascript">
	jQuery(document).ready(function(){
		$('#users-table').DataTable( {
		    'processing': true,
		    'serverSide': true,
		    'ajax': {
		        'url': '<?=site_url('admin/attendance/get_users')?>',
		        'type': 'GET'
		    },
		    'columnDefs': [
		    	{'targets': 2, 'orderable': false}
		    ]
		} );
	});
</script>>
