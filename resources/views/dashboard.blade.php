@extends('layouts/template')
@section('content')
<div id="tableauViz"></div>
@stop
@push('script')
<script>
        // URL Tableau Public Anda
    const tableauUrl = "https://public.tableau.com/views/DinasKerisPusakaSakti/Dashboard1?:language=en-US&publish=yes&:sid=&:redirect=auth&:display_count=n&:origin=viz_share_link";

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