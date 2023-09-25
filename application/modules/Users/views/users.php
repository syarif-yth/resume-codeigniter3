

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<button type="button" class="btn btn-info m-l-5 pull-right">
					<i class="fa fa-file-pdf-o"></i> PDF
				</button>
				<a href="<?=base_url()?>users/add" class="btn btn-info pull-right">
					<i class="fa fa-plus"></i> New Data
				</a>
				<h5>List of Users</h5>
				
				<div class="table-responsive">
					<table id="users_table" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Name</th>
								<th>Position</th>
								<th>Office</th>
								<th>Age</th>
								<th>Start date</th>
								<th class="no-sort">Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Tiger Nixon</td>
								<td>System Architect</td>
								<td>Edinburgh</td>
								<td>61</td>
								<td>2011/04/25</td>
								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-info">
											<i class="fa fa-eye"></i>
										</button>
										<button type="button" class="btn btn-warning">
											<i class="fa fa-edit"></i>
										</button>
										<button type="button" class="btn btn-danger">
											<i class="fa fa-trash"></i>
										</button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

