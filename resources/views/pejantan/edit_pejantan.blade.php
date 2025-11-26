@extends('layouts.template')
@section('content')
<div class="bg-white w-full shadow rounded-2xl p-4">
    {{-- Card Header --}}
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-semibold text-gray-800">List Pejantan</h3>
    </div>

    {{-- Form --}}
    <div class="overflow-x-auto">
        <form action="{{route('pejantan.update', $data->id_pejantan)}}" method="POST" class="flex-1 overflow-auto space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="pejantan" class="block text-sm font-medium text-gray-700">Id Pejantan</label>
                <input type="text" name="pejantan" id="pejantan" required value ="{{$data->id_pejantan}}"
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="pembuatan" class="block text-sm font-medium text-gray-700">Id Pembuatan</label>
                <input type="text" name="pembuatan" id="pembuatan" required value="{{$data->id_pembuatan}}"
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis Straw</label>
                <input type="text" name="jenis" id="jenis" required value="{{$data->jenis_straw}}"
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="asal" class="block text-sm font-medium text-gray-700">Asal Straw</label>
                <input type="text" name="asal" id="asal" required value="{{$data->asal_straw}}"
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="persentase" class="block text-sm font-medium text-gray-700">Persentase</label>
                <input type="number" name="persentase" id="persentase" required value="{{$data->persentase}}"
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="pt-4">
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition">
                    Save User
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
    $('#peternak').select2({
        placeholder: 'Cari peternak...',
        minimumInputLength: 0,
        ajax: {
            url: '/peternak/search',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term // search input
                };
            },
            processResults: function (data) {
                return {
                    results: data.map(item => ({
                        id: item.id_peternak,
                        text: item.text
                    }))
                };
            },
            cache: true
        },
    });
});
</script>

@endpush
