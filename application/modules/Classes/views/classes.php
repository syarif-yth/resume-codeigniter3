

<style>
.dataTables_wrapper tbody tr td span {
	padding: 0px 8px;
	margin: 2px 2px;
	text-transform: capitalize !important;
	display: inline-block;
}
.dataTables_wrapper tbody tr td.col-parent {
	width: 340px !important;
	max-width: 400px !important;
	word-break: break-word !important;
}
</style>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<a href="javascript:void(0)" class="btn hover-info btn-secondary pull-right action-add" data-target="#new-data" data-toggle="modal">
					<i class="fa fa-plus"></i> New Data
				</a>
				<h5>List of Classes</h5>
				
				<div class="table-responsive">
					<table id="classes_table" class="table_action nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Label</th>
								<th>Is Child</th>
								<th>Parent</th>
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
        <h4 class="modal-title">New Class</h4>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fa fa-close"></i>
        </button>
      </div>

			<form id="new-param">
				<div class="modal-body p-b-0">
					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">
							Name <i class="text-danger">*</i>
						</label>
						<input type="text" class="form-control col-8" name="nama" placeholder="Enter Name" required minlength="3" maxlength="20">
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">
							Label <i class="text-danger">*</i>
						</label>
						<input type="text" class="form-control col-8" name="label" placeholder="Enter Label" required minlength="5" maxlength="50">
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<div class="col-4 m-t-6"></div>
						<div class="col-8 p-0 p-t-10">
							<div class="checkbox checkbox-success pull-right">
								<input id="is-child-new" type="checkbox" name="is_child">
								<label for="is-child-new">Is Child</label>
							</div>
						</div>
					</div>

					<div class="form-group row m-b-7 p-r-20" id="new-group" style="display: none">
						<label class="control-label col-4 m-t-6">
							Parent <i class="text-danger">*</i>
						</label>
						<div class="col-8 p-0">
							<select class="form-control" name="parent[]" id="parent-new" multiple="multiple" data-placeholder="Select Parent" required></select>
						</div>
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
        <h4 class="modal-title">Edit Class</h4>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fa fa-close"></i>
        </button>
      </div>

			<form id="edit-param">
				<input name="id" type="hidden">
				<input name="nama_old" type="hidden">
				<input name="ischild_old" type="hidden">
				<div class="modal-body p-b-0">
					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">
							Name <i class="text-danger">*</i>
						</label>
						<input type="text" class="form-control col-8" name="nama" placeholder="Enter Name" minlength="3" maxlength="20">
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">
							Label <i class="text-danger">*</i>
						</label>
						<input type="text" class="form-control col-8" name="label" placeholder="Enter Label" minlength="5" maxlength="50">
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<div class="col-4 m-t-6"></div>
						<div class="col-8 p-0 p-t-10">
							<div class="checkbox checkbox-success pull-right">
								<input id="is-child-edit" type="checkbox" name="is_child">
								<label for="is-child-edit">Is Child</label>
							</div>
						</div>
					</div>

					<div class="form-group row m-b-7 p-r-20" id="edit-group" style="display: none">
						<label class="control-label col-4 m-t-6">
							Parent <i class="text-danger">*</i>
						</label>
						<div class="col-8 p-0">
							<select class="form-control" name="parent[]" id="parent-edit" multiple="multiple" data-placeholder="Select Parent"></select>
						</div>
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
