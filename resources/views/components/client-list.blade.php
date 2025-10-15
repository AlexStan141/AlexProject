<div>
    @forelse($clients as $client)
        <p>{{ $client->name }}</p>
    @empty
        <p>No clients registered yet.</p>
    @endforelse
</div>
