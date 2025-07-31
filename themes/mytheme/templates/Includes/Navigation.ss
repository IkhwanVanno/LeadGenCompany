<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav ms-auto">
	<% loop $Menu(1) %>
	<li class="nav-item $LinkingMode">
		<a class="nav-link fw-bold" href="$Link" title="$Title.XML">$MenuTitle.XML</a>
	</li>
	<% end_loop %>
	<li class="nav-item $LinkingMode">
		<a class="nav-link fw-bold" href="#About">About</a>
	</li>
	<li class="nav-item $LinkingMode">
		<a class="nav-link fw-bold" href="#Treatments">Treatments</a>
	</li>
	<li class="nav-item $LinkingMode">
		<a class="nav-link fw-bold" href="#Packages">Packages</a>
	</li>
	<li class="nav-item $LinkingMode">
		<a class="nav-link fw-bold" href="#Gallery">gallery</a>
	</li>
	<li class="nav-item $LinkingMode">
		<a class="nav-link fw-bold" href="#Testimonial">Testimonial</a>
	</li>
	<li class="nav-item $LinkingMode">
		<a class="nav-link fw-bold" href="#Contact">Contact</a>
	</li>
</ul>

<% if $SearchForm %>
	<div class="d-flex ms-3">
	$SearchForm
	</div>
<% end_if %>
</div>