<main>
    <!-- Blog Detail Content -->
    <div class="container">
        <!-- Back Navigation -->
        <div class="mb-3">
            <a href="$BaseHref/blog" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Blog
            </a>
        </div>

        <% if CurrentBlog %>
            <!-- Blog Content -->
            <article class="mb-5">
                <% if CurrentBlog.Image %>
                    <img
                        src="$CurrentBlog.Image.ScaleWidth(800).URL"
                        class="img-fluid rounded mb-3"
                        alt="$CurrentBlog.Title"
                        style="width: 100%; max-height: 400px; object-fit: cover;"
                    />
                <% else %>
                    <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3" style="width: 100%; height: 300px;">
                        <span class="text-muted">No Image Available</span>
                    </div>
                <% end_if %>
                
                <h1 class="mb-2">$CurrentBlog.Title</h1>
                
                <div class="text-muted mb-3">
                    <small>
                        <i class="fas fa-calendar-alt"></i> Dipublikasikan pada $CurrentBlog.Date.Nice
                        <% if CurrentBlog.KategoriBlog %>
                            | <i class="fas fa-tag"></i> Kategori: $CurrentBlog.KategoriBlog.Kategori
                        <% end_if %>
                    </small>
                </div>
                
                <div class="blog-content">
                    <p>$CurrentBlog.Description</p>
                </div>
            </article>

            <!-- Comments Section -->
            <section class="mb-5">
                <h4 class="mb-4">
                    Komentar 
                    <% if Comments %>
                        <span class="badge bg-secondary">$Comments.Count</span>
                    <% end_if %>
                </h4>

                <!-- Display existing comments -->
                <% if Comments %>
                    <div class="comments-list mb-4">
                        <% loop Comments %>
                            <div class="border rounded p-3 mb-3 comment-item">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <strong class="comment-author">$Name</strong>
                                    <small class="text-muted">$CreatedNice</small>
                                </div>
                                <p class="comment-text mb-0">$Comment</p>
                            </div>
                        <% end_loop %>
                    </div>
                <% else %>
                    <div class="alert alert-info mb-4">
                        <p class="mb-0">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                    </div>
                <% end_if %>

                <!-- Comment Form -->
                <div class="comment-form-section">
                    <h5 class="mb-3">Tinggalkan Komentar</h5>
                    
                    <!-- Display form messages -->
                    <% if Message %>
                        <div class="alert alert-$MessageType">
                            $Message
                        </div>
                    <% end_if %>

                    $CommentForm
                </div>
            </section>
        <% else %>
            <div class="alert alert-danger">
                <h5>Blog Tidak Ditemukan</h5>
                <p>Maaf, blog yang Anda cari tidak dapat ditemukan.</p>
                <a href="$BaseHref/blog" class="btn btn-primary">Kembali ke Daftar Blog</a>
            </div>
        <% end_if %>
    </div>

    <style>
        .comment-item {
            transition: all 0.3s ease;
        }
        .comment-item:hover {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .comment-author {
            color: #007bff;
        }
        .comment-text {
            line-height: 1.6;
        }
        .blog-content {
            line-height: 1.8;
            font-size: 1.1rem;
        }
        .comment-form-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
        }
    </style>
</main>