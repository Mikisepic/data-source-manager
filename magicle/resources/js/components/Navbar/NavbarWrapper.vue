<template>
	<div>
		<nav class="navbar navbar-vertical fixed-left d-none d-lg-block">
			<router-link class="navbar-brand" to="/dashboard">
				<img
					src="../../../../public/storage/img/logo.png"
					alt="MAGicle Logo"
					width="200"
					height="100"
				/>
			</router-link>

			<ul class="navbar-nav flex-column">
				<slot name="items"></slot>

				<li class="nav-item">
					<router-link class="nav-link" to="/api/auth/logout">
						<span class="icon material-icons-outlined"> logout </span>
						<span class="item-title">Logout</span>
					</router-link>
				</li>

				<theme-toggle />
			</ul>
		</nav>

		<nav class="navbar navbar-light navbar-expand-md d-lg-none">
			<div class="container-fluid">
				<router-link class="navbar-brand" to="/dashboard">
					<img
						src="../../../../public/storage/img/icon.png"
						alt="MAGicle Logo"
						width="50"
						height="50"
					/>
				</router-link>

				<button
					class="navbar-toggler"
					type="button"
					data-bs-toggle="collapse"
					data-bs-target="#navToggle"
					aria-controls="navToggle"
					aria-expanded="false"
					aria-label="Toggle navigation"
				>
					<span class="navbar-toggler-icon"></span>
				</button>

				<div
					class="collapse navbar-collapse justify-content-end"
					id="navToggle"
				>
					<ul class="navbar-nav">
						<slot name="items"></slot>

						<li class="nav-item">
							<router-link class="nav-link" to="/auth/logout">
								<span
									class="
										icon
										d-block d-md-none d-lg-block
										material-icons-outlined
									"
								>
									logout
								</span>
								<span class="item-title">Logout</span>
							</router-link>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
</template>
