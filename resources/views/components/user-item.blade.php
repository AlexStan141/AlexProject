<div>
    <div class="rounded-md bg-white w-200 p-3 mt-4">
        <div class="font-bold flex gap-4 items-center">
            @if ($status === 'Active')
                <x-bi-circle-fill class="h-4 w-4 text-green-600" />
            @else
                <x-bi-circle-fill class="h-4 w-4 text-red-600" />
            @endif
            <h3>{{ $fullName }}</h3>
        </div>
        <div class="flex gap-4">
            <x-tag>
                <x-heroicon-o-phone class="h-4 w-4" />
                <a href="tel:{{ $phone }}">{{ $phone }}</a>
            </x-tag>
            <x-tag>
                <x-css-mail class="h-4 w-4" />
                <a href="mailto:{{ $email }}">{{ $email }}</a>
            </x-tag>
            <x-tag>
                <x-bi-house class="h-4 w-4" />
                <a href="https://www.google.com/maps?q={{ urlencode($address) }}"
                    target="_blank">{{ $address }}</a>
            </x-tag>
        </div>
        <p class="text-sm py-2"><b class="font-bold">Company: </b>{{ $companyName }}</p>
        <p class="text-xs text-slate-500 py-2">{{ $notes }}</p>
        <a href="/admin/clients/{{ $userId }}/edit">Edit</a>
    </div>
</div>
