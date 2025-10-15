<div {{ $attributes->class(['bg-slate-800 p-5']) }}>
    <nav>
        <ul>
            <li>
                @if($active === 'Home')
                    <a href="/" class="text-yellow-300">Home</a>
                @else
                    <a href="/" class="text-white">Home</a>
                @endif
            </li>
            <li>
                @if($active === 'Clients')
                    <a href="/clients" class="text-yellow-300">Clients</a>
                @else
                    <a href="/clients" class="text-white">Clients</a>
                @endif
            </li>
        </ul>
    </nav>
</div>
