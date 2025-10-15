<div>
    <table class="bg-slate-300">
        <thead>
            <tr>
                <th class="p-2 border-1">Client name</th>
                <th class="p-2 border-1">Email</th>
            </tr>
            @forelse($clients as $client)
                <tr>
                    <td class="p-2 text-center border-1">{{ $client->client_name }}</td>
                    <td class="p-2 text-center border-1">{{ $client->email }}</td>
                </tr>
            @empty
                <p>No clients registered yet.</p>
            @endforelse
        </thead>
    </table>
</div>
