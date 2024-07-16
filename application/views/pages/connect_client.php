
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
							<img width="70" src="<?php echo base_url("assets/img/favicon/garage.png") ?>" alt="Garage logo">
							</span>
							<span class="app-brand-text demo text-body fw-bolder"> Garage</span>
						</a>
					</div>
					<!-- /Logo -->
					<center><h4 class="mb-2">Bienvenue dans le garage </h4></center>
					<center><p class="mb-4">Connectez-vous !</p></center>

					<form id="formAuthentication" class="mb-3" action="<?php echo base_url("connect_client") ?>" method="post">
						<!-- Raha ohatra ka diso ny mot de passe -->
						<?php if ($error) { ?>
							<div class="alert alert-danger alert-dismissible">
								<?php echo $message ?>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						<?php } ?>
						<!-- fin -->
						<div class="mb-3">
							<label class="form-label">Matricule</label>
							<input value="2512 TBH" type="text" class="form-control" name="matricule" placeholder="Saisissez votre numero de voiture" autofocus required />
						</div>
						<div class="mb-3">
							<label class="form-label">Type de voiture</label>
							<input value="legère" type="text" class="form-control" name="type" placeholder="Saisissez le type de voiture" autofocus required />
						</div
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


