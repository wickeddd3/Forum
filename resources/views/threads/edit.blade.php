@extends('layouts.app')

@section('title')
Forum | Edit Thread
@endsection

@section('content')
<div class="container mt-5 mb-5">
    <h1 class="is-size-5 has-text-weight-bold pb-2">Edit Thread</h1>
    <form method="POST" action="/threads/{{ $thread->channel->slug }}/{{ $thread->id }}/update" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="field is-grouped">
            <div class="control is-expanded">
                <label class="label">Title</label>
                <div class="control">
                    <input class="input is-small @error('title') is-danger @enderror"
                            value="{{ $thread->title }}"
                            type="text"
                            name="title"
                            autocomplete="title"
                            autofocus />
                    @error('title')
                        <span class="help is-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
            <div class="control">
                <label class="label">Channel</label>
                <div class="control">
                    <div class="select is-small @error('channel') is-danger @enderror">
                        <select name="channel">
                            @foreach($channels as $channel)
                                <option value="{{ $channel->id }}"
                                    @if($channel->id === $thread->channel_id)
                                        selected
                                    @endif
                                    >
                                    {{ $channel->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('channel')
                            <span class="help is-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="field">
            <label class="label">Content</label>
            <div class="control">
                <textarea class="input is-small @error('content') is-danger @enderror"
                        value="{{ old('content') }}"
                        type="text"
                        name="content"
                        autocomplete="content"
                        autofocus>{{ $thread->content }}</textarea>
                @error('content')
                    <span class="help is-danger"> {{ $message }} </span>
                @enderror
            </div>
        </div>
        <button type="submit" class="button is-primary is-small">Update</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'content' );
</script>
@endsection
