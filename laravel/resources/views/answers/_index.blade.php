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
                            <div class="d-flex flex-column vote-controls">
                                    <a href="" title="This Answer Is Useful" class="vote-up">
                                       <i class="fas fa-caret-up fa-3x"></i>
                                    </a>
                                    <span class="votes-count">1554</span>
                                    <a href="" title="This Answer is not Useful" class="vote-down off">
                                            <i class="fas fa-caret-down fa-3x"></i>
                                        </a>
                                        <a href="" title="Click To Accept" class="accept mt-2 vote-accepted">
                                                <i class="fas fa-check fa-2x"></i>

                                            </a>
                                </div>
                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="float-right">
                                <span class="text-muted">
                                    Answerd {{ $answer->created_date }}
                                </span>
                                <div class="media mt-3">
                                    <a href="{{ $answer->user->url }}" class="pr-2">
                                    <img src="{{ $answer->user->avater }}" alt="">
                                    </a>
                                    <div class="media-body mt-1">
                                        <a href="{{ $answer->user->url }}">
                                        {{ $answer->user->name }}
                                        </a>
                                    </div>
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
