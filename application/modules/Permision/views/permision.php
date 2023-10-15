

<div class="row">
	<div class="col-12">
		<div class="card card-edit card-outline-primary">
			<div class="card-body">
				<form id="permision-form">
					<div class="form-body">
						<h3 class="card-title">Edit Permision</h3>
						<hr>
						
						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<label class="control-label">Rule Name</label>
									<input type="text" name="nama" class="form-control">
								</div>
							</div>

							<div class="col-6">
								<div class="form-group">
									<label class="control-label">Rule Label</label>
									<input type="text" name="label" class="form-control">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label">Navigation Allowed</label>
							<input type="text" name="navigasi" id="navigasi-akses" class="form-control" data-placeholder="Select Navigasi" data-minimum-results-for-search="1" data-multiple="true">
						</div>

						<div class="form-group">
							<label class="control-label">Rules Access</label>
							<div id="jsoneditor" style="height: 400px;"></div>
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



			<!-- <div class="card-body">
				<form id="permision-form">
					<div class="form-body">
						<h3 class="card-title">Edit User</h3>
						<hr>

						<div class="form-group">
							<label class="control-label">class</label>
							<input type="text" name="class" class="form-control">
						</div>

						<div class="form-group">
							<label class="control-label">action</label>
							<input type="text" name="action" class="form-control">
						</div>

						<div class="form-group">
							<label class="control-label">method</label>
							<input type="text" name="method" class="form-control">
						</div>

						<div class="form-group">
							<label class="control-label">child</label>
							<input type="text" name="child" class="form-control">
						</div>

					</div>

					<div class="form-actions text-center m-t-20">
						<button type="submit" class="btn btn-secondary hover-info">
							<i class="fa fa-save"></i> Save
						</button>
						<button onclick="history.back(1)" type="button" class="btn btn-secondary">Cancel</button>
					</div>
				</form>
			</div> -->
			
		</div>
	</div>
</div>

