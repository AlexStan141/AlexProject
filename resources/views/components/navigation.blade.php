<div {{ $attributes->class(['bg-slate-800 p-5']) }}>
    <nav>
        <ul>
            <li>
                @if (auth()->user()->role === 'admin')
                    <a href="/admin/dashboard" class={{ $active === 'Home' ? 'text-yellow-300' : 'text-white' }}>Home</a>
                @else
                    <a href="/clients/dashboard" class={{ $active === 'Home' ? 'text-yellow-300' : 'text-white' }}>Home</a>
                @endif
            </li>
            @if (auth()->user()->role === 'admin')
                <li>
                    <a href="/admin/clients" class={{ $active === 'Clients' ? 'text-yellow-300' : 'text-white' }}>Clients</a>
                </li>
                <li>
                    <a href="/admin/clients/create"
                        class={{ $active === 'Create' ? 'text-yellow-300' : 'text-white' }}>Create</a>
                </li>
            @endif
        </ul>
    </nav>
</div>
