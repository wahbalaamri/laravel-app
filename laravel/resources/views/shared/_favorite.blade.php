<a href="" title="Click To Favorite"
    onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $model->id }}').submit();"
    class="favorite mt-2 {{ Auth::guest() ? 'off' : ($model->is_favorited ? 'favorited' : '') }}">
    <i class="fas fa-star fa-2x"></i>
    <span class="favorites-count">{{ $model->favorites_count }}</span>
</a>

<form id="favorite-question-{{ $model->id }}" action="/questions/{{ $model->id }}/favorites" method="POST"
    style="display: none">
    @csrf
    @if ($model->is_favorited)
    @method('DELETE')
    @endif
</form>