
<style>
#addUser .input-group-btn .btn {
	padding: 10px !important;
}
#addUser label span.text-muted {
	font-size: 0.8em !important;
	margin-left: 1em !important;
}
.grid{
  display: flex;
  flex-wrap: wrap;
  width: 100%;
  /* height: 200px; */
}

.img{
  position: relative;
  overflow: hidden;
  padding: 10px;
  width: 100%;
  transition: transform 0.5s;
}

.img img{
  position: relative;
  min-height: 100%;
  min-width: 100%;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.img:hover{
  transform: scale(1.1);
  z-index: 1;
}
</style>
<div class="row">
	<div class="col-12">
		<div class="card card-outline-primary">
			<div class="card-body">
				<form action="#" id="addUser" enctype="multipart/form-data">
					<div class="form-body">
						<h3 class="card-title">Add new user</h3>
						<hr>
						<div class="row p-t-5 p-b-20">
							<div class="col-md-6">
								<div class="row">
								<div class="col-md-3">
									<img src="<?=base_url().$avatar?>" id="preview" class="img-thumbnail">
									<!-- <div class="grid">
										<div class="img">
											<img src="<?=base_url().$avatar?>" id="preview">
										</div>
									</div> -->
								</div>
								<div class="col-md-9">
									<label class="control-label">
										Avatar
										<span class="text-muted">( jpg/jpeg/png. max : 2mb )</span>
									</label>
									<input type="file" id="pilih" name="gambar" class="form-control" accept=".jpg,.jpeg,.png" tabindex="1">
								</div>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Your Name</label>
									<input type="text" name="nama" class="form-control" placeholder="Enter Your Name" tabindex="1">
									<small class="form-control-feedback text-danger" id="err-nama"></small>
								</div>
							</div>
						</div>

						<div class="row p-t-10">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">
										Email Address
										<i class="text-danger">*</i>
									</label>
									<input type="email" name="email" class="form-control" placeholder="Enter Email Address" tab-index="3">
									<small class="form-control-feedback text-danger" id="err-email"></small>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">
										Username
										<i class="text-danger">*</i>
									</label>
									<input type="text" name="username" class="form-control" placeholder="Enter Username" tab-index="4">
									<small class="form-control-feedback text-danger" id="err-username"></small>
								</div>
							</div>
						</div>

						<div class="row p-t-10">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">
										Password
										<i class="text-danger">*</i>
									</label>
									<div class="input-group">
										<input type="password" name="password" class="form-control" placeholder="Enter Password" tab-index="5">
										<span class="input-group-btn">
												<button class="btn btn-flat" type="button" id="show-pass">
													<i class="fa fa-eye"></i>
												</button>
										</span>
									</div>
									<small class="form-control-feedback text-danger" id="err-password"></small>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">
										Confirm Password
										<i class="text-danger">*</i>
									</label>
									<input type="password" name="passconf" class="form-control" placeholder="Enter Confirm Password" tab-index="5">
									<small class="form-control-feedback text-danger" id="err-passconf"></small>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
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
							
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Date of Birth</label>
									<input type="date" name="tgl_lahir" class="form-control" placeholder="dd/mm/yyyy">
									<small class="form-control-feedback text-danger" id="err-tgl_lahir"></small>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Place of Birth</label>
									<select class="form-control" name="tempat_lahir">
										<option value="">Enter Gender</option>
										<option value="">Male</option>
										<option value="">Female</option>
									</select>
									<small class="form-control-feedback text-danger" id="err-tempat_lahir"></small>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Domicile</label>
									<input type="text" name="domisili" class="form-control" placeholder="Enter Domicile">
									<small class="form-control-feedback text-danger" id="err-domisili"></small>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Number Phone</label>
									<input type="text" name="no_hp" class="form-control" placeholder="Enter Number Phone">
									<small class="form-control-feedback text-danger" id="err-no_hp"></small>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Profession</label>
									<input type="text" name="profesi" class="form-control" placeholder="Enter Profession">
									<small class="form-control-feedback text-danger" id="err-profesi"></small>
								</div>
							</div>
						</div>

					</div>

					<div class="form-actions text-center m-t-20">
						<button type="submit" class="btn btn-success">
							<i class="fa fa-check"></i> Save
						</button>
						<button onclick="history.back(1)" type="button" class="btn btn-inverse">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

