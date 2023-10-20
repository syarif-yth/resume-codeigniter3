

<style>
.tag-child {
	display: flex;
	flex-direction: row;
	flex-wrap: nowrap !important;
	width: 100%;
}
.tag-child li {
	display: inline-block;
	padding: 0px 14px;
	line-height: 34px;
	margin: 0px 4px;
	border-radius: 3px;
	color: #F1F1F1;
	font-weight: normal;
	text-transform: capitalize !important;
}
.tag-child li button {
	line-height: 21px;
}
.tag-child li:last-child {
	background: none !important;
	padding: 0px 5px;
}
.dataTables_wrapper tbody tr td[colspan="6"] {
	padding: 0px;
	margin: 0px;
}
.dataTables_wrapper tbody tr td[colspan="6"] table.details {
	width: 100%;
}
.dataTables_wrapper tbody tr td[colspan="6"] table.details tr {
	background: white;
}
.dataTables_wrapper tbody tr td[colspan="6"] table.details tr td:first-child {
	overflow-x: auto;
	width: 92%;
}
.dataTables_wrapper tbody tr td[colspan="6"] table.details tr td:first-child::-webkit-scrollbar {
	height: 7px;
}
.dataTables_wrapper tbody tr td[colspan="6"] table.details tr td:first-child::-webkit-scrollbar-track {
  background: transparent;
}
.dataTables_wrapper tbody tr td[colspan="6"] table.details tr td:first-child::-webkit-scrollbar-thumb {
  background: #C1C1C1;
}
.dataTables_wrapper tbody tr td[colspan="6"] table.details tr td:first-child::-webkit-scrollbar-thumb:hover {
  background: #B1B1B1;
}
.dataTables_wrapper tbody tr.details {
	background: #F1F1F1;
}
</style>
<div class="row">
	<div class="col-12">
		<div class="card card-edit card-outline-primary">
			<div class="card-body">
				<a href="<?=base_url()?>" class="btn hover-info btn-secondary pull-right">
					<i class="fa fa-plus"></i> New Data
				</a>
				<h5>List of Rules</h5>

				<div class="table-responsive">
					<table id="rules_table" class="table_rules nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th rowspan="2">No</th>
								<th rowspan="2">Rule name</th>
								<th rowspan="2">Label</th>
								<th colspan="2">Access</th>
								<th rowspan="2">Users</th>
							</tr>

							<tr>
								<th style="width: auto">Nav</th>
								<th style="width: auto">Func</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>admin</td>
								<td>Administdator</td>
								<td>4</td>
								<td>40</td>
								<td>46</td>
							</tr>

							<tr>
								<td>1</td>
								<td>admin</td>
								<td>Administdator</td>
								<td>4</td>
								<td>40</td>
								<td>46</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="row" style="display: none">
	<div class="col-12">
		<div class="card card-edit card-outline-primary">
			<div class="card-body">
				<form id="permision-form">
					<div class="form-body">
						<h3 class="card-title">Edit Permision</h3>
						<hr>
						
						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<label class="control-label">Rule Name</label>
									<input type="text" name="nama" class="form-control">
								</div>
							</div>

							<div class="col-6">
								<div class="form-group">
									<label class="control-label">Rule Label</label>
									<input type="text" name="label" class="form-control">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label">Navigation Allowed</label>
							<input type="text" name="navigasi" id="navigasi-akses" class="form-control" data-placeholder="Select Navigasi" data-minimum-results-for-search="1" data-multiple="true">
						</div>

						<div class="form-group">
							<label class="control-label">Parent Function</label>
							<input type="text" name="parent_func" id="parent-func" class="form-control" data-placeholder="Select Parent Function" data-minimum-results-for-search="1">
						</div>

						<div class="form-group">
							<label class="control-label">Method</label>
							<select class="form-control">
								<option>Get</option>
								<option>Post</option>
							</select>
						</div>

						<div class="form-group">
							<label class="control-label">Action</label>
							<select class="form-control">
								<option>Add</option>
								<option>Edit</option>
							</select>
						</div>

						<div class="form-group">
							<label class="control-label">Child Function</label>
							<select class="form-control">
								<option>Datatable</option>
								<option>Chart</option>
							</select>
						</div>

						<div class="form-group">
							<label class="control-label">Child Method</label>
							<select class="form-control">
								<option>Get</option>
								<option>Post</option>
							</select>
						</div>

						<div class="form-group">
							<label class="control-label">Rules Access</label>
							<div id="jsoneditor" style="height: 400px;"></div>
						</div>
					</div>

					<div class="form-actions text-center m-t-20">
						<button type="submit" class="btn btn-secondary hover-info">
							<i class="fa fa-save"></i> Save
						</button>
						<button onclick="history.back(1)" type="button" class="btn btn-secondary">Cancel</button>
					</div>
				</form>
			</div>



			<!-- <div class="card-body">
				<form id="permision-form">
					<div class="form-body">
						<h3 class="card-title">Edit User</h3>
						<hr>

						<div class="form-group">
							<label class="control-label">class</label>
							<input type="text" name="class" class="form-control">
						</div>

						<div class="form-group">
							<label class="control-label">action</label>
							<input type="text" name="action" class="form-control">
						</div>

						<div class="form-group">
							<label class="control-label">method</label>
							<input type="text" name="method" class="form-control">
						</div>

						<div class="form-group">
							<label class="control-label">child</label>
							<input type="text" name="child" class="form-control">
						</div>

					</div>

					<div class="form-actions text-center m-t-20">
						<button type="submit" class="btn btn-secondary hover-info">
							<i class="fa fa-save"></i> Save
						</button>
						<button onclick="history.back(1)" type="button" class="btn btn-secondary">Cancel</button>
					</div>
				</form>
			</div> -->
			
		</div>
	</div>
</div>

