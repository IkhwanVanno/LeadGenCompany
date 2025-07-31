<footer class="py-4 bg-white border-top">
<div class="container">
	<div class="row align-items-center">
	<div class="col-md-6">
		<div class="d-flex align-items-center">
		<% if SiteConfig.Logo %>
        <img
          src="$SiteConfig.Logo.URL"
          alt="Logo"
          width="50"
          height="50"
          class="me-2"
        />
        <% end_if %>
		<div>
			<span class="fw-bold fs-4 text-dark">$SiteConfig.CompanyFirstName</span
			><span class="fs-4 text-dark">$SiteConfig.CompanyLastName</span>
		</div>
		</div>
	</div>
	<div class="col-md-6 text-md-end text-center mt-3 mt-md-0">
		<p class="text-muted mb-0">$SiteConfig.FooterCredit</p>
	</div>
	</div>
</div>
</footer>