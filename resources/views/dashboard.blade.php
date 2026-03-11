@extends('layouts/template')
@section('content')
<div style="width: 100%; height: 100%; margin-left: 15px" id="tableauViz">
    <iframe width="100%" height="100%" src="https://lookerstudio.google.com/embed/reporting/206ad222-5525-4d81-b87a-7a95a8e2d316/page/vxWmF" frameborder="0" style="border:0" allowfullscreen sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"></iframe>
</div>
@stop
@push('script')
<script>
        // URL Tableau Public Anda
    // const tableauUrl = "https://public.tableau.com/views/DinasKerisPusakaSakti/Dashboard1?:language=en-US&publish=yes&:sid=&:redirect=auth&:display_count=n&:origin=viz_share_link";

    // Elemen tempat Tableau akan dimuat
    const containerDiv = document.getElementById("tableauViz");

    // Fungsi untuk memuat Tableau
    function loadTableau() {
        const options = {
            width: '1400px', // Dinamis sesuai lebar layar
            height: window.innerHeight, // Dinamis sesuai tinggi layar
            hideTabs: true,
            hideToolbar: true
        };

        // Muat visualisasi Tableau
        new tableau.Viz(containerDiv, tableauUrl, options);
    }

    // Muat Tableau saat halaman dimuat
    loadTableau();

    // Tambahkan event listener untuk resize
    window.addEventListener("resize", () => {
        loadTableau();
    });
</script>
@endpush