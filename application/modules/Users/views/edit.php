


<div class="row">
	<div class="col-12">
		<div class="card card-outline-primary">
			<div class="card-body">
				<div class="btn-group nav-button">
					<button type="button" class="btn btn-secondary hover-danger" data-target="#modal-reset" data-toggle="modal">
						Reset Password
					</button>
				</div>
				<form id="edit-profile">
					<div class="form-body">
						<h3 class="card-title">Edit User</h3>
						<hr>
						<div class="row p-t-5 p-b-20">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-6">
										<div class="cover-pic" id="preview-cover" style="background-image: url('<?=base_url().$cover?>')"></div>
									</div>
									<div class="col-md-5 input-group-cover">
										<label class="control-label">
											Cover<br>
											<span class="small text-muted">(jpg/jpeg/png. max:2mb)</span>
										</label>
										<input type="file" id="cover" name="cover" class="form-control" accept=".jpg,.jpeg,.png">
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="row row-avatar">
									<div class="col-md-4">
										<img src="<?=base_url().$avatar?>" id="preview-avatar" class="profile-pic m-l-20">
									</div>
									<div class="col-md-7">
										<label class="control-label">
											Avatar
											<span class="small text-muted"><br>(jpg/jpeg/png. max:2mb)</span>
										</label>
										<input type="file" id="avatar" name="avatar" class="form-control" accept=".jpg,.jpeg,.png">
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
												<label class="control-label">Email Address</label>
												<div class="input-group">
													<input type="email" name="email" class="form-control" placeholder="admin@email.com" readonly>
													<span class="input-group-btn">
														<button class="btn" type="button" data-target="#modal-email" data-toggle="modal">
															<i class="fa fa-edit"></i>
														</button>
													</span>
												</div>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label class="control-label">Username</label>
												<div class="input-group">
													<input type="text" name="username" class="form-control" placeholder="administrator" readonly>
													<span class="input-group-btn">
														<button class="btn" type="button" data-target="#modal-username" data-toggle="modal">
															<i class="fa fa-edit"></i>
														</button>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label class="control-label">Name</label>
												<input type="text" name="nama" class="form-control" placeholder="Admin App">
												<small class="form-control-feedback text-danger" id="err-nama"></small>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label class="control-label">Number Phone</label>
												<input type="text" name="no_hp" class="form-control" placeholder="Enter Number Phone">
												<small class="form-control-feedback text-danger" id="err-no_hp"></small>
											</div>
										</div>
									</div>

								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="row">
										<div class="col-4">
											<div class="form-group">
												<label class="control-label">Gender</label>
												<select class="form-control" name="jenis_kelamin">
													<option value="">Enter Gender</option>
													<option value="">Male</option>
													<option value="">Female</option>
												</select>
												<small class="form-control-feedback text-danger" id="err-jenis_kelamin"></small>
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
												<label class="control-label">Date of Birth</label>
												<input type="date" name="tgl_lahir" class="form-control" placeholder="dd/mm/yyyy">
												<small class="form-control-feedback text-danger" id="err-tgl_lahir"></small>
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
												<label class="control-label">Place of Birth</label>
												<input type="text" name="tempat_lahir" class="form-control" placeholder="Enter Your Place of Birth">
												<small class="form-control-feedback text-danger" id="err-tempat_lahir"></small>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="row">
										<div class="col-6">
											<div class="form-group">
												<label class="control-label">Domicile</label>
												<input type="text" name="domisili" class="form-control" placeholder="Enter Domicile">
												<small class="form-control-feedback text-danger" id="err-domisili"></small>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label class="control-label">Profession</label>
												<input type="text" name="profesi" class="form-control" placeholder="Enter Profession">
												<small class="form-control-feedback text-danger" id="err-profesi"></small>
											</div>
										</div>
									</div>
									
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">Description</label>
										<textarea name="deskripsi" class="form-control" placeholder="Enter Description" rows="3"></textarea>
										<small class="form-control-feedback text-danger" id="err-deskripsi"></small>
									</div>
								</div>

							</div>
						</div>

					</div>

					<div class="form-actions text-center m-t-20">
						<button type="submit" class="btn btn-info">
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
        <h5 class="modal-title">Edit Email Address</h5>
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
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Password</label>
								<div class="input-group">
									<input type="password" name="password"  class="form-control password" placeholder="Enter Password">
									<span class="input-group-btn">
										<button class="btn" type="button" onclick="showPass()">
											<i class="fa fa-eye"></i>
										</button>
									</span>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Confirm Password</label>
								<input type="password" name="passconf" class="form-control passconf" placeholder="Enter Confirm Password">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info">
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
        <h5 class="modal-title">Edit Username</h5>
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
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Password</label>
								<div class="input-group">
									<input type="password" name="password" class="form-control password" placeholder="Enter Password">
									<span class="input-group-btn">
										<button class="btn" type="button" onclick="showPass()">
											<i class="fa fa-eye"></i>
										</button>
									</span>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Confirm Password</label>
								<input type="password" name="passconf" class="form-control passconf" placeholder="Enter Confirm Password">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info">
						<i class="fa fa-send"></i> Send
					</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</form>
    </div>
  </div>
</div>


<div class="modal fade" id="modal-reset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reset Password</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fa fa-close"></i>
        </button>
      </div>

			<form id="edit-password">
				<div class="modal-body p-b-0">
					<span>For reset password we need confirm your password. We will send an link for reset password to your email</span>
					<div class="row m-t-20">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Password</label>
								<div class="input-group">
									<input type="password" name="password" class="form-control password" placeholder="Enter Password">
									<span class="input-group-btn">
										<button class="btn" type="button" onclick="showPass()">
											<i class="fa fa-eye"></i>
										</button>
									</span>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Confirm Password</label>
								<input type="password" name="passconf" class="form-control passconf" placeholder="Enter Confirm Password">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info">
						<i class="fa fa-send"></i> Send
					</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</form>
    </div>
  </div>
</div>

