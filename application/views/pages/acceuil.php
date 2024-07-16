<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">
		<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Formulaire /</span> Rendez-vous</h4>

		<div class="row">
			<div class="col-lg-6 mx-auto">
				<div class="card mb-4">
					<div class="card-header d-flex justify-content-between align-items-center">
						<h5 class="mb-0">Donner rendez-vous</h5>
					</div>
					<div class="card-body">
						<form method="post" action="<?php echo base_url("prendre_rdv") ?>">

							<div class="mb-3">
								<label for="" class="form-label">Services</label>
								<select name="id_service" id="" class="form-select">
									<?php for ($i=0; $i < count ($services); $i++) { ?>
									<option value="<?php echo $services[$i]["id_service"] ?>"><?php echo $services[$i]["nom_service"] ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="mb-3">
								<label class="form-label" for="date">Date</label>
								<input name="dateTime" type="datetime-local" class="form-control" id="date" required />
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
