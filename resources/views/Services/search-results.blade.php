@if($articles->count())
    <ul class="live-search-list">
        @foreach($articles as $article)
            <li>
                <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
            </li>
        @endforeach
    </ul>
@else
    <p style="color: #ccc; padding: 10px;">No results found.</p>
@endif
