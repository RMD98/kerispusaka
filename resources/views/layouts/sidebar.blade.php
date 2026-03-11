
    <h1 class="text-2xl font-semibold text-blue-600 ml-8"><a href="{{route('dashboard')}}">HOME</a></h1>

    <nav class="space-y-2">

        {!! menuItem('Ticket', '🎫', 'ticket') !!}
        {!! menuItem('Staff', '🧑‍💼', 'staff') !!}
        {!! menuItem('Kejadian', '📄', 'kejadian') !!}
        {!! menuItem('IB', '📌', 'ib') !!}
        {!! menuItem('PKB', '📌', 'pkb') !!}
        {!! menuItem('Kelahiran', '📌', 'kelahiran') !!} 
        {!! menuItem('Penyakit', '🦠', 'penyakit') !!}
        {!! menuItem('Peternak', '👥', 'peternak') !!}
        {!! menuItem('Sapi Betina', '🐄', 'betina') !!}
        {!! menuItem('Sapi Pejantan', '🐂', 'pejantan') !!}

    </nav>
@php
    function menuItem($label, $icon, $routeName)
    {
        $isActive = request()->routeIs($routeName . '*');

        $classes = $isActive
            ? 'text-blue-600 bg-blue-50 font-semibold border-l-4 border-blue-600'
            : 'text-gray-700 hover:text-blue-600 hover:bg-blue-50 border-l-4 border-transparent';

        $url = route($routeName . '.index'); // auto route fix

        return "
            <a href=\"{$url}\" class=\"flex items-center space-x-3 px-3 py-2 rounded-lg transition {$classes}\">
                <span>{$icon}</span>
                <span>{$label}</span>
            </a>
        ";
    }
@endphp
