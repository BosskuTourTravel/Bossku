<?php include "slug.php"; ?>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #02335B;">
	<div class="container">
		<!-- Logo -->
		<a class="navbar-brand" href="<?php echo $domain_web ?>">
			<img src="img/LogoWeb.png" alt="Bossku Tour & Travel" width="120" class="img-fluid">
		</a>

		<!-- Tombol Toggle -->
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
			<span class="navbar-toggler-icon"></span>
		</button>

		<!-- Menu Tengah -->
		<div class="collapse navbar-collapse justify-content-center" id="navbarNav">
			<ul class="navbar-nav text-center">
				<li class="nav-item"><a class="nav-link fw-bold text-white" href="<?php echo $domain_web ?>">HOME</a></li>
				<li class="nav-item"><a class="nav-link fw-bold text-white" href="<?php echo $domain_web ?>about.php">ABOUT</a></li>
				<li class="nav-item"><a class="nav-link fw-bold text-white" href="<?php echo $domain_web ?>faq.php">FAQ</a></li>
				<li class="nav-item"><a class="nav-link fw-bold text-white" href="<?php echo $domain_web ?>terms_condition.php">TERMS & CONDITIONS</a></li>
				<li class="nav-item"><a class="nav-link fw-bold text-white" href="<?php echo $domain_web ?>privacy_policy.php">PRIVACY POLICY</a></li>
			</ul>
		</div>

		<!-- Button di Kanan -->
		<div class="d-flex gap-2">
			<a href="<?php echo $domain_web ?>member/">
				<button class="btn keranjang-btn">Keranjang</button>
			</a>
			<a href="<?php echo $domain_web ?>member/">
				<button class="btn login-btn">Login</button>
			</a>
		</div>
	</div>
</nav>

<!-- CSS -->
<style>
	/* Button Keranjang */
	.keranjang-btn {
		background-color: #FFCA10;
		height: 35px;
		width: 100px;
		font-size: 15px;
		font-weight: bold;
		border: none;
		transition: 0.3s;
	}

	.keranjang-btn:hover {
		color: #FFCA10;
		background-color: #02335B;
	}

	/* Button Login */
	.login-btn {
		background-color: #FFFFFF;
		height: 35px;
		width: 100px;
		font-size: 15px;
		font-weight: bold;
		color: #02335B;
		border: 2px solid #02335B;
		transition: 0.3s;
	}

	.login-btn:hover {
		background-color: #02335B;
		color: #FFFFFF;
	}

	/* Responsif */
	@media (max-width: 991px) {
		.navbar-brand img {
			width: 100px; /* Ukuran logo lebih kecil di layar kecil */
		}

		.d-flex.gap-2 {
			flex-wrap: wrap; /* Agar button tidak berdesakan */
			justify-content: center;
			margin-top: 10px;
		}
	}
</style>
