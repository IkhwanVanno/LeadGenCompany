<% if PaginatedList.MoreThanOnePage %>
<nav aria-label="Navigasi halaman" class="mt-4">
    <ul class="pagination justify-content-center">

        <!-- Previous Page Link -->
        <% if PaginatedList.NotFirstPage %>
            <li class="page-item">
                <a class="page-link" href="$PaginatedList.PrevLink{$Top.PaginationParams}" aria-label="Sebelumnya">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <% else %>
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">&laquo;</span>
            </li>
        <% end_if %>

        <!-- Page Numbers -->
        <% loop PaginatedList.PaginationSummary %>
            <% if CurrentBool %>
                <li class="page-item active">
                    <span class="page-link">$PageNum</span>
                </li>
            <% else_if Link %>
                <li class="page-item">
                    <a class="page-link" href="$Link{$Top.PaginationParams}">$PageNum</a>
                </li>
            <% else %>
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
            <% end_if %>
        <% end_loop %>

        <!-- Next Page Link -->
        <% if PaginatedList.NotLastPage %>
            <li class="page-item">
                <a class="page-link" href="$PaginatedList.NextLink{$Top.PaginationParams}" aria-label="Berikutnya">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <% else %>
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">&raquo;</span>
            </li>
        <% end_if %>

    </ul>
    
    <!-- Pagination Info -->
    <div class="text-center mt-2">
        <small class="text-muted">
            Halaman $PaginatedList.CurrentPage dari $PaginatedList.TotalPages 
            ($PaginatedList.TotalItems total item)
        </small>
    </div>
</nav>
<% end_if %>