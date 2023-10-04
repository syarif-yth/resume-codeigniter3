


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
								<a href="javascript:void(0)">Jawa Tengah</a>
							</div>
						</li>

						<li class="media m-b-15">
							<div class="media-left m-r-15">
								<i class="fa fa-birthday-cake"></i>
							</div>
							<div class="media-body">
								<h4 class="media-heading">Birth of Day</h4>
								<a href="javascript:void(0)">Cilacap, 10 Jun 2000</a>
							</div>
						</li>
					</ul>
				</div>

				<button type="button" class="btn btn-secondary btn-custom btn-block" onclick="history.back(1)">Back</button>
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<div class="card">
			<ul class="nav">
				<li class="nav-item card-title m-l-7 m-t-10 m-b-2">Skills</li>
			</ul>

			<div class="card-body m-t-8" style="border-top: 1px solid #DDD">
				<ul class="tag-skills p-t-13">
					<?php for($i=0; $i<=1; $i++) { ?>
					<li class="">HTML</li>
					<li class="">CSS</li>
					<li class="">PHP</li>
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
			</ul>

			<div class="tab-content">
				<div class="tab-pane active" id="experience" role="tabpanel">
					<div class="card-body card-media">

						<?php for($i=0; $i<=3; $i++) { ?>

						<div class="body-media-profile p-20">
							<div class="row">
								<div class="col-1 p-0">
									<div class="icon-media-profile">
										<i class="fa fa-building-o"></i>
									</div>
								</div>

								<div class="col-10">
									<div class="row">
										<div class="col-md-5 m-b-10">
											<a href="javascript:void(0)"><h3>Manager</h3></a>
											<a href="javascript:void(0)"><text>PT. ABC &bull; <small>Kontrak</small></text></a>
										</div>

										<div class="col-md-7 m-b-10">
											<div class="m-b-10 m-t-2">
											<a href="javascript:void(0)"><i class="fa fa-map-marker m-r-15"></i> Jakarta</a>
											</div>
											<div class="text-fade">
											<a href="javascript:void(0)"><i class="fa fa-clock-o m-r-5"></i> 10 ag - 20 ag 2022</a>
											</div>
										</div>
										
										<div class="row col-12 m-l-0">
											<a href="javascript:void(0)">Lorem ipsum dolor sit amet, consectetur adipisicing elit et cupiditate deleniti.Lorem ipsum dolor sit amet, consectetur adipisicing elit et cupiditate deleniti.</a>
										</div>
									</div>
								</div>

							</div>
						</div>

						<?php } ?>

					</div>
				</div>

				<div class="tab-pane" id="education" role="tabpanel">
					<div class="card-body card-media">

						<?php for($i=0; $i<=1; $i++) { ?>
						<div class="body-media-profile p-20">
							<div class="row">
								<div class="col-1 p-0">
									<div class="icon-media-profile">
										<i class="fa fa-graduation-cap"></i>
									</div>
								</div>

								<div class="col-10">
									<div class="row">
										<div class="col-md-5 m-b-10">
											<a href="javascript:void(0)"><h3>Sarjana Komputer</h3></a>
											<a href="javascript:void(0)"><text>Universitas Indonesia &bull; <small>SII</small></text></a>
										</div>

										<div class="col-md-7 m-b-10">
											<div class="m-b-10 m-t-2">
											<a href="javascript:void(0)"><i class="fa fa-map-marker m-r-15"></i> Jakarta</a>
											</div>
											<div class="text-fade">
											<a href="javascript:void(0)"><i class="fa fa-clock-o m-r-5"></i> 10 ag - 20 ag 2022</a>
											</div>
										</div>
										
										<div class="row col-12 m-l-0">
												<a href="javascript:void(0)">Lorem ipsum dolor sit amet, consectetur adipisicing elit et cupiditate deleniti.</a>
											</div>
									</div>
								</div>

							</div>
						</div>
						<?php } ?>

					</div>
				</div>
				
			</div>
		</div>
	</div>		
</div>


