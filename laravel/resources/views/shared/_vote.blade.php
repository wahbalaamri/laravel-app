@if ($model instanceof App\Question)
@php
$name = 'question';
$firstURLSegment = 'questions';
@endphp
@elseif($model instanceof App\Answer)
@php
$name = 'answer';
$firstURLSegment = 'answers';
@endphp
@endif
<div class="d-flex flex-column vote-controls">
    <a href="" title="This {{ $name }} Is Useful" class="vote-up {{ Auth::guest() ? 'off' : '' }}"
        onclick="event.preventDefault(); document.getElementById('up-vote-{{ $name }}-{{ $model->id }}').submit();">

        <i class="fas fa-caret-up fa-3x"></i>
    </a>
    <form id="up-vote-{{ $name }}-{{ $model->id }}" action="/{{ $firstURLSegment }}/{{ $model->id }}/vote" method="POST"
        style="display: none">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>
    <span class="votes-count">{{ $model->votes_count }}</span>
    <a href="" title="This {{ $name }} is not Useful" class="vote-down {{ Auth::guest() ? 'off' : '' }}"
        onclick="event.preventDefault(); document.getElementById('down-vote-{{ $name }}-{{ $model->id }}').submit();">

        <i class="fas fa-caret-down fa-3x"></i>
    </a>
    <form id="down-vote-{{ $name }}-{{ $model->id }}" action="/{{ $firstURLSegment }}/{{ $model->id }}/vote"
        method="POST" style="display: none">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>
    @if ($model instanceof App\Question)
    <favorite :question="{{$model}}"></favorite>

    @endif
    @if ($model instanceof App\Answer)
    @include('shared._accept',[
    'model'=>$model,])
    @endif
</div>