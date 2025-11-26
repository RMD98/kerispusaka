<nav class="space-y-2">
    
    <a href="/kejadian"
        @click.prevent="openUsers = !openUsers; window.location.href='/kejadian'"
        class="w-full flex items-center justify-between px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">
            Kejadian
            <svg :class="{ 'rotate-180': openUsers }" class="w-4 h-4 transform transition-transform" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
        </a>

    <div x-show="openUsers" x-collapse class="pl-6 mt-1 space-y-1">
        <!-- <a href=""
        class="block px-2 py-1 rounded hover:bg-blue-50 text-gray-600 text-sm">All Users</a>
        <a href=""
        class="block px-2 py-1 rounded hover:bg-blue-50 text-gray-600 text-sm">Create User</a> -->
        <a href="/ib" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">IB</a>
        <a href="/pkb" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">PKB</a>
        <a href="/kebuntingan" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">Kebuntingan</a>
    </div>

    <a href="/peternak"
        @click.prevent="openUsers = !openUsers; window.location.href='/peternak'"
        class="w-full flex items-center justify-between px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">
            Peternak
            <svg :class="{ 'rotate-180': openUsers }" class="w-4 h-4 transform transition-transform" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
        </a>

    <div x-show="openUsers" x-collapse class="pl-6 mt-1 space-y-1">
        <!-- <a href=""
        class="block px-2 py-1 rounded hover:bg-blue-50 text-gray-600 text-sm">All Users</a>
        <a href=""
        class="block px-2 py-1 rounded hover:bg-blue-50 text-gray-600 text-sm">Create User</a> -->
        <a href="/pejantan" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">Sapi Pejantan</a>
        <a href="/betina" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">Sapi Betina</a>
    </div>
</nav>