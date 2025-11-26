@extends('layouts.template')
@section('content')
<div class="bg-white w-full shadow rounded-2xl p-4">
    {{-- Card Header --}}
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-semibold text-gray-800">User List</h3>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
    <form action="" method="POST" class="flex-1 overflow-auto space-y-6">
                @csrf

                <!-- <div>
                    <label for="id" class="block text-sm font-medium text-gray-700">Id</label>
                    <input type="text" name="id" id="id" required
                           class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div> -->

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" required
                           class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label for="asal" class="block text-sm font-medium text-gray-700">Asal</label>
                    <input type="text" name="asal" id="asal" required
                           class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <!-- <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="text" name="address" id="address" required
                           class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div> -->
                
                <div>
                    <label for="izin" class="block text-sm font-medium text-gray-700">Surat Izin</label>
                    <input type="text" name="izin" id="izin" required
                           class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" required
                           class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div> -->
    
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Telephone</label>
                    <input type="tel" name="phone" id="phone" required pattern="[0-9]{12}"
                           class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                    <select name="jabatan" id="jabatan" required
                           class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="dokter">Dokter</option>
                            <option value="petugas">Petugas</option>
                    </select>
                </div>

                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="username" name="username" id="username" required
                           class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" required 
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