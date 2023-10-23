


<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<a href="javascript:void(0)" class="btn hover-info btn-secondary pull-right action-add" data-target="#new-data" data-toggle="modal">
					<i class="fa fa-plus"></i> New Data
				</a>
				<h5>List of Navigations</h5>
				
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
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="new-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">New Navigations</h4>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fa fa-close"></i>
        </button>
      </div>

			<form id="new-nav">
				<div class="modal-body p-b-0">
					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">
							Group <i class="text-danger">*</i>
						</label>
						<input type="text" class="form-control col-8" name="group" placeholder="Enter Navigation Group" required minlength="3" maxlength="20">
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">
							Name <i class="text-danger">*</i>
						</label>
						<input type="text" class="form-control col-8" name="nama" placeholder="Enter Navigation Name" required minlength="3" maxlength="20">
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">
							Label <i class="text-danger">*</i>
						</label>
						<input type="text" class="form-control col-8" name="label" placeholder="Enter Navigation Label" required minlength="3" maxlength="50">
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">
							URL <i class="text-danger">*</i>
						</label>
						<input type="text" class="form-control col-8" name="url" placeholder="Enter Navigation URL" required minlength="3" maxlength="50">
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">Icon</label>
						<input type="text" class="form-control col-8" name="icon" placeholder="fa fa-bars" minlength="3" maxlength="20">
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">
							Sorting <i class="text-danger">*</i>
						</label>
						<input type="number" class="form-control col-8" name="urutan" placeholder="Enter Navigation Sorting" required minlength="1" maxlength="2">
					</div>

				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-info">
						<i class="fa fa-save"></i> Save
					</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</form>
    </div>
  </div>
</div>

<div class="modal fade" id="edit-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Navigation</h4>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fa fa-close"></i>
        </button>
      </div>

			<form id="edit-nav">
				<input name="id" type="hidden">
				<input name="nama_old" type="hidden">
				<input name="urutan_old" type="hidden">
				<div class="modal-body p-b-0">
					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">
							Group  <i class="text-danger">*</i>
						</label>
						<input type="text" class="form-control col-8" name="group" placeholder="Enter Navigation Group" required minlength="3" maxlength="20">
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">
							Name <i class="text-danger">*</i>
						</label>
						<input type="text" class="form-control col-8" name="nama" placeholder="Enter Navigation Name" required minlength="3" maxlength="20">
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">
							Label <i class="text-danger">*</i>
						</label>
						<input type="text" class="form-control col-8" name="label" placeholder="Enter Navigation Label" required minlength="3" maxlength="50">
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">
							URL <i class="text-danger">*</i>
						</label>
						<input type="text" class="form-control col-8" name="url" placeholder="Enter Navigation URL" required minlength="3" maxlength="50">
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">Icon</label>
						<input type="text" class="form-control col-8" name="icon" placeholder="fa fa-bars" minlength="3" maxlength="20">
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">
							Sorting <i class="text-danger">*</i>
						</label>
						<input type="number" class="form-control col-8" name="urutan" placeholder="Enter Navigation Sorting" required minlength="1" maxlength="2">
					</div>

				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-info">
						<i class="fa fa-save"></i> Save
					</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</form>
    </div>
  </div>
</div>

