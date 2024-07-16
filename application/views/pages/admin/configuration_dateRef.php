<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">
		<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Formulaire /</span> Date de reférence</h4>

		<div class="row">
			<div class="col-lg-6 mx-auto">
				<div class="card mb-4">
					<div class="card-header d-flex justify-content-between align-items-center">
						<h5 class="mb-0">Entrer date</h5>
					</div>
					<div class="card-body">
						<form method="post" action="<?php echo base_url ("insert_ref") ?>">
							<div class="mb-3">
								<label class="form-label" for="date">Entrer une date de reference</label>
								<input value="" name="date_ref" type="date" class="form-control" id="date" required />
							</div>
							<center><button type="submit" class="btn btn-success">Valider</button></center>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- / Content -->
</div>
