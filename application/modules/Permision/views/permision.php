

<style>
.modal .form-group small.form-control-feedback,
.modal .form-group small.error {
	width: 100%;
	text-align: right !important;
}
</style>
<div class="row">
	<div class="col-12">
		<div class="card card-edit card-outline-primary">
			<div class="card-body">
				<a href="javascript:void(0)" class="btn hover-info btn-secondary pull-right" data-target="#new-data" data-toggle="modal">
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
								<th rowspan="2">Action</th>
							</tr>

							<tr>
								<th style="width: auto">Navigation</th>
								<th style="width: auto">Class</th>
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
        <h4 class="modal-title">New Rules</h4>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fa fa-close"></i>
        </button>
      </div>

			<form id="new-rules">
				<div class="modal-body p-b-0">
					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">Rule Name</label>
						<input type="text" class="form-control col-8" name="nama" placeholder="Enter Rule Name" required minlength="3" maxlength="15">
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">Rule Label</label>
						<input type="text" class="form-control col-8" name="label" placeholder="Enter Rule Label" required minlength="5" maxlength="50">
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">Navigation</label>
						<div class="col-8 p-0">
							<select class="form-control" name="navigasi[]" id="navigasi-new" multiple="multiple" data-placeholder="Select Navigation"></select>
						</div>
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">Class</label>
						<div class="col-8 p-0">
							<select class="form-control" name="class[]" id="class-new" multiple="multiple" data-placeholder="Select Class"></select>
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
        <h4 class="modal-title">Edit Rules</h4>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fa fa-close"></i>
        </button>
      </div>

			<form id="edit-rules">
				<input name="id" type="hidden">
				<input name="nama_old" type="hidden">
				<div class="modal-body p-b-0">
					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">Rule Name</label>
						<input type="text" class="form-control col-8" name="nama" placeholder="Enter Rule Name" required minlength="3" maxlength="15">
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">Rule Label</label>
						<input type="text" class="form-control col-8" name="label" placeholder="Enter Rule Label" required minlength="5" maxlength="50">
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-4 m-t-6">Navigation</label>
						<div class="col-8 p-0">
							<select class="form-control" name="navigasi[]" id="navigasi-edit" multiple="multiple" data-placeholder="Select Navigation"></select>
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

<div class="modal fade" id="modal-details-nav" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Navigasi</h4>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fa fa-close"></i>
        </button>
      </div>

			<form id="modify-nav">
				<div class="modal-body p-b-0">
					<input type="hidden" name="rule" value="">
					<select class="form-control" name="navigasi[]" id="input-navigasi" multiple="multiple" data-placeholder="Select Navigation">
					</select>
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

<div class="modal fade" id="modal-details-class" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Class</h4>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fa fa-close"></i>
        </button>
      </div>

			<form id="modify-class">
				<div class="modal-body p-b-0">
					<input type="hidden" name="rule" value="">
					<select class="form-control" name="class[]" id="input-class" multiple="multiple" data-placeholder="Select Class">
					</select>
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

<div class="modal fade" id="modal-class" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Class</h4>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fa fa-close"></i>
        </button>
      </div>

			<form id="modify-method">
				<div class="modal-body p-b-0">
					<input type="hidden" name="rule" value="">
					<input type="hidden" name="class" value="">

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-3 m-t-6">Method</label>
						<div class="col-9">
							<select class="form-control" name="method[]" id="input-method" multiple="multiple" data-placeholder="Select Method"></select>
						</div>
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-3 m-t-6">Action</label>
						<div class="col-9">
							<select class="form-control" name="aksi[]" id="input-aksi" multiple="multiple" data-placeholder="Select Action"></select>
						</div>
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-3 m-t-6"><strong>Child</strong></label>
						<div class="col-9">
							<button type="button" class="btn hover-info btn-secondary pull-right" onclick="addChild(this)"><i class="fa fa-plus"></i> Add Child</button>
						</div>
					</div>

						<table id="child-class">
							<thead>
								<tr>
									<th>Function Name</th>
									<th>Method Function</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<input class="form-control input-child" name="child[0]" data-placeholder="Select Child" data-modal="#modal-class">
									</td>
									<td>
										<select class="form-control method-child" name="method_child[0][]" multiple="multiple" data-placeholder="Select Method"></select>
									</td>
									<td>
										<button type="button" class="btn hover-danger btn-secondary pull-right"><i class="fa fa-close"></i></button>
									</td>
								</tr>

								<tr>
									<td>
										<input class="form-control input-child" name="child[1]" data-placeholder="Select Child" data-modal="#modal-class">
									</td>
									<td>
										<select class="form-control method-child" name="method_child[1][]" multiple="multiple" data-placeholder="Select Method"></select>
									</td>
									<td>
										<button type="button" class="btn hover-danger btn-secondary pull-right"><i class="fa fa-close"></i></button>
									</td>
								</tr>
							</tbody>
						</table>

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
