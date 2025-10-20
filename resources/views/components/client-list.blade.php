<div>
    @if (count($clients))
        @foreach ($clients as $client)
            {{-- <tr>
                <td class="p-2 text-center border-1">{{ $client->full_name }}</td>
                <td class="p-2 text-center border-1">{{ $client->user->email }}</td>
                <td class="p-2 text-center border-1">TO DO</td>
            </tr> --}}
            <x-user-item status="{{ $client->status }}" fullName="{{ $client->full_name }}"
                phone="{{ $client->phone }}" email="{{ $client->user->email }}"
                address="{{ $client->address }}" companyName="{{ $client->company_name }}"
                notes="{{ $client->notes }}" userId="{{ $client->user->id }}">
            </x-user-item>
        @endforeach
    @else
        <p>No clients to display</p>
    @endif
</div>
