<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
						<a href="" class="app-brand-link gap-2 py-1">
							<span class="app-brand-logo demo">
							  <img width="70" src="assets/img/favicon/garage.png" alt="Garage logo">
							</span>
							<span class="app-brand-text demo text-body fw-bolder"> Garage</span>
						</a>
                    </div>
                    <!-- /Logo -->
                    <center><h4 class="mb-2">Connexion en tant que Admin </h4></center>
                    <center><p class="mb-4">Mode Admin</p></center>

                    <form id="formAuthentication" class="mb-3" action="<?php echo base_url("connect_admin") ?>" method="post">
						<!-- Raha ohatra ka diso ny mot de passe -->
						<?php if ($error) { ?>
							<div class="alert alert-danger alert-dismissible">
								<?php echo $message ?>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						<?php } ?>
						<!-- fin -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input value="garage@gmail.com" type="email" class="form-control" name="email"  placeholder="Saisissez votre email" autofocus required/>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mot de passe</label>
                            <input value="admin" type="password" class="form-control" name="mdp"  placeholder="Saisissez votre mot de passe" autofocus required/>
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Se connecter</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>
