<main>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="$Link">Portal Berita</a>
            <div class="collapse navbar-collapse">
                <form class="d-flex ms-auto" role="search" method="GET" action="$Link">
                    <input
                        class="form-control me-2"
                        type="search"
                        name="search"
                        value="$SearchQuery"
                        placeholder="Cari berita..."
                        aria-label="Search"
                    />
                    <input type="hidden" name="category" value="$SelectedCategory" />
                    <button class="btn btn-outline-primary" type="submit">
                        Cari
                    </button>
                </form>
                <form class="ms-3" method="GET" action="$Link">
                    <select class="form-select w-auto" name="category" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        <% loop KategoriBlog %>
                            <option value="$ID" <% if $ID == $Top.SelectedCategory %>selected<% end_if %>>$Kategori</option>
                        <% end_loop %>
                    </select>
                    <input type="hidden" name="search" value="$Top.SearchQuery" />
                </form>
            </div>
        </div>
    </nav>

    <!-- Search and Filter Info -->
    <div class="container">
        <% if SearchQuery || SelectedCategory %>
            <div class="alert alert-info">
                <% if SearchQuery %>
                    <strong>Pencarian:</strong> "$SearchQuery"
                <% end_if %>
                <% if SelectedCategory %>
                    <% loop KategoriBlog %>
                        <% if $ID == $Top.SelectedCategory %>
                            <% if $Top.SearchQuery %> | <% end_if %>
                            <strong>Kategori:</strong> $Kategori
                        <% end_if %>
                    <% end_loop %>
                <% end_if %>
                <a href="$Link" class="btn btn-sm btn-outline-secondary ms-2">Reset Filter</a>
            </div>
        <% end_if %>

        <!-- Blog Count -->
        <p class="text-muted mb-3">
            <% if Blog.TotalItems %>
                Menampilkan $Blog.Count dari $Blog.TotalItems berita
                <% if Blog.MoreThanOnePage %>
                    (Halaman $Blog.CurrentPage dari $Blog.TotalPages)
                <% end_if %>
            <% else %>
                Tidak ada berita ditemukan
            <% end_if %>
        </p>

        <!-- Daftar Berita -->
        <% if Blog %>
            <% loop Blog %>
                <div class="row mb-4 border-bottom pb-3 blog-item">
                    <!-- Thumbnail -->
                    <div class="col-md-3">
                        <% if Image %>
                            <img
                                src="$Image.ScaleWidth(300).URL"
                                class="img-fluid rounded"
                                alt="$Title"
                                style="width: 100%; height: 200px; object-fit: cover;"
                            />
                        <% else %>
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 100%; height: 200px;">
                                <span class="text-muted">No Image</span>
                            </div>
                        <% end_if %>
                    </div>
                    <!-- Detail Berita -->
                    <div class="col-md-9">
                        <h5 class="mb-2">
                            <a href="$BaseHref/blog/view/$ID" class="text-decoration-none text-dark blog-title">$Title</a>
                        </h5>
                        <small class="text-muted d-block">
                            <i class="fas fa-calendar-alt"></i> $Date.Nice
                        </small>
                        <% if KategoriBlog %>
                            <small class="text-secondary mb-2 d-block">
                                <i class="fas fa-tag"></i> Kategori: 
                                <a href="$BaseHref/blog?category=$KategoriBlog.ID" class="text-decoration-none text-primary">
                                    $KategoriBlog.Kategori
                                </a>
                            </small>
                        <% end_if %>
                        <% if CommentBlog %>
                            <small class="text-info mb-2 d-block">
                                <i class="fas fa-comments"></i> $CommentBlog.Count komentar
                            </small>
                        <% end_if %>
                        <p class="mb-2" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                            $Description
                        </p>
                        <a href="$BaseHref/blog/view/$ID" class="btn btn-sm btn-primary">Baca Selengkapnya</a>
                    </div>
                </div>
            <% end_loop %>

            <!-- Pagination -->
            <% include Pagination PaginatedList=$Blog %>
        <% else %>
            <div class="alert alert-warning">
                <h5>Tidak Ada Berita</h5>
                <p class="mb-0">Belum ada berita yang tersedia saat ini.</p>
            </div>
        <% end_if %>
    </div>

    <style>
        .blog-item {
            transition: all 0.3s ease;
        }
        .blog-item:hover {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px !important;
        }
        .blog-title:hover {
            color: #007bff !important;
        }
    </style>
</main>