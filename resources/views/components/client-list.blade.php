<div>
    @if(count($clients))
        <table class="bg-slate-300">
            <thead>
                <tr>
                    <th class="p-2 border-1">Client name</th>
                    <th class="p-2 border-1">Email</th>
                    <th class="p-2 border-1">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td class="p-2 text-center border-1">{{ $client->full_name }}</td>
                        <td class="p-2 text-center border-1">{{ $client->user->email }}</td>
                        <td class="p-2 text-center border-1">TO DO</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No clients to display</p>
    @endif
</div>
