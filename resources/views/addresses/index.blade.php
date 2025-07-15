<h1>Adresses de {{ $user->name }}</h1>

<ul>
    @foreach ($user->addresses as $address)
        <li>
            {{ $address->street }}, {{ $address->city }}, {{ $address->postal_code }}, {{ $address->country }}
        </li>
    @endforeach
</ul>