<x-layout active="Clients">
    <div class="flex justify-between items-end mb-4">
        <div>
            <h1 class="text-3xl">Dashboard</h1>
            <h2>Here's what's happening in your acount today</h2>
        </div>
        <div>
            <button class="bg-white py-1 px-2 rounded-md">
                <a href="{{ route('admin.create') }}">Add Client</a>
            </button>
        </div>
    </div>
    <div class="flex gap-4">
        <x-client-list :$clients></x-client-list>
        <div class="basis-1/3 bg-white h-[60vh] overflow-scroll rounded-md p-3 mt-4">
            <h1 class="text-xl font-bold">Filter</h1>
            <form action="{{ route('admin.clients') }}" method="GET" class="flex flex-col items-start">
                <x-text-input name="search" value="{{ request('search') }}" placeholder="Search"></x-text-input>
                <p class="mt-4">Sort</p>
                <div class="flex gap-4">
                    <input type="radio" name="sort" value="" id="nosort" @checked(!request('sort'))>
                    <label for="nosort">No sort</label>
                </div>
                <div class="flex gap-4">
                    <input type="radio" name="sort" value="az" id="az" @checked(request('sort') === 'az')>
                    <label for="az">A-Z</label>
                </div>
                <div class="flex gap-4">
                    <input type="radio" name="sort" value="za" id="za" @checked(request('sort') === 'za')>
                    <label for="za">Z-A</label>
                </div>
                <button type="submit" class="mt-4 bg-blue-500 px-2 py-1 text-white rounded-md">Submit</button>
            </form>
        </div>
    </div>
</x-layout>
