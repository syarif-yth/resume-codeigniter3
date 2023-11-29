


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
											</div>
										</div>
										<div class="col-6">
											<div class="form-group">
												<label class="control-label">
													Username <i class="text-danger">*</i>
												</label>
												<input type="text" name="username" class="form-control" placeholder="administrator">
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


