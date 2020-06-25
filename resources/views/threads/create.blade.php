@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <h1 class="is-size-5 has-text-weight-bold pb-2">Start new discussion</h1>
    <form method="POST" action="/threads" enctype="multipart/form-data">
        @csrf
        <div class="field is-grouped">
            <div class="control is-expanded">
                <label class="label">Title</label>
                <div class="control">
                    <input class="input is-small @error('title') is-danger @enderror"
                            value="{{ old('title') }}"
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
                                <option value="{{ $channel->id }}">
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
                        type="text"
                        name="content"
                        autocomplete="content"
                        autofocus>{{ old('content') }}</textarea>
                @error('content')
                    <span class="help is-danger"> {{ $message }} </span>
                @enderror
            </div>
        </div>
        <button type="submit" class="button is-primary is-small">Post</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'content' );
</script>
@endsection
