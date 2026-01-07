@extends('layouts.template')
@section('content')
<div class="bg-white w-full shadow rounded-2xl p-4">
    {{-- Card Header --}}
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-semibold text-gray-800">Add Pejantan</h3>
    </div>

    {{-- Form --}}
    <div class="overflow-x-auto">
        <form action="" method="POST" class="flex-1 overflow-auto space-y-6">
            @csrf

            <div>
                <label for="pejantan" class="block text-sm font-medium text-gray-700">Id Pejantan</label>
                <input type="text" name="pejantan" id="pejantan" required
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="pembuatan" class="block text-sm font-medium text-gray-700">Id Pembuatan</label>
                <input type="text" name="pembuatan" id="pembuatan" required
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis Straw</label>
                <input type="text" name="jenis" id="jenis" required
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="asal" class="block text-sm font-medium text-gray-700">Asal Straw</label>
                <input type="text" name="asal" id="asal" required
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="persentase" class="block text-sm font-medium text-gray-700">Persentase</label>
                <input type="number" name="persentase" id="persentase" required
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="pt-4">
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition">
                    Save Pejantan
                </button>
            </div>
        </form>
    </div>
</div>

@stop
<!-- Select2 CSS & JS -->

@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endpush
