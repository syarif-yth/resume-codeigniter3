

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<button type="button" id="pdf" class="btn hover-info btn-secondary m-l-5 pull-right">
					<i class="fa fa-file-pdf-o"></i> PDF
				</button>
				<a href="<?=base_url()?>users/add" class="btn hover-info btn-secondary pull-right action-add">
					<i class="fa fa-plus"></i> New Data
				</a>
				<h5>List of Users</h5>
				
				<div class="table-responsive">
					<table id="users_table" class="table_action nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Username</th>
								<th>Email</th>
								<th>Profesion</th>
								<th>Status</th>
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

<div class="modal fade" id="modal-close" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Close Account</h4>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fa fa-close"></i>
        </button>
      </div>

			<form id="close-account">
				<div class="modal-body p-b-0">
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label class="control-label">Email Address</label>
								<input type="email" name="email" class="form-control" placeholder="Enter Email Address">
								<small class="form-control-feedback text-danger" id="err-email"></small>
							</div>
						</div>

						<div class="col-6">
							<div class="form-group">
								<label class="control-label">Username</label>
								<input type="text" name="username" class="form-control" placeholder="&bull;&bull;&bull;&bull;&bull;">
								<small class="form-control-feedback text-danger" id="err-username"></small>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label class="control-label">Password</label>
								<div class="input-group">
									<input type="password" name="password" class="form-control" placeholder="&bull;&bull;&bull;&bull;&bull;">
									<span class="input-group-btn">
										<button class="btn" type="button" onclick="showPass(this)">
											<i class="fa fa-eye"></i>
										</button>
									</span>
								</div>
								<small class="form-control-feedback text-danger" id="err-password"></small>
							</div>
						</div>

						<div class="col-6">
							<div class="form-group">
								<label class="control-label">Confirm Password</label>
								<div class="input-group">
									<input type="password" name="passconf" class="form-control" placeholder="&bull;&bull;&bull;&bull;&bull;">
									<span class="input-group-btn">
										<button class="btn" type="button" onclick="showConf(this)">
											<i class="fa fa-eye"></i>
										</button>
									</span>
								</div>
								<small class="form-control-feedback text-danger" id="err-passconf"></small>
							</div>
						</div>
					</div>

					<div class="row m-t-10">
						<div class="col-6">
							<div class="form-group">
								<label class="control-label">Choose Close Account Type</label>
							</div>
						</div>

						<div class="col-6">
							<div class="form-group">
								<input type="radio" id="radio-temporary" name="tutup_akun" value="temporary" checked>
								<label for="radio-temporary">Temporary</label><br>
								<input type="radio" id="radio-permanent" name="tutup_akun" value="permanent">
								<label for="radio-permanent">Permanent</label>
							</div>
						</div>
					</div>
					<div class="row m-b-20">
						<div class="col-12">
							<span class="small text-danger">Temporary: if you login for latter your account active again without signup<br>
							Permanent: your all data in system will be delete, but we need 3 days for processed
							</span>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-danger">
						<i class="fa fa-close"></i> Close Account
					</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</form>
    </div>
  </div>
</div>

