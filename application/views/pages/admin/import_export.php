<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">
		<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Formulaire /</span> Importation</h4>

		<div class="row">
			<div class="col-lg-6 mx-auto">
				<div class="card mb-4">
					<div class="card-header d-flex justify-content-between align-items-center">
						<h5 class="mb-0">Importer</h5>
					</div>
					<div class="card-body">
						<form method="post" action="<?php echo base_url("CTRL_import_export/valid_formImport_export") ?>" enctype="multipart/form-data">
							<div class="mb-3">
								<label class="form-label" for="nomService">Service</label>
								<input name="service" type="file" class="form-control" id="nomService" placeholder="parcourir" required/>
							</div>
							<div class="mb-3">
								<label class="form-label" for="duree">Travaux</label>
								<input name="travaux" type="file" class="form-control" id="duree" placeholder="parcourir" required/>
							</div>

							<center><button type="submit" class="btn btn-success">Importer</button></center>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- / Content -->
</div>
<!-- / Content wrapper -->
