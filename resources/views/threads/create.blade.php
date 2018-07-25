@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a new Forum Threads</div>

                    <div class="card-body">
                        <form method="POST" action="/threads">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="channel_id">Choose a Channel: </label>
                                <select name="channel_id" id="channel_id" class="form_control" required>
                                    <option value="">Choose One...</option>
                                    @foreach(App\Channel::all() as $channel)
                                        <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : ''}}>
                                            {{ $channel->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input name="title" type="text" class="form-control" id="title" placeholder="Title" value="{{ old('title') }}" required />
                                @if($errors->has('title'))
                                    <span class="alert-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea name="body" id="body" cols="30" rows="10" placeholder="Body" required>{{old('body')}}</textarea>
                                @if($errors->has('body'))
                                    <span class="alert-danger">{{ $errors->first('body') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                            <div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (count($errors))
      <ul class="alert alter-danger">
      @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
      </ul>
    @endif
@endsection
