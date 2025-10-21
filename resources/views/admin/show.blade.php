<x-layout active="Home">
    <h1 class="text-3xl">Dashboard</h1>
    <h2>Here's what's happening in your acount today</h2>
    <x-user-item
        status="{{ $admin->status }}"
        fullName="{{ $admin->full_name }}"
        phone="{{ $admin->phone }}"
        email="{{ $admin->user->email }}"
        address="{{ $admin->address }}"
        companyName="{{ $admin->company_name }}"
        notes="{{ $admin->notes }}"
        userId="{{ $admin->user->id }}"
        userIdWithinRole="{{ $admin->id }}"
        role="admin"
        type="profile">
    </x-user-item>
</x-layout>
