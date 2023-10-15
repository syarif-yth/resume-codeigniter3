

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<button type="button" id="pdf" class="btn hover-info btn-secondary m-l-5 pull-right">
					<i class="fa fa-file-pdf-o"></i> PDF
				</button>
				<a href="<?=base_url()?>users/add" class="btn hover-info btn-secondary pull-right">
					<i class="fa fa-plus"></i> New Data
				</a>
				<h5>List of Users</h5>
				
				<div class="table-responsive">
					<table id="users_table" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Name</th>
								<th>Username</th>
								<th>Email</th>
								<th>Profesion</th>
								<th class="no-sort">Action</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

