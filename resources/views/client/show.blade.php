<x-layout active="Home">
    <h1 class="text-3xl">Dashboard</h1>
    <h2>Here's what's happening in your acount today</h2>
    <x-user-item
        status="{{ $client->status }}"
        fullName="{{ $client->full_name }}"
        phone="{{ $client->phone }}"
        email="{{ $client ->user->email }}"
        address="{{ $client->address }}"
        companyName="{{ $client->company_name }}"
        notes="{{ $client->notes }}"
        role="client"
        userId="{{ $client->user->id }}"
        userIdWithinRole="{{ $client->id }}">
    </x-user-item>
</x-layout>
