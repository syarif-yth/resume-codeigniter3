



<style>
.avatar-md {
    height: 4rem;
    width: 4rem;
}
.resume-list .input-group .input-icon {
	position: absolute;
	z-index: 9;
	color: #968E96;
	line-height: 10px;
	padding: 10px;
}
.resume-list .input-group > input {
	padding-left: 30px !important;
}
.resume-list .form-control,
.row-info select.form-control {
	color: #968E96;
	height: 35px !important;
}
.row-info select {
	max-width: 100px;
	margin-left: 20px;
}
.pagination.paginate-resume .page-item.active a,
.pagination.paginate-resume .page-item.active:hover a {
	background:  #EE4323;
	color: #F1F1F1;
	border: 1px solid #EE4323;
}
.pagination.paginate-resume .page-item a {
	color: #968E96;
}
.pagination.paginate-resume .page-item:hover a {
	background: #D1D1D1;
	border: 1px solid #D1D1D1;
	color: #111;
}
.pagination.paginate-resume .page-item.disabled a,
.pagination.paginate-resume .page-item.disabled:hover {
	background: white !important;
	color: #968E96 !important;
}
</style>

<div class="justify-content-center row">
		<div class="col-lg-12">
				<div class="resume-list m-b-20 m-t-15">
						<form action="#" class="">
								<div class="row">
										<div class="col-4">
												<div class="input-group">
													<div class="input-icon">
														<i class="fa fa-search"></i>
													</div>
													<input placeholder="User name, Full name..." type="search" class="form-control">
												</div>
										</div>

										<div class="col-3">
											<select class="form-control" name="choices-single-location">
														<option value="AF">Afghanistan</option>
														<option value="AX">Åland Islands</option>
														<option value="AL">Albania</option>
											</select>
										</div>

										<div class="col-3">
												<select class="form-control" data-trigger="true">
														<option value="4">Accounting</option>
														<option value="1">IT &amp; Software</option>
														<option value="3">Marketing</option>
														<option value="5">Banking</option>
												</select>
										</div>

										<div class="col-2">
											<a class="pull-right btn btn-block btn-secondary" href="#"><i class="uil uil-filter"></i> Filter</a>
										</div>
								</div>
						</form>
				</div>
		</div>
</div>

<div class="row row-info">
		<div class="col-lg-12">
				<div class="align-items-center row">
						<div class="col-5">
							<h6 class="m-t-10">Showing 1 – 8 of 11 results</h6>
						</div>
						<div class="col-7">
								<div class="pull-right">
										<select class="form-control">
												<option value="df">Default</option>
												<option value="ne">Newest</option>
												<option value="od">Oldest</option>
												<option value="od">Experience Low</option>
												<option value="od">Experience High</option>
										</select>
								</div>

								<div class="pull-right">
										<select class="form-control">
												<option value="ne">5 per Page</option>
												<option value="ne">10 per Page</option>
												<option value="ne">15 per Page</option>
										</select>
								</div>
						</div>
				</div>

				
				<div class="candidate-list">
					<?php for($i=0; $i<=4; $i++) { ?>
						<div class="card">
								<div class="card-body">
										<div class="media">
											<div class="media-left m-r-20">
												<a href="javascript:void(0)">
													<img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="avatar-md img-thumbnail rounded-circle">
												</a>
											</div>

											<div class="media-body m-t-5">
												<h4>
													<a href="javascript:void(0)">Charles Dickens</a>
												</h4>
												<p class="text-muted m-t-15 m-b-0">Project Manager</p>
											</div>

											<div class="media-body m-t-5">
												<p class="text-muted m-t-5">
													<i class="fa fa-map-marker m-r-15"></i>Oakridge Lane Richardson
												</p>
												<p class="text-muted m-t-15 m-b-0">
													<i class="fa fa-building-o m-r-15"></i>4 Experience
												</p>
											</div>
											<div class="media-right nav-button btn-group">
												<a href="<?=base_url()?>resume/detail" class="btn btn-secondary btn-custom">
													<i class="fa fa-eye"></i>
												</a>
											</div>
										</div>
									</div>
							</div>

							
					<?php }?>
				</div>
		</div>
</div>


<div class="row">
	<div class="m-t-10 col-12">
		<nav>
			<div class="pagination paginate-resume mb-0 justify-content-center">
				<li class="page-item disabled">
					<a class="page-link" href="javascript:void(0)">
						<i class="fa fa-angle-double-left"></i>
					</a>
				</li>
				<li class="page-item active">
					<a class="page-link" href="javascript:void(0)">1</a>
				</li>
				<li class="page-item">
					<a class="page-link" href="javascript:void(0)">2</a>
				</li>
				<li class="page-item">
					<a class="page-link" href="javascript:void(0)">3</a>
				</li>
				<li class="page-item">
					<a class="page-link" href="javascript:void(0)">4</a>
				</li>
				<li class="page-item">
					<a class="page-link" href="javascript:void(0)">
						<i class="fa fa-angle-double-right"></i>
					</a>
				</li>
			</div>
		</nav>
	</div>
</div>
