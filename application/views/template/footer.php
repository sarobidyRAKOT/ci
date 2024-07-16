<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script>
	// Récupération des données PHP passées à JavaScript
	var dashData = <?php echo $dash_json; ?>;
	
	// Adapter les données pour le graphique
	var options = {
		chart: {
			type: 'line'
		},
		series: [{
			name: 'Payé',
			data: [parseInt(dashData.chiffre_affaire_paye)]
		}, {
			name: 'Non Payé',
			data: [parseInt(dashData.chiffre_affaire_non_paye)]
		}],
		xaxis: {
			type: 'datetime',
			categories: [dashData.date_reference]
		},
		yaxis: {
			title: {
				text: 'Montant'
			}
		},
		title: {
			text: 'Montants Payés et Non Payés',
			align: 'left'
		}
	};

	var chart = new ApexCharts(document.querySelector("#chart"), options);
	chart.render();
</script>
<script>
	// Fonction pour afficher une alerte SweetAlert
	function showAlert() {
		swal.fire({
			title: 'Succès!',
			text: 'Votre opération a été réalisée avec succès.',
			icon: 'success',
			confirmButtonText: 'Ok'
		});
	}
</script>
<script src="<?php echo base_url("assets/vendor/libs/jquery/jquery.js") ?>"></script>
<script src="<?php echo base_url ("assets/vendor/libs/popper/popper.js") ?>"></script>
<script src="<?php echo base_url ("assets/vendor/js/bootstrap.js") ?>"></script>
<script src="<?php echo base_url ("assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js") ?>"></script>

<script src="<?php echo base_url ("assets/vendor/js/menu.js") ?>"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<!-- Main JS -->
<script src="<?php echo base_url ("assets/js/main.js") ?>"></script>
<!-- Page JS -->
<script src="<?php echo base_url ("assets/js/dashboards-analytics.js") ?>"></script>

</body>
</html>
