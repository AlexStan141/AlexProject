<x-layout active="Home">
    <div>
        <h1 class="text-3xl">Dashboard</h1>
        <h2>{{auth()->user()->admin->full_name}}</h2>
    </div>
</x-layout>
