<answer :answer="{{ $answer }}" inline-template>
    <div class="media post">
        @include('shared._vote',[
        'model'=> $answer,
        ])

        <div class="media-body">
            <form v-if="editing" >
                <div class="form-group">
                    <textarea rows="10" v-model="body" class="form-control" required></textarea>
                </div>
                <button class="btn btn-primary" @click.prevent="update()" :disabled="isInvalid" id="name" name="name">Update</button>
                {{-- <button type="button" @click="editing = false">update</button> --}}
                <button class="btn btn-outline-secondary"  @click="cancel()" type="button" >Cancel</button>
            </form>
            <div v-else>
                {{-- {!! $answer->body_html !!} --}}
                <div v-html="bodyHtml"></div>
                <div class="row">
                    <div class="col-4">
                        <div class="ml-auto">
                            {{-- @if (Auth::user()->can('update-question',$answer)) from lesson-12-a --}}
                            @can('update',$answer)
                            <a @click.prevent="edit()" class="btn btn-sm btn-outline-info">Edit</a>
                            {{-- @endif --}}
                            @endcan
                            {{-- @if (Auth::user()->can('update-question',$answer)) from lesson-12-a--}}
                            @can('delete',$answer)
                            <button @click="destroy" class="btn btn-sm btn-outline-danger">Delete</button>
                           
                            @endcan
                            {{-- @endif --}}

                        </div>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4">
                        <user-info :model="{{$answer}}" label="Answered">
                    </div>
                </div>
            </div>

        </div>
    </div>
</answer>