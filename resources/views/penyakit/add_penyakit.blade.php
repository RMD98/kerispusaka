@extends('layouts.template')
@section('content')
<div class="bg-white w-full shadow rounded-2xl p-4">
    {{-- Card Header --}}
    <div class="flex items-center justify-between mb-4">
        <div>

            <h3 class="text-xl font-semibold text-gray-800">Tambah Penanganan Penyakit</h3>
            <x-breadcrumb />

        </div>
    </div>

    {{-- Form --}}
    <div class="overflow-x-auto">
        <form action="" method="POST" class="flex-1 overflow-auto space-y-6" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="ticket" class="block text-sm font-medium text-gray-700">Ticket</label>
                <select id="ticket" name="ticket" class="w-full rounded-lg shadow-sm border border-gray-300">
                    <!-- Options loaded by AJAX -->
                </select>
            </div>
            <div>
                <label for="peternak" class="block text-sm font-medium text-gray-700">Peternak</label>
                <input type="text" name="peternak" id="peternak" required readonly
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="sapi" class="block text-sm font-medium text-gray-700">Id Sapi</label>
                <select id="sapi" name="sapi" class="w-full rounded-lg shadow-sm border border-gray-300">
                </select>
            </div>
            <div>
                <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" required
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal Penanganan</label>
                    <input type="datetime-local" name="tanggal" id="tanggal" required
                           class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 bg-gray-100 focus:ring-blue-500 focus:border-blue-500">
                </div>
            <div class="pt-4">
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition">
                    Save Penanganan Penyakit
                </button>
            </div>
        </form>
    </div>
</div>

@stop
<!-- Select2 CSS & JS -->

@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('#ticket').select2({
        placeholder: 'Cari Ticket...',
        minimumInputLength: 0,
        ajax: {
            url: '{{route('ticket.search')}}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                    jenis:'Penyakit',
                     // search input
                };
            },
            processResults: function (data) {
                return {
                    results: data.map(item => ({
                        id: item.id_ticket,
                        text: item.text,
                        peternak: item.id_peternak,
                        nama : item.nama,
                    })),
                };
            },
            cache: true
        },
    });
    $('#sapi').select2({
        placeholder: 'Cari Sapi...',
        minimumInputLength: 0,
        ajax: {
            url: '{{route('betina.search')}}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search input
                    peternak: $('#peternak').val() // get selected peternak
                };
            },
            processResults: function (data) {
                return {
                    results: data.map(item => ({
                        id: item.ear_tag,
                        text: item.text
                    }))
                };
            },
            cache: true
        },
    });
    $('#ticket').on('select2:select', function (e) {
        let d = e.params.data;

        $('#peternak').val(d.peternak);
        // $('#no_hp').val(d.no_hp);
        // $('#alamat').val(d.alamat);
    });

});
</script>

@endpush
