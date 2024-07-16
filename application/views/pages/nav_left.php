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
			<a href="<?php echo base_url ("acceuil_client") ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-category"></i>
				<div>Rendez-vous</div>
			</a>
		</li>

		<!-- Autres -->
		<li class="menu-item <?php if (isset($devise)) { echo $devise; } ?>">
			<a href="<?php echo base_url ("devise") ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-dish"></i>
				<div>Voir devise</div>
			</a>
		</li>
	</ul>
</aside>
