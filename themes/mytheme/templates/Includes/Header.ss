<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="$BaseHref" rel="home">
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
          <span class="fw-bold fs-4 text-dark">$SiteConfig.Title</span>
          <% if $SiteConfig.Tagline %>
            <div class="fs-6 text-muted">$SiteConfig.Tagline</div>
          <% end_if %>
        </div>
      </a>

      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <% include Navigation %>
    </div>
  </nav>
</header>
