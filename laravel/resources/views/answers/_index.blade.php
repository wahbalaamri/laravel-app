@if ($answersCount>0)
    <div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount . " ". str_plural("Answer",$answersCount)}}</h2>
                </div>
                <hr>
                @include('layouts._messages')
                @foreach ($answers as $answer)
                <div class="media">
                    @include('shared._vote',[
                    'model'=> $answer,
                    ])

                <div class="media-body">
                    {!! $answer->body_html !!}
                    <div class="row">
                        <div class="col-4">
                            <div class="ml-auto">
                                {{-- @if (Auth::user()->can('update-question',$answer)) from lesson-12-a --}}
                                @can('update',$answer)
                                <a href="{{ route('questions.answers.edit', [$question->id,$answer->id]) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                {{-- @endif --}}
                                @endcan
                                {{-- @if (Auth::user()->can('update-question',$answer)) from lesson-12-a--}}
                                @can('delete',$answer)
                                <form action="{{ route('questions.answers.destroy',[$question->id,$answer->id]) }}" class="form-delete" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are You Sure You Want To Delete This Answer?')">Delete</button>
                                </form>
                                @endcan
                                {{-- @endif --}}

                            </div>
                        </div>
                        <div class="col-4"></div>
                        <div class="col-4">
                            @include('shared._author',[
                            'model' => $answer,
                            'label'=>'Answered'
                            ])
                        </div>
                    </div>

                </div>
            </div>
            <hr>
            @endforeach
        </div>
    </div>
</div>
</div>

@else
    
@endif
