<nav class="space-y-2">
    <a href="{{route('staff.index')}}" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">Staff</a>
    <a href="{{route('kejadian.index')}}"
        @click.prevent="openUsers = !openUsers; window.location.href='{{route('kejadian.index')}}'"
        class="w-full flex items-center justify-between px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">
            Kejadian
            <svg :class="{ 'rotate-180': openUsers }" class="w-4 h-4 transform transition-transform" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
        </a>

    <div x-show="openUsers" x-collapse class="pl-6 mt-1 space-y-1">
       
        <a href="{{route('ib.index')}}" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">IB</a>
        <a href="{{route('pkb.index')}}" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">PKB</a>
        <a href="{{route('kelahiran.index')}}" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">Kebuntingan</a>
    </div>

    <a href="{{route('peternak.index')}}"
        @click.prevent="openUsers = !openUsers; window.location.href='{{route('peternak.index')}}'"
        class="w-full flex items-center justify-between px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">
            Peternak
            <svg :class="{ 'rotate-180': openUsers }" class="w-4 h-4 transform transition-transform" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
        </a>

    <div x-show="openUsers" x-collapse class="pl-6 mt-1 space-y-1">
        <a href="{{route('pejantan.index')}}" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">Sapi Pejantan</a>
        <a href="{{route('betina.index')}}" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">Sapi Betina</a>
    </div>
    <a href="{{route('user.index')}}" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">User</a>
</nav>