


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
							<input placeholder="Search Name...." type="search" class="form-control">
						</div>
					</div>
					
					<div class="col-3">
						<input type="text" name="lokasi_filter" id="lokasi-filter" class="form-control" data-placeholder="Select Location" data-minimum-results-for-search="2">
					</div>
					
					<div class="col-3">
						<div id="auto-profesi" class="autocomplete-wrapper"></div>
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
			<div class="card p-0">
				<div class="card-body card-media">
					<div class="body-media-resume p-20">

						<div class="row">
							<div class="col-1 p-0">
								<div class="icon-media-resume">
									<a href="javascript:void(0)">
										<img src="<?=base_url().$avatar?>" alt="" class="avatar-md img-thumbnail rounded-circle">
									</a>
								</div>
							</div>
							
							<div class="col-9 col-lg-10">
								<div class="row m-t-5">
									<div class="col-md-5 m-b-10">
										<a href="javascript:void(0)">
											<h3>Charles Dickens</h3>
										</a>
										<a href="javascript:void(0)">
											<text>Project Manager</text>
										</a>
									</div>

									<div class="col-md-7">
										<div class="m-b-10 m-t-2">
										<a href="javascript:void(0)"><i class="fa fa-map-marker m-r-15"></i> Jakarta</a>
										</div>
										<div class="text-fade">
										<a href="javascript:void(0)"><i class="fa fa-building-o m-r-15"></i>4 Experience</a>
										</div>
									</div>
								
								</div>
							</div>

							<div class="nav-button btn-group">
								<a href="<?=base_url()?>resume/detail" class="btn btn-secondary btn-custom">
									<i class="fa fa-eye"></i>
								</a>
							</div>
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
