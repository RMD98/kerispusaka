@extends('layouts.template')
@section('content')
<div class="bg-white w-full shadow rounded-2xl p-4">
    {{-- Card Header --}}
    
    <div class="">
        <div>
            <h3 class="text-xl font-semibold text-gray-800">Daftar Ticket</h3>
            <x-breadcrumb />
        </div>
        <div class="flex items-center justify-between mb-4">
            <div class="search-box">
                <input type="text" id="search" placeholder="Search..." class="border px-3 py-2 rounded">
                <select id="per-page">
                    <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                </select>  
            </div>
            <a href="{{route('ticket.create')}}"
                class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition">
                + Add Ticket
            </a>
            
        </div>  

        <div id="table-container" class="overflow-x-auto">
            @include('ticket.ticket_table', [
                'data' => $data,
                'sort' => $sort,
                'direction' => $direction
            ])
        </div>
        
    </div>
</div>
@stop
@push('script')
<script>
        const searchInput = document.getElementById('search');
        const perPageSelect = document.getElementById('per-page');
        const tableContainer = document.getElementById('table-container');
        let debounceTimeout = null;

        function loadTable(url) {
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                tableContainer.innerHTML = html;
            })
            .catch(error => console.error(error));
        }

        function applyCurrentFilters(url) {
            const currentSearch = searchInput.value.trim();
            const currentPerPage = perPageSelect.value;

            if (currentSearch !== '') {
                url.searchParams.set('search', currentSearch);
            } else {
                url.searchParams.delete('search');
            }

            url.searchParams.set('per_page', currentPerPage);

            return url;
        }

        // Live search
        searchInput.addEventListener('keyup', function () {
            clearTimeout(debounceTimeout);

            debounceTimeout = setTimeout(() => {
                const currentUrl = new URL(window.location.href);
                applyCurrentFilters(currentUrl);
                currentUrl.searchParams.set('page', 1);

                window.history.pushState({}, '', currentUrl);
                loadTable(currentUrl);
            }, 300);
        });

        // Change per page
        perPageSelect.addEventListener('change', function () {
            const currentUrl = new URL(window.location.href);
            applyCurrentFilters(currentUrl);
            currentUrl.searchParams.set('page', 1);

            window.history.pushState({}, '', currentUrl);
            loadTable(currentUrl);
        });

        // Sort + Pagination
        document.addEventListener('click', function (e) {
            const link = e.target.closest('a[data-table-link]');

            if (link) {
                e.preventDefault();

                const url = new URL(link.href);
                applyCurrentFilters(url);

                window.history.pushState({}, '', url);
                loadTable(url);
                return;
            }

            const editLink = e.target.closest('a[data-edit-link]');
            if (editLink) {
                sessionStorage.setItem('users_scroll_position', window.scrollY);
            }
        });

        // Browser back/forward
        window.addEventListener('popstate', function () {
            const currentUrl = new URL(window.location.href);

            searchInput.value = currentUrl.searchParams.get('search') || '';
            perPageSelect.value = currentUrl.searchParams.get('per_page') || '10';

            loadTable(currentUrl);
        });

        // Restore scroll
        window.addEventListener('load', function () {
            const url = new URL(window.location.href);
            const scroll = url.searchParams.get('scroll');

            if (scroll) {
                window.scrollTo({
                    top: parseInt(scroll),
                    behavior: 'smooth'
                });
                sessionStorage.removeItem('users_scroll_position');
            }
        });
    </script>
@endpush