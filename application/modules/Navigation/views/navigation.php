


<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<a href="<?=base_url()?>users/add" class="btn hover-info btn-secondary pull-right">
					<i class="fa fa-plus"></i> New Data
				</a>
				<h5>List of Navigation</h5>
				
				<div class="table-responsive">
					<table id="navigasi_table" class="table_action nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Group</th>
								<th>Name</th>
								<th>Label</th>
								<th>URL</th>
								<th>Icon</th>
								<th>Sorting</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Group</td>
								<td>Name</td>
								<td>Label</td>
								<td>URL</td>
								<td>Icon</td>
								<td>Sorting</td>
								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-secondary btn-custom" onclick="view()">
											<i class="fa fa-eye"></i>
										</button>
										<button type="button" class="btn btn-secondary btn-custom" onclick="edit()">
											<i class="fa fa-edit"></i>
										</button>
										<button type="button" class="btn btn-secondary btn-custom" onclick="del()">
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

