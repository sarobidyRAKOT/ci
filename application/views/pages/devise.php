<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">

		<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Garage/</span>  Devises</h4>

		<!-- Basic Bootstrap Table -->
		<div class="card">
			<h5 class="card-header">Liste des devises</h5>
			<div class="card-body">
				<div class="mb-3">
				</div>
			</div>
			<div class="table-responsive text-nowrap" style="overflow-x: visible;">
				<?php if ($info_devises != null) { ?>
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Nom du Client</th>
							<th>Nom du service</th>
							<th>Prix service</th>
							<th>Date de paiement</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody class="table-border-bottom-0">
						<?php foreach ($info_devises as $info_devise) { ?>
						<tr>
							<td><strong><?php echo $info_devise["id_devise"] ?></strong></td>
							<td><?php echo $info_devise["e_mail"] ?></td>
							<td><?php echo $info_devise["nom_service"] ?></td>
							<td><?php echo $info_devise["prix_service"] ?> ariary</td>
							<td>
							<?php if (empty($info_devise["payement"])) { echo "non payées";
							} else { echo $info_devise["payement"]; } ?>
							</td>
							<td>
								<div class="dropdown">
									<button type="button" class="btn p-0 dropdown-toggle hide-arrow"
											data-bs-toggle="dropdown">
										<i class="bx bx-dots-vertical-rounded"></i>
									</button>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="<?php echo base_url("CTRL_devise/format_pdf?id_devise=".$info_devise["id_devise"]) ?>">
											<i class="bx bx-edit-alt me-1"></i>
											Format PDF
										</a>
									</div>
								</div>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php } else { ?>
					<h1>Vous n'avez pas de devise !!</h1>
				<?php } ?>
			</div>
		</div>
		<!--/ Basic Bootstrap Table -->
	</div>
	<!-- / Content -->
</div>
<!-- / Content wrapper -->
