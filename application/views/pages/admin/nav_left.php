<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<!-- App brand -->
	<div class="app-brand demo">
		<a href="recipe" class="app-brand-link">
			<span class="app-brand-logo demo">
				<img width="25" src="<?php echo base_url("assets/img/favicon/garage.png") ?>" alt="Garage logo">
			</span>
			<span class="app-brand-text demo menu-text fw-bolder ms-2">Garage</span>
		</a>

		<a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
			<i class="bx bx-chevron-left bx-sm align-middle"></i>
		</a>
	</div>
	<!-- / App brand -->

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1">
		<!-- Garage -->
		<li class="menu-item <?php if (isset($garage)) { echo $garage; } ?>">
			<a href="" class="menu-link">
				<i class="menu-icon tf-icons bx bx-car"></i>
				<div>Garage</div>
			</a>
		</li>

		<!-- Rendez-vous -->
		<li class="menu-item <?php if (isset($acceuil)) { echo $acceuil; } ?>">
			<a href="<?php echo base_url ("acceuil_admin") ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-category"></i>
				<div>Liste services</div>
			</a>
		</li>
		<!-- Autres -->
		<li class="menu-item <?php if (isset($import_export)) { echo $import_export; } ?>">
			<a href="<?php echo base_url ("import_export") ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cloud-upload"></i>
                <div data-i18n="Ingredients">Import Export</div>
            </a>
        </li>

		<li class="menu-item <?php if (isset($calendrier)) { echo $calendrier; } ?>">
			<a href="<?php echo base_url ("calendrier") ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-calendar"></i>
				<div>Calendrier</div>
			</a>
		</li>

		<li class="menu-item <?php if (isset($supprimer)) { echo $supprimer; } ?>">
			<a href="<?php echo base_url ("supprimer") ?>" class="menu-link">
			  <i class="menu-icon tf-icons bx bx-trash"></i>
			  <div>Supprimer tous</div>
			</a>
		</li>
		<li class="menu-item <?php if (isset($config_date)) { echo $config_date; } ?>">
			<a href="<?php echo base_url ("config_date") ?>" class="menu-link">
			  <i class="menu-icon tf-icons bx bx-cog"></i>
			  <div>Config Date Ref</div>
			</a>
		</li>

		<li class="menu-item <?php if (isset($dashboard)) { echo $dashboard; } ?>">
			<a href="<?php echo base_url ("dashboard") ?>" class="menu-link">
			  <i class="menu-icon tf-icons bx bx-chart"></i>
			  <div>Dashboard</div>
			</a>
		</li>

		<li class="menu-item <?php if (isset($utilisation_slot)) { echo $utilisation_slot; } ?>">
			<a href="<?php echo base_url ("utilisation_slot") ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-list-ul"></i>
				<div>Utilisation slot</div>
			</a>
		</li>
	</ul>
</aside>
