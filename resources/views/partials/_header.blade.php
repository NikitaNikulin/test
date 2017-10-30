@yield('home_banner')
<header class="navbar-fixed-top @yield('header_class')">
	<nav class="navbar ">
		<div class="b-menu">
			<ul class="b-menu-text">

			</ul>
		</div>
		<div class="container">
			<div class="row">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="b-menu">
						<div class="btn-b-bun">
							<span class="b-bun"></span>
							<span class="b-bun"></span>
							<span class="b-bun"></span>
						</div>
					</div>
					<a class="navbar-brand logo_active" href="{{ route('home') }}">
						@TagBlock([$type = 'img', $src = "/img/png/logo-orange.png", $size = "118_35"])
					</a>

					<a class="navbar-brand logo_not_active" href="{{ route('home') }}">
						@TagBlock([$type = 'img', $src = "/img/png/logo.png", $size = "118_35"])
					</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav nav_links">
						<li><a href="{{ route('home') }}">главная</a></li>
						<li><a href="">блог</a></li>
						<li><a href="">контакты</a></li>
						<li><a href="">моя корзина</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="how_work_scroll">
							@if(Request::url() == route('home'))
								<a href="#how-work">Как это работает?</a>
							@endif
						</li>
						<li class="menu_header">

						</li>
						@ReplaceBlock('auth.partials._authBlock')
					</ul>
				</div>
			</div><!-- /.container-fluid -->
		</div>
	</nav>
</header>
