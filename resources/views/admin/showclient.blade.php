<x-layout active="Clients">
    @if (session()->has('success'))
        <div>{{ session('success') }}</div>
    @endif
    <div>
        <x-user-item status="{{ $client->status }}" fullName="{{ $client->full_name }}"
            phone="{{ $client->phone }}" email="{{ $client->user->email }}"
            address="{{ $client->address }}" companyName="{{ $client->company_name }}"
            notes="{{ $client->notes }}" userId="{{ $client->user->id }}">
        </x-user-item>
    </div>
</x-layout>
