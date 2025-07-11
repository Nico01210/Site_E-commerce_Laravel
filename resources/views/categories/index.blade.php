<h1>Liste des catégories</h1>

<ul>
    @foreach ($categories as $category)
        <li>
            <strong>{{ $category->name }}</strong><br>
            {{ $category->description }}
        </li>
    @endforeach
</ul>