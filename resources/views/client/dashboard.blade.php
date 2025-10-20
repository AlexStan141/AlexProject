<x-layout active="Home">
    <h1 class="text-3xl">Dashboard</h1>
    <h2>Here's what's happening in your acount today</h2>
    <x-user-item
        status="{{ auth()->user()->client->status }}"
        fullName="{{ auth()->user()->client->full_name }}"
        phone="{{ auth()->user()->client->phone }}"
        email="{{ auth()->user()->email }}"
        address="{{ auth()->user()->client->address }}"
        companyName="{{ auth()->user()->client->company_name }}"
        notes="{{ auth()->user()->client->notes }}">
    </x-user-item>
</x-layout>
