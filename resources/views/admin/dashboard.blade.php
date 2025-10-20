<x-layout active="Home">
    <h1 class="text-3xl">Dashboard</h1>
    <h2>Here's what's happening in your acount today</h2>
    <x-user-item
        status="{{ auth()->user()->admin->status }}"
        fullName="{{ auth()->user()->admin->full_name }}"
        phone="{{ auth()->user()->admin->phone }}"
        email="{{ auth()->user()->email }}"
        address="{{ auth()->user()->admin->address }}"
        companyName="{{ auth()->user()->admin->company_name }}"
        notes="{{ auth()->user()->admin->notes }}"
        userId="{{ auth()->user()->id }}">
    </x-user-item>
</x-layout>
