<x-layout active="Create">
    <div class="flex flex-col gap-4">
        <div>
            <h1 class="text-3xl">Add a client</h1>
        </div>
        <form action="{{ route('client.store') }}" method="POST" class="flex flex-col gap-2 items-start w-full">
            @csrf

            <div>
                <x-input-label for="full_name" value="Full Name"></x-input-label>
                <x-text-input type="text" name="full_name" placeholder="Stan Alexandru" value=""
                    required="{{ true }}" id="full_name" class="w-200"></x-text-input>
                @error('full_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input-label for="email" value="Email"></x-input-label>
                <x-text-input type="email" name="user[email]" placeholder="email@example.com" value=""
                    required="{{ true }}" id="email" class="w-200"></x-text-input>
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input-label for="password" value="Password"></x-input-label>
                <x-text-input type="password" name="user[password]" placeholder="password" value=""
                    required="{{ true }}" id="password" class="w-200"></x-text-input>
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input-label for="phone" value="Phone"></x-input-label>
                <x-text-input type="tel" name="phone" placeholder="0766132455" value=""
                    pattern="^07[0-9]{8}$" id="phone" class="w-200"></x-text-input>
                @error('phone')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input-label for="company_name" value="Company Name"></x-input-label>
                <x-text-input type="text" name="company_name" placeholder="LUCY SRL." value=""
                    id="company_name" class="w-200"></x-text-input>
                @error('company_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input-label for="address" value="Address"></x-input-label>
                <x-text-area name="address" placeholder="Burlington Street nr.89" value=""
                    id="address" class="w-200"></x-text-area>
                @error('address')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input-label for="status" value="Status" />
                <x-dropdown align="left">
                    <x-slot name="trigger">
                        <button type="button" class="w-full text-left px-4 py-2 border rounded bg-gray-100"
                            id="display-status">
                            {{ $status ?? 'Select a status' }}
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <ul class="text-sm">
                            @foreach (['active' => 'Active', 'inactive' => 'Inactive'] as $key => $label)
                                <li>
                                    <button type="button"
                                        @click="
                                        document.getElementById('status').value = '{{ $key }}';
                                        document.getElementById('display-status').innerHTML = '{{ ucfirst($key) }}'
                                        $dispatch('close')
                                    "
                                        class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                                        {{ $label }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </x-slot>
                </x-dropdown>
                <input type="hidden" name="status" id="status" value="{{ old('status') }}">
                @error('status')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-input-label for="notes" value="Notes" />
                <x-text-area name="notes" placeholder="Something about yourself..." value=""
                    id="notes" class="w-200"></x-text-area>
                @error('notes')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>


            <x-primary-button class="mt-4">Submit</x-primary-button>

        </form>
    </div>
</x-layout>
