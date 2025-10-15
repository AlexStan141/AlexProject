<x-layout>
    <x-header></x-header>
    <main class="flex flex-1">
        <x-navigation class="basis-1/5" active="Home"></x-navigation>
        <x-dashboard class="basis-4/5">
                <div class="flex justify-between items-end mb-4">
                    <div>
                        <h1 class="text-3xl">Dashboard</h1>
                        <h2>Here's what's happening in your acount today</h2>
                    </div>
                    <div>
                        <button class="bg-white py-1 px-2 rounded-md">Add Client</button>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="basis-2/3 bg-white h-[60vh] overflow-scroll rounded-md p-3">
                        <p class="font-bold mb-4">Active clients</p>
                        <x-client-list :$clients></x-client-list>
                    </div>
                    <div class="basis-1/3 bg-white h-[60vh] overflow-scroll rounded-md p-3">
                        <h1 class="text-xl font-bold">Filter</h1>
                        <form action="/" method="GET" class="flex flex-col items-start">
                            <x-text-input name="search" value="{{ request('search') }}" placeholder="Search"></x-text-input>
                            <button type="submit" class="mt-4 bg-blue-500 px-2 py-1 text-white rounded-md">Submit</button>
                        </form>
                    </div>
                </div>
        </x-dashboard>
    </main>
</x-layout>


