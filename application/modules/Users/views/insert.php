


<div class="row">
	<div class="col-12">
		<div class="card card-edit card-outline-primary">
			<div class="card-body">

				<form id="add-user">
					<div class="form-body">
						<h3 class="card-title">Add User</h3>
						<hr>
						<div class="row p-t-5 p-b-20">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-6">
										<div class="cover-pic" id="preview-cover"></div>
									</div>
									<div class="col-md-5 input-group-cover">
										<label class="control-label">
											Cover<br>
											<span class="small text-muted">(jpg/jpeg/png. max:2mb)</span>
										</label>
										<input type="file" id="cover" name="cover" class="form-control" accept=".jpg,.jpeg,.png">
										
										<small class="form-control-feedback text-danger" id="err-cover"></small>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="row row-avatar">
									<div class="col-md-4">
										<img id="preview-avatar" class="profile-pic m-l-20">
									</div>
									<div class="col-md-7">
										<label class="control-label">
											Avatar
											<span class="small text-muted"><br>(jpg/jpeg/png. max:2mb)</span>
										</label>
										<input type="file" id="avatar" name="avatar" class="form-control" accept=".jpg,.jpeg,.png">

										<small class="form-control-feedback text-danger" id="err-avatar"></small>
									</div>

								</div>
							</div>
						</div>

						<div class="input-text-group">
							<div class="row p-t-10">
								<div class="col-md-6">
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label class="control-label">
													Email Address <i class="text-danger">*</i>
												</label>
												<input type="email" name="email" class="form-control" placeholder="admin@email.com">
												<small class="form-control-feedback text-danger" id="err-email"></small>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label class="control-label">
													Username <i class="text-danger">*</i>
												</label>
												<input type="text" name="username" class="form-control" placeholder="administrator">
												<small class="form-control-feedback text-danger" id="err-email"></small>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label class="control-label">
													Password <i class="text-danger">*</i>
												</label>
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
												<label class="control-label">
													Confirm Password <i class="text-danger">*</i>
												</label>
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

								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label class="control-label">Name</label>
												<input type="text" name="nama" class="form-control" placeholder="Default User App">
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label class="control-label">
													Number Phone <span class="small text-muted">(628******)</span>
												</label>
												<input type="text" name="no_telp" class="form-control" placeholder="Enter Number Phone">
											</div>
										</div>
									</div>
									
								</div>

								<div class="col-md-6">
									<div class="row">
										<div class="col-3">
											<div class="form-group">
												<label class="control-label">Gender</label>
												<input class="form-control select2" name="jenis_kelamin" id="jenis-kelamin" data-placeholder="Select Gender" data-minimum-results-for-search="-1">
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
												<label class="control-label">Date of Birth</label>
												<input type="date" name="tgl_lahir" class="form-control" placeholder="dd/mm/yyyy">
											</div>
										</div>
										<div class="col-5">
											<div class="form-group">
												<label class="control-label">Place of Birth</label>
												<input class="form-control select2" name="tempat_lahir" id="tempat-lahir" data-placeholder="Select Place" data-minimum-results-for-search="2">
											</div>
										</div>
									</div>
									
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label class="control-label">Domicile</label>
												<input class="form-control select2" name="domisili" id="domisili" data-placeholder="Select Domicile" data-minimum-results-for-search="2">
												<small class="form-control-feedback text-danger" id="err-domisili"></small>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label class="control-label">Profession</label>
												<div id="auto-profesi" class="autocomplete-wrapper"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="row">
										<div class="col-8">
											<div class="form-group">
												<label class="control-label">Description</label>
												<textarea name="deskripsi" class="form-control" placeholder="Enter Description" rows="3"></textarea>
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
												<label class="control-label">Rule</label>
												<input class="form-control select2" name="rule" id="rule-input" data-placeholder="Default User" data-minimum-results-for-search="-1">
											</div>
										</div>
									</div>
								</div>

							</div>
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
		</div>
	</div>
</div>

<div class="modal fade" id="modal-email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Email Address</h4>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fa fa-close"></i>
        </button>
      </div>

			<form id="edit-email">
				<div class="modal-body p-b-0">
					<span>For edit Email Address we need confirm your password. We will send an link for edit email address to your old email</span>
					<div class="row m-t-20">
						<div class="col-12">
							<div class="form-group">
								<label class="control-label">New Email Address</label>
								<input type="email" name="email" class="form-control" placeholder="Enter New Email Address">
								<small class="form-control-feedback text-danger" id="err-email"></small>
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
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-secondary hover-info">
						<i class="fa fa-send"></i> Send
					</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</form>
    </div>
  </div>
</div>



<div class="modal fade" id="modal-username" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Username</h4>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fa fa-close"></i>
        </button>
      </div>

			<form id="edit-username">
				<div class="modal-body p-b-0">
					<span>For edit username we need confirm your password. We will send an link for edit username to your email</span>
					<div class="row m-t-20">
						<div class="col-12">
							<div class="form-group">
								<label class="control-label">New Username</label>
								<input type="text" name="username" class="form-control" placeholder="Enter New Username">
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
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-secondary hover-info">
						<i class="fa fa-send"></i> Send
					</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</form>
    </div>
  </div>
</div>


<div class="modal fade" id="modal-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Password</h4>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fa fa-close"></i>
        </button>
      </div>

			<form id="edit-password">
				<div class="modal-body p-b-0">
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label class="control-label">Current Password</label>
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
								<label class="control-label">Confirm Current Password</label>
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


					<div class="row m-t-20">
						<div class="col-6">
							<div class="form-group">
								<label class="control-label">New Password</label>
								<div class="input-group">
									<input type="password" name="new_password" class="form-control" placeholder="&bull;&bull;&bull;&bull;&bull;">
									<span class="input-group-btn">
										<button class="btn" type="button" onclick="showPass(this)">
											<i class="fa fa-eye"></i>
										</button>
									</span>
								</div>
								<small class="form-control-feedback text-danger" id="err-new_password"></small>
							</div>
						</div>

						<div class="col-6">
							<div class="form-group">
								<label class="control-label">Confirm New Password</label>
								<div class="input-group">
									<input type="password" name="new_passconf" class="form-control" placeholder="&bull;&bull;&bull;&bull;&bull;">
									<span class="input-group-btn">
										<button class="btn" type="button" onclick="showConf(this)">
											<i class="fa fa-eye"></i>
										</button>
									</span>
								</div>
								<small class="form-control-feedback text-danger" id="err-new_passconf"></small>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-secondary hover-info">
						<i class="fa fa-save"></i> Update
					</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</form>
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


