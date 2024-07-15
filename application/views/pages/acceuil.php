
<!-- page rendez vous -->

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Vertical-menu -->
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
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-car"></i>
                        <div>Garage</div>
                    </a>
                </li>

                <!-- Rendez-vous -->
                <li class="menu-item active">
                    <a href="category" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-category"></i>
                        <div>Rendez-vous</div>
                    </a>
                </li>

                <!-- Autres -->
                <li class="menu-item">
                    <a href="ingredient" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-dish"></i>
                        <div>Autres</div>
                    </a>
                </li>
            </ul>
        </aside>
        <!-- Vertical menu fin -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="bx bx-menu bx-sm"></i>
                    </a>
                </div>

                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <!-- User -->
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                <div class="d-flex align-items-center avatar avatar-online">
                                    <i class="bx bx-user-circle fs-3em"></i>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="d-flex align-items-center avatar avatar-online">
                                                    <i class="bx bx-user-circle fs-3em"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <span class="fw-semibold d-block">John Doe</span>
                                                <small class="text-muted">Connected</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">
                                        <i class="bx bx-log-out me-2"></i>
                                        <span class="align-middle">Me déconnecter</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--/ User -->
                    </ul>
                </div>
            </nav>
            <!-- / Navbar -->

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
                                    <form method="" action="">
                                        <div class="mb-3">
                                            <label for="slot" class="form-label">SLOT</label>
                                            <select name="" id="slot" class="form-select" required>
                                                <option value="">A</option>
                                                <option value="">B</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Services</label>
                                            <select name="service" id="" class="form-select" required>
												<?php for ($i=0; $i < count ($services); $i++) { ?>
												<option value="<?php echo $services[$i]["id_service"] ?>"><?php echo "seee" ?></option>
												<?php } ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="date">Date</label>
                                            <input value="" name="" type="datetime-local" class="form-control" id="date" required />
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
        </div>
        <!-- / Layout container -->
    </div>
</div>
<!-- / Layout wrapper -->
