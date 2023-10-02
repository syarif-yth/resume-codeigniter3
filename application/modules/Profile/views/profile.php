


<div class="row">
	<div class="col-lg-7">
		<div class="card">
			<div class="card-body">
				<div class="card-two">
					<header class="cover" style="background-image: url('<?=base_url().$cover?>')">
						<div class="avatar m-t-20">
							<img src="<?=base_url().$avatar?>" alt="<?=$name_display?>">
						</div>
					</header>
					<h3 class="m-t-40">
						<a href="javascript:void(0)"><?=$name_display?></a><br>
						<a href="javascript:void(0)"><small><?=$user_display?></small></a>
					</h3>
					<h4 class="profesi m-t-40">
						<a href="javascript:void(0)">Web Developer</a>
					</h4>
					<div class="desc">
						<a href="javascript:void(0)">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit et cupiditate deleniti.
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-5">
		<div class="card">
			<h3 class="card-title">Information Contact</h3>
			<div class="card-body info-body">
				<div class="row p-10">
					<ul class="col-md-12">

						<li class="media m-b-15">
							<div class="media-left m-r-15">
								<i class="fa fa-envelope"></i>
							</div>
							<div class="media-body">
								<h4 class="media-heading">Email</h4>
								<a href="javascript:void(0)">syarif.yth@gmail.com</a>
							</div>
						</li>

						<li class="media m-b-15">
							<div class="media-left m-r-15">
								<i class="fa fa-phone"></i>
							</div>
							<div class="media-body">
								<h4 class="media-heading">Telephone</h4>
								<a href="javascript:void(0)">+62 858 0372 0846</a>
							</div>
						</li>

						<li class="media m-b-15">
							<div class="media-left m-r-15">
								<i class="fa fa-map-marker"></i>
							</div>
							<div class="media-body">
								<h4 class="media-heading">Domicile</h4>
								<a href="javascript:void(0)">Cilacap, Jawa Tengah</a>
							</div>
						</li>

						<li class="media m-b-15">
							<div class="media-left m-r-15">
								<i class="fa fa-birthday-cake"></i>
							</div>
							<div class="media-body">
								<h4 class="media-heading">Birth of Day</h4>
								<a href="javascript:void(0)">Cilacap, 10 Maret 2000</a>
							</div>
						</li>
					</ul>
				</div>

				<a type="button" class="btn btn-secondary btn-custom btn-block" href="<?=base_url()?>profile/edit">Edit Profile</a>
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<div class="card">
			<ul class="nav">
				<li class="nav-item card-title m-l-7 m-t-10 m-b-2">Skills</li>
				<li class="nav-item btn-group nav-button">
					<button type="button" class="btn btn-secondary btn-custom" data-target="#modal-skills" data-toggle="modal">
						<i class="fa fa-pencil"></i>
					</button>
				</li>
			</ul>

			<div class="card-body m-t-8" style="border-top: 1px solid #DDD">
				<ul class="tag-skills p-t-13">
					<?php for($i=0; $i<=10; $i++) { ?>
					<li class="btn">HTML</li>
					<li class="btn">CSS</li>
					<li class="btn">PHP</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<div class="card">
			<ul class="nav nav-tabs profile-tab" role="tablist" id="profile-tab">
				<li class="nav-item"> 
					<a class="nav-link active show" data-toggle="tab" href="#experience" role="tab" aria-selected="true">Experience</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#education" role="tab" aria-selected="false">Education</a>
				</li>

				<div class="nav-item nav-button btn-group">
					<button type="button" class="btn btn-secondary btn-custom" id="btn-add" data-target="#modal-experience" data-toggle="modal">
						<i class="fa fa-plus"></i>
					</button>
				</div>
			</ul>
			
			<div class="tab-content">
				<div class="tab-pane active" id="experience" role="tabpanel">
					<div class="card-body media-list">

						<ul class="m-t-10">
							<?php for($i=0; $i<=3; $i++) { ?>
							<li class="m-t-10 m-b-20">
								<div class="media">
									<div class="media-left m-r-20">
										<i class="fa fa-building-o"></i>
									</div>
									<div class="media-body first m-r-0">
										<a href="javascript:void(0)"><h3>Manager</h3></a>
										<a href="javascript:void(0)"><text>PT. ABC . <small>Kontrak</small></text></a>
									</div>

									<div class="media-body m-l-0">
										<div class="m-b-10 m-t-2">
										<a href="javascript:void(0)"><i class="fa fa-map-marker m-r-15"></i> Jakarta</a>
										</div>
										<div class="text-fade">
										<a href="javascript:void(0)"><i class="fa fa-clock-o m-r-5"></i> 10 ag - 20 ag 2022</a>
										</div>
									</div>

									<div class="media-right nav-button btn-group">
										<button class="btn btn-secondary btn-custom" data-target="#modal-experience" data-toggle="modal">
											<i class="fa fa-pencil"></i>
										</button>
										<button class="btn btn-secondary btn-custom" onclick="confirmasi()">
											<i class="fa fa-trash"></i>
										</button>
									</div>
									
								</div>

								<div class="exp-desc m-t-10 p-l-80 p-r-100">
								<a href="javascript:void(0)">Lorem ipsum dolor sit amet, consectetur adipisicing elit et cupiditate deleniti.Lorem ipsum dolor sit amet, consectetur adipisicing elit et cupiditate deleniti.</a>
								</div>
							</li>
							<?php }?>
						</ul>

					</div>
				</div>

				<div class="tab-pane" id="education" role="tabpanel">
					<div class="card-body media-list">
					<ul class="m-t-10">
							<?php for($i=0; $i<=1; $i++) { ?>
							<li class="m-t-10 m-b-20">
								<div class="media">
									<div class="media-left m-r-20">
										<i class="fa fa-graduation-cap"></i>
									</div>
									<div class="media-body">
										<h3>Sarjana Komputer</h3>
										<text>Universitas Gajah Mada . <small>S1</small></text>
									</div>

									<div class="media-body m-l-0">
										<div class="m-b-10 m-t-2">
											<i class="fa fa-map-marker m-r-15"></i> Jakarta
										</div>
										<div class="text-fade">
											<i class="fa fa-clock-o m-r-5"></i> 10 ag - 20 ag 2022
										</div>
									</div>
									<div class="media-right nav-button btn-group">
										<button class="btn btn-secondary btn-custom" data-target="#modal-education" data-toggle="modal">
											<i class="fa fa-pencil"></i>
										</button>
										<button class="btn btn-secondary btn-custom" onclick="del()">
											<i class="fa fa-trash"></i>
										</button>
									</div>
								</div>

								<div class="exp-desc m-t-10 p-l-80">
								</div>
							</li>
							<?php }?>
						</ul>
					</div>
				</div>
				
			</div>
		</div>
	</div>		
</div>


<div class="modal fade" id="modal-skills" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modify Skills</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fa fa-close"></i>
        </button>
      </div>

			<form id="modify-skill">
				<div class="modal-body p-b-0">
					<input type="text" name="skill" class="form-control m-b-10" placeholder="Enter Your Skill for Add New">
					<div class="scroll-skills">
						<ul class="tag-skills p-t-13 p-b-30">
							<?php for($i=0; $i<=10; $i++) { ?>
							<li class="btn">HTML
								<a href="javascript:void(0)">
									<i class="fa fa-close"></i>
								</a>
							</li>
							<li class="btn">CSS
								<a href="javascript:void(0)">
									<i class="fa fa-close"></i>
								</a>
							</li>
							<li class="btn">PHP
								<a href="javascript:void(0)">
									<i class="fa fa-close"></i>
								</a>
							</li>							
							<?php } ?>
						</ul>
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

<div class="modal fade" id="modal-experience" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Experience</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fa fa-close"></i>
        </button>
      </div>
			
			<form id="add-experience">
				<div class="modal-body">
					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-sm-4 m-t-6">
							Position <i class="text-danger">*</i>
						</label>
						<input type="text" name="posisi" class="form-control col-sm-8" placeholder="Enter Position Name">
						<small class="form-control-feedback text-danger" id="err-posisi"></small>
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-sm-4 m-t-6">
							Company <i class="text-danger">*</i>
						</label>
						<input type="text" name="perusahaan" class="form-control col-sm-8" placeholder="Enter Company Name">
						<small class="form-control-feedback text-danger" id="err-perusahaan"></small>
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-sm-4 m-t-6">
							Work Type <i class="text-danger">*</i>
						</label>
						<select class="form-control col-sm-8" name="jenis_pekerjaan">
							<option value="">Select Work Type</option>
							<option value="">Freelance</option>
							<option value="">Fulltime</option>
						</select>
						<small class="form-control-feedback text-danger" id="err-jenis_pekerjaan"></small>
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-sm-4 m-t-6">
							Location <i class="text-danger">*</i>
						</label>
						<input type="text" name="lokasi_perusahaan" class="form-control col-sm-8" placeholder="Enter Location Company">
						<small class="form-control-feedback text-danger" id="err-lokasi_perusahaan"></small>
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-sm-4 m-t-6">
							Start From <i class="text-danger">*</i>
						</label>
						<input type="month" name="tgl_mulai_kerja" id="tgl_mulai" class="form-control col-sm-8">
						<small class="form-control-feedback text-danger" id="err-tgl_mulai_kerja"></small>
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<div class="col-sm-4"></div>
						<div class="col-sm-8 p-0 p-t-10">
							<div class="checkbox checkbox-success">
								<input id="masih_bekerja" type="checkbox" name="masih_bekerja">
								<label for="masih_bekerja">Current Work</label>
							</div>
						</div>
					</div>

					<div class="form-group row m-b-7 p-r-20" id="end-at">
						<label class="control-label col-sm-4 m-t-6">
							End at <i class="text-danger">*</i>
						</label>
						<input type="month" name="tgl_berakhir_kerja" id="tgl_berakhir" class="form-control col-sm-8">
						<small class="form-control-feedback text-danger" id="err-tgl_berakhir_kerja"></small>
					</div>

					<div class="form-group row m-b-7 p-r-20 p-b-30">
						<label class="control-label col-sm-4 m-t-6">Description</label>
						<textarea name="deskripsi_kerja" class="form-control col-sm-8" placeholder="Enter Description" rows="4"></textarea>
						<small class="form-control-feedback text-danger" id="err-deskripsi_kerja"></small>
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

<div class="modal fade" id="modal-education" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Education</h5>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fa fa-close"></i>
        </button>
      </div>
			<form id="add-education">
				<div class="modal-body">
					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-sm-4 m-t-6">
							Title <i class="text-danger">*</i>
						</label>
						<input type="text" name="gelar" class="form-control col-sm-8" placeholder="Enter Your Title">
						<small class="form-control-feedback text-danger" id="err-gelar"></small>
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-sm-4 m-t-6">
							Degree <i class="text-danger">*</i>
						</label>
						<select class="form-control col-sm-8" name="degree">
							<option value="">Select Your Degree</option>
							<option value="">DI</option>
							<option value="">DII</option>
							<option value="">DIII</option>
							<option value="">SI</option>
						</select>
						<small class="form-control-feedback text-danger" id="err-degree"></small>
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-sm-4 m-t-6">
							Location <i class="text-danger">*</i>
						</label>
						<input type="text" name="lokasi_sekolah" class="form-control col-sm-8" placeholder="Enter Location School">
						<small class="form-control-feedback text-danger" id="err-lokasi_sekolah"></small>
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<label class="control-label col-sm-4 m-t-6">
							Start From <i class="text-danger">*</i>
						</label>
						<input type="month" name="tgl_mulai_sekolah" id="tgl_mulai" class="form-control col-sm-8">
						<small class="form-control-feedback text-danger" id="err-tgl_mulai_sekolah"></small>
					</div>

					<div class="form-group row m-b-7 p-r-20">
						<div class="col-sm-4"></div>
						<div class="col-sm-8 p-0 p-t-10">
							<div class="checkbox checkbox-success">
								<input id="masih_sekolah" type="checkbox" name="masih_sekolah">
								<label for="masih_sekolah">Current Study</label>
							</div>
						</div>
					</div>

					<div class="form-group row m-b-7 p-r-20" id="end-school">
						<label class="control-label col-sm-4 m-t-6">
							Passed at <i class="text-danger">*</i>
						</label>
						<input type="month" name="tgl_berakhir_sekolah" id="tgl_berakhir" class="form-control col-sm-8">
						<small class="form-control-feedback text-danger" id="err-tgl_berakhir_sekolah"></small>
					</div>

					<div class="form-group row m-b-7 p-r-20 p-b-30">
						<label class="control-label col-sm-4 m-t-6">Description</label>
						<textarea name="deskripsi_sekolah" class="form-control col-sm-8" placeholder="Enter Description" rows="4"></textarea>
						<small class="form-control-feedback text-danger" id="err-deskripsi_sekolah"></small>
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


