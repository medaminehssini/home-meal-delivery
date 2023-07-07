			<!-- sidebar -->
			<div class="sidebar app-aside" id="sidebar">
				<div class="sidebar-container perfect-scrollbar">
					<nav>

						<!-- start: MAIN NAVIGATION MENU -->
						<div class="navbar-title">
							<span>Navigation principale</span>
						</div>
						<ul class="main-navigation-menu">
	
							@if (Auth::guard('admin')->check())

								<li class="{{   request()->is('liste/admin') ? 'active  open' : '' }}">
									<a href="{{ url('liste/admin', []) }}">
										<div class="item-content">
											<div class="item-media">
												<i class="fa fa-suitcase"></i>
											</div>
											<div class="item-inner">
												<span class="title"> Gérer Admin </span>
											</div>
										</div>
									</a>
								</li>
								<li class="{{   request()->is('liste/users') ? 'active  open' : '' }}">
									<a href="{{ url('liste/users', []) }}">
										<div class="item-content">
											<div class="item-media">
												<i class="fa fa-users"></i>
											</div>
											<div class="item-inner">
												<span class="title"> Gérer Client </span>
											</div>
										</div>
									</a>

								</li>
								<li class="{{ (request()->is('liste/fournisseur')) ? 'active  open' : '' }}">
									<a href="{{ url('liste/fournisseur', []) }}">
										<div class="item-content">
											<div class="item-media">
												<i class="fa fa-user"></i>
											</div>
											<div class="item-inner">
												<span class="title"> Gérer Fournisseur </span>
											</div>
										</div>
									</a>
								</li>
								<li class="{{ (request()->is('liste/commande')) ? 'active  open' : '' }}">
									<a href="{{ url('liste/commande', []) }}">
										<div class="item-content">
											<div class="item-media">
												<i class="fa fa-shopping-cart"></i>
											</div>
											<div class="item-inner">
												<span class="title"> Consulter Commande </span>
											</div>
										</div>
									</a>
								</li>
								<li class="{{   request()->is('liste/coupons') ? 'active  open' : '' }}">
									<a href="{{ url('liste/coupons', []) }}">
										<div class="item-content">
											<div class="item-media">
												<i class="fa fa-ticket"></i>
											</div>
											<div class="item-inner">
												<span class="title">Gérer Coupon </span>
											</div>
										</div>
									</a>

								</li>
								<li class="{{   request()->is('liste/specialite') ? 'active  open' : '' }}">
									<a href="{{ url('liste/specialite', []) }}">
										<div class="item-content">
											<div class="item-media">
												<i class="fa fa-tag"></i>
											</div>
											<div class="item-inner">
												<span class="title">Gérer Spécialité </span>
											</div>
										</div>
									</a>

								</li>
								<li class="{{ (request()->is('liste/transporteur')) ? 'active  open' : '' }}">
									<a href="{{ url('liste/transporteur', []) }}">
										<div class="item-content">
											<div class="item-media">
												<i class="fa fa-truck"></i>
											</div>
											<div class="item-inner">
												<span class="title">Gérer Transporteur </span>
											</div>
										</div>
									</a>
								</li>
							@endif

							@if (Auth::guard('transporteur')->check())
								<li class="{{ (request()->is('transporteur/liste/commande')) ? 'active  open' : '' }}">
									<a href="{{ url('transporteur/liste/commande', []) }}">
										<div class="item-content">
											<div class="item-media">
												<i class="fa fa-shopping-cart"></i>
											</div>
											<div class="item-inner">
												<span class="title"> Commande </span>
											</div>
										</div>
									</a>

								</li>
								<li class="{{ (request()->is('transporteur/liste/historique/commande')) ? 'active  open' : '' }}">
									<a href="{{ url('transporteur/liste/historique/commande', []) }}">
										<div class="item-content">
											<div class="item-media">
												<i class="fa fa-truck"></i>
											</div>
											<div class="item-inner">
												<span class="title"> Livraison </span>
											</div>
										</div>
									</a>
								</li>	
							@endif
							@if (Auth::guard('fournisseur')->check())
								<li class="{{   request()->is('fournisseur/liste/commande') ? 'active  open' : '' }}">
									<a href="{{ url('fournisseur/liste/commande', []) }}">
										<div class="item-content">
											<div class="item-media">
												<i class="fa fa-shopping-cart"></i>
											</div>
											<div class="item-inner">
												<span class="title"> Gérer Commande </span>
											</div>
										</div>
									</a>
								</li>
								<li class="{{   request()->is('fournisseur/liste/restaurant') ? 'active  open' : '' }}">
									<a href="{{ url('fournisseur/liste/restaurant', []) }}">
										<div class="item-content">
											<div class="item-media">
												<i class="fa fa-cutlery"></i>
											</div>
											<div class="item-inner">
												<span class="title"> Gérer Restaurant </span>
											</div>
										</div>
									</a>
								</li>

							@endif
							<li class="{{ (request()->is('edit/profile')) ? 'active  open' : '' }}">
								<a href="{{ url('edit/profile', []) }}">
									<div class="item-content">
										<div class="item-media">
											<i class="fa fa-user"></i>
										</div>
										<div class="item-inner">
											<span class="title"> Modifier Profile </span>
										</div>
									</div>
								</a>
							</li>
						</ul>
						<!-- end: MAIN NAVIGATION MENU -->

					</nav>
				</div>
			</div>
			<!-- / sidebar -->