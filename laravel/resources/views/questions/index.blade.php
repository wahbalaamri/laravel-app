@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Questions</h2>
                        <div class="ml-auto">
                            <a href="{{ route("questions.create") }}" class="btn btn-outline-secondary">Ask Question
                            </a>
                        </div>
                    </div>


                </div>
                <div class="card-body">
                    @include('layouts._messages')
                    @forelse($questions as $q)
                    <div class="media post">
                        <div class="d-flex flex-column counters">
                            <div class="vote">
                                <strong>{{ $q->votes_count }}</strong>
                                {{ str_plural('vote', $q->votes_count) }}
                            </div>
                            <div class="status {{ $q->status }}">
                                <strong>{{ $q->answers_count }}</strong>
                                {{ str_plural('answer', $q->answers_count) }}
                            </div>
                            <div class="view">
                                {{ $q->views ." ".str_plural('view', $q->views) }}
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="d-flex align-items-center">

                                <a href="{{ $q->url }}">
                                    <h3 class="mt-0">{{ $q->title}}
                                </a> </h3>

                                <div class="ml-auto">
                                    {{-- @if (Auth::user()->can('update-question',$q)) from lesson-12-a --}}
                                    @can('update',$q)
                                    <a href="{{ route('questions.edit', $q->id) }}"
                                        class="btn btn-sm btn-outline-info">Edit</a>
                                    {{-- @endif --}}
                                    @endcan
                                    {{-- @if (Auth::user()->can('update-question',$q)) from lesson-12-a--}}
                                    @can('delete',$q)
                                    <form action="{{ route('questions.destroy',$q->id) }}" class="form-delete"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Are You Sure You Want To Delete This Question?')">Delete</button>
                                    </form>
                                    @endcan
                                    {{-- @endif --}}

                                </div>
                            </div>

                            <p class="lead"> Asked by <a href="{{ $q->user->url }}">{{ $q->user->name }}</a>
                                <small class="text-muted">{{ $q->created_date }}</small>
                            </p>
                            <div class='excerpt'>
                                {{ $q->excerpt(300)}}
                            </div>
                        </div>
                    </div>
                    
                    @empty
                    <div class="alert alert-warning">
                        <strong>Sorry</strong> There is No Question Availabe.
                    </div>
                    @endforelse
                </div>
                <div class="">
                    {{$questions->links()}}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
