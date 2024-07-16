<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">

		<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Garage/</span>  Services</h4>

		<!-- Basic Bootstrap Table -->
		<div class="card">
			<h5 class="card-header">Liste des services</h5>
			<div class="card-body">
				<div class="mb-3">
					<a href="" type="button" class="btn btn-success">Ajouter</a>
				</div>
			</div>
			<div class="table-responsive text-nowrap" style="overflow-x: visible;">
				<?php if ($services != null) { ?>
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Nom du service</th>
							<th>Durée du service</th>
							<th>Prix du service</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody class="table-border-bottom-0">
					
					<?php foreach ($services as $service) { ?>
						<tr>
							<td><strong><?php echo $service["id_service"] ?></strong></td>
							<td><?php echo $service["nom_service"] ?></td>
							<td><?php echo $service["durre"] ?></td>
							<td><?php echo $service["prix_service"] ?> ariary</td>
							<td>
								<div class="dropdown">
									<button type="button" class="btn p-0 dropdown-toggle hide-arrow"
											data-bs-toggle="dropdown">
										<i class="bx bx-dots-vertical-rounded"></i>
									</button>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="<?php echo base_url("?id_service=".$service["id_service"]); ?>">
											<i class="bx bx-edit-alt me-1"></i>
											Modifier
										</a>
										<a class="dropdown-item" href="<?php echo base_url("?id_service=".$service["id_service"]); ?>">
											<i class="bx bx-trash me-1"></i>
											Supprimer
										</a>
									</div>
								</div>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
				<?php } ?>
			</div>
		</div>
		<!--/ Basic Bootstrap Table -->
	</div>
	<!-- / Content -->
</div>
<!-- / Content wrapper -->
