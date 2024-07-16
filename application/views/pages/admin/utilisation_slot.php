<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">

		<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Garage/</span>  Utilisation des slots / 25/12/2023</h4>

		<!-- Basic Bootstrap Table -->
		<div class="card">
			<h5 class="card-header">Liste des slots</h5>
			<div class="card-body">
				<div class="mb-3">
					<a href="<?php echo base_url ("vers_filtre_slot") ?>" class="btn btn-success">Filter</a>
				</div>
			</div>
			<div class="table-responsive text-nowrap" style="overflow-x: visible;">
				<table class="table">
					<thead>
					<tr>
						<th>SLOT A</th>
						<th>SLOT B</th>
						<th>SLOT C</th>
					</tr>
					</thead>
					<tbody class="table-border-bottom-0">
					<?php echo $tableRows; ?>	
					</tbody>
				</table>
				
			</div>
			
		</div>
		
		<!--/ Basic Bootstrap Table -->
	</div>
	<!-- / Content -->
</div>
<!-- / Content wrapper -->
