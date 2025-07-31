<main>
    <!-- Hero Section -->
    <section>
    <div
        id="carouselExampleCaptions"
        class="carousel slide"
        data-bs-ride="carousel"
    >
        <!-- Indicators -->
        <div class="carousel-indicators">
        <button
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="0"
            class="active"
            aria-current="true"
            aria-label="Slide 1"
        ></button>
        <button
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="1"
            aria-label="Slide 2"
        ></button>
        <button
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="2"
            aria-label="Slide 3"
        ></button>
        </div>

        <!-- Slides -->
        <div class="carousel-inner">
        <% loop Hero %>    
        <div class="carousel-item active">
            <img
            src="$Image.URL"
            class="d-block w-100"
            alt="sample1"
            style="height: 70vh; object-fit: cover"
            />
            <div class="carousel-caption d-none d-md-block">
                <h1 class="display-3 fw-bold text-white">$Title</h1>
                <p class="fs-4 text-white mt-3">$Description</p>
            </div>
        </div>
        <% end_loop %>
        </div>
        
        <!-- Controls -->
        <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev"
        >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
        </button>
        <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next"
        >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
        </button>
    </div>
    </section>

    <!-- About Section -->
    <section class="container py-5" id="About">
    <div class="row align-items-center">
        <div class="col-lg-6">
        <% if $SiteConfig.About %>
        <h6 class="text-uppercase text-muted mb-3">$SiteConfig.About</h6>
        <% end_if %>
        <% if $SiteConfig.SubAbout %>
        <h2 class="fw-bold mb-4">$SiteConfig.SubAbout</h2>
        <% end_if %>
        <% if SiteConfig.Description %>
        <p class="mb-3">$SiteConfig.Description</p>    
        <% end_if %>
        <button class="btn btn-primary btn-lg">CONTACT US</button>
        </div>
        <div class="col-lg-6">
        <div class="swiper">
            <div class="swiper-wrapper">
            <% loop AboutImage %>     
                <div class="swiper-slide">
                    <img src="$Image.URL" class="img-fluid" style="height: 250px; object-fit: cover;" />
                </div>
            <% end_loop %>
            </div>
        </div>
        </div>
    </div>
    </section>

    <!-- Treatments Section -->
    <section class="py-5 bg-light" id="Treatments">
    <div class="container">
        <div class="text-center mb-5">
        <% if $SiteConfig.SectionTreatmentsT %>
            <h2 class="text-uppercase fw-bold">$SiteConfig.SectionTreatmentsT</h2>
        <% end_if %>
        <% if $SiteConfig.SectionTreatmentsD %>
            <p class="text-muted">$SiteConfig.SectionTreatmentsD</p>
        <% end_if %>
        </div>

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs justify-content-center mb-4" id="treatmentTabs" role="tablist">
        <% loop Treatments %>
            <li class="nav-item" role="presentation">
            <button
                class="nav-link text-muted <% if First %>active<% end_if %>"
                id="tab-$ID"
                data-bs-toggle="tab"
                data-bs-target="#content-$ID"
                type="button"
                role="tab"
                aria-controls="content-$ID"
                aria-selected="<% if First %>true<% else %>false<% end_if %>">
                $Title
            </button>
            </li>
        <% end_loop %>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content" id="treatmentTabsContent">
        <% loop Treatments %>
            <div
            class="tab-pane fade <% if First %>show active<% end_if %>"
            id="content-$ID"
            role="tabpanel"
            aria-labelledby="tab-$ID">
            <div class="row align-items-center">
                <div class="col-lg-6">
                <img src="$Image.URL" alt="$Title" class="img-fluid rounded mb-3" />
                </div>
                <div class="col-lg-6">
                <h3 class="mb-4">$SubTitle</h3>
                <p class="text-muted mb-4">$Description</p>
                <button class="btn btn-primary btn-lg">MAKE AN APPOINTMENT</button>
                </div>
            </div>
            </div>
        <% end_loop %>
        </div>
    </div>
    </section>


    <!-- Packages Section -->
    <section class="py-5" id="Packages">
    <div class="container">
        <div class="text-center mb-5">
        <% if $SiteConfig.SectionPackagesT %>
        <h2 class="text-uppercase fw-bold">$SiteConfig.SectionPackagesT</h2>
        <% end_if %>
        <% if $SiteConfig.SectionPackagesD %>
        <p class="text-muted">$SiteConfig.SectionPackagesD</p>
        <% end_if %>
        </div>
        <div class="row">
        <% loop Packages %>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
            <img
                src="$Image.URL"
                alt="Package Image"
                class="card-img-top"
                style="height: 250px; object-fit: cover"
            />
            <div class="card-body text-center d-flex flex-column">
                <h5 class="card-title">$Title</h5>
                <p class="card-text text-muted flex-grow-1">$Description</p>
                <p class="fw-bold">$$Price</p>
            </div>
            </div>
        </div>
        <% end_loop %>
        </div>
    </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-5 bg-light" id="Gallery">
    <div class="container">
        <div class="text-center mb-5">
        <% if $SiteConfig.SectionGalleryT %>
        <h2 class="text-uppercase fw-bold">$SiteConfig.SectionGalleryT</h2>
        <% end_if %>
        <% if $SiteConfig.SectionGalleryD %>
        <p class="text-muted">$SiteConfig.SectionGalleryD</p>
        <% end_if %>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-3">
            <% loop Gallery %>
                <div class="col">
                    <img
                        src="$Image.URL"
                        alt="Gallery Image"
                        class="img-fluid rounded shadow-sm w-100"
                        style="height: 200px; object-fit: cover;"
                    />
                </div>
            <% end_loop %>
        </div>
        </div>
    </div>
    </section>

    <!-- Testimonial Section -->
    <section class="py-5" id="Testimonial">
    <div class="container">
        <div class="text-center mb-5">
        <% if $SiteConfig.SectionTestimonialT %>
        <h2 class="text-uppercase fw-bold">$SiteConfig.SectionTestimonialT</h2>
        <% end_if %>
        <% if $SiteConfig.SectionTestimonialD %>
        <p class="text-muted">$SiteConfig.SectionTestimonialD</p>
        <% end_if %>
        </div>

        <div class="row">
        <% loop $Testimonial %>
        <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
        <div class="card-body text-center p-4">
            <img
            src="$image.URL"
            alt="Client Photo"
            class="rounded-circle mb-3"
            width="80"
            height="80"
            style="object-fit: cover"
            />
            <h5 class="fw-bold mb-2">$ClientName</h5>
            <p class="text-muted small mb-3">$Proffesion</p>
            <p class="text-muted">$Description</p>
        </div>
        </div>
        </div>
        <% end_loop %>

        </div>
    </div>
    </section>

    <!-- Contact Section -->
    <section class="py-5 bg-light" id="Contact">
    <div class="container">
        <div class="text-center mb-5">
        <% if $SiteConfig.SectionContactT %>
        <h2 class="text-uppercase fw-bold">$SiteConfig.SectionContactT</h2>
        <% end_if %>
        <% if $SiteConfig.SectionContactD %>    
        <p class="text-muted">$SiteConfig.SectionContactD</p>
        <% end_if %>
        </div>

        <div class="row">
        <!-- Contact Form - Left Side -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">Send us a Message</h4>
                    $ContactForm
                </div>
            </div>
        </div>
        <!-- Contact Information - Right Side (2x2 Grid) -->
        <div class="col-lg-6 mb-4">
            <div class="row h-100">
            <div class="col-6 mb-3">
                <div class="card border-0 shadow-sm h-100">
                <div
                    class="card-body text-center p-4 d-flex flex-column justify-content-center"
                >
                    <div class="mb-3">
                    <img
                        src="$resourceURL('themes/mytheme/images/location.png')"
                        alt="location"
                        width="50"
                        height="50"
                    />
                    </div>
                    <h6 class="fw-bold">Contact Address</h6>
                    <% if  $SiteConfig.Address %>
                    <p class="text-muted small mb-0">$SiteConfig.Address</p>    
                    <% end_if %>
                </div>
                </div>
            </div>
            <div class="col-6 mb-3">
                <div class="card border-0 shadow-sm h-100">
                <div
                    class="card-body text-center p-4 d-flex flex-column justify-content-center"
                >
                    <div class="mb-3">
                    <img
                        src="$resourceURL('themes/mytheme/images/iphone.png')"
                        alt="iphone"
                        width="50"
                        height="50"
                    />
                    </div>
                    <h6 class="fw-bold">Call Us Today!</h6>
                    <% if $SiteConfig.Phone %>
                    <p class="text-muted small mb-0">$SiteConfig.Phone</p>    
                    <% end_if %>
                </div>
                </div>
            </div>
            <div class="col-6 mb-3">
                <div class="card border-0 shadow-sm h-100">
                <div
                    class="card-body text-center p-4 d-flex flex-column justify-content-center"
                >
                    <div class="mb-3">
                    <img
                        src="$resourceURL('themes/mytheme/images/mail.png')"
                        alt="mail"
                        width="50"
                        height="50"
                    />
                    </div>
                    <h6 class="fw-bold">Email</h6>
                    <% if $SiteConfig.Email %>
                    <p class="text-muted small mb-0">$SiteConfig.Email</p>    
                    <% end_if %>
                </div>
                </div>
            </div>
            <div class="col-6 mb-3">
                <div class="card border-0 shadow-sm h-100">
                <div
                    class="card-body text-center p-4 d-flex flex-column justify-content-center"
                >
                    <div class="mb-3">
                    <img
                        src="$resourceURL('themes/mytheme/images/clock.png')"
                        alt="clock"
                        width="50"
                        height="50"
                    />
                    </div>
                    <h6 class="fw-bold">Working Hours</h6>
                    <% if $SiteConfig.WorkTime %>
                    <p class="text-muted small mb-0">$SiteConfig.WorkTime</p>    
                    <% end_if %>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </section>
</main>