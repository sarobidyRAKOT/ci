<!-- Content wrapper -->

<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">
		<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Formulaire /</span> Service</h4>

		<div class="row">
			<div class="col-lg-6 mx-auto">
				<div class="card mb-4">
					<div class="card-header d-flex justify-content-between align-items-center">
						<h5 class="mb-0">Modifier service</h5>
					</div>
					<div class="card-body">
						<form method="post" action="<?php echo base_url("ajouter_service") ?>">
							<input type="hidden" name="id_service" > 
							<div class="mb-3">
								<label class="form-label" for="nomService">Nom du service</label>
								<input name="nom_service" type="text" class="form-control" id="nomService" placeholder="Nom du service" required/>
							</div>
							<div class="mb-3">
								<label class="form-label" for="duree">Date modification</label>
								<input name="date" type="date" class="form-control" id="duree" placeholder="Date" required/>
							</div>
							<div class="mb-3">
								<label class="form-label" for="duree">Durée service</label>
								<input name="durre" type="time" class="form-control" id="duree" placeholder="Durée" required/>
							</div>
							<div class="mb-3">
								<label class="form-label" for="prixService">Prix Service</label>
								<input name="prix" type="number" class="form-control" id="prixService" placeholder="Prix du service" required/>
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
<!-- / Content wrapper -->
