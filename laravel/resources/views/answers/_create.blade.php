<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>Your Answer</h3>
                </div>
                <hr>
                <form action="{{ route('questions.answers.store', $question->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="answer-body">Write Your Answer</label>
                        <textarea name="body" id="answer-body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" rows="7"></textarea>
                        @if ($errors->has('body'))
                            <div class="invalid-feedback">
                                    <strong>{{ $errors->first('body') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-outline-primary">Add Your Answer</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
