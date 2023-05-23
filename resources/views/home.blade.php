@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.2/dist/css/bootstrap.min.css">

<style>

.publish-post {
  background-color: #f5f5f5;
  padding: 10px;
  border-radius: 8px;
}

.user-profile {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.user-profile img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  margin-right: 10px;
}

.user-name {
  font-weight: bold;
}

.post-content textarea {
  width: 100%;
  resize: none;
  border: none;
  padding: 10px;
  margin-bottom: 10px;
  border-radius: 5px;
}

.post-actions {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.media-upload input[type="file"] {
  display: none;
}

.media-upload label {
  cursor: pointer;
}

.btn-post {
  background-color: #1877f2;
  color: white;
  border: none;
  padding: 8px 16px;
  border-radius: 5px;
  font-weight: bold;
}


.error {
  color: red;
  font-size: 14px;
  margin-top: 5px;
}


</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Publish your new post</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="publish-post">
                        <div class="user-profile">
                            <img src="https://fastly.picsum.photos/id/129/40/40.jpg?hmac=wdHtmAyIeCTG6vcHkZUtzertqiUpeQ_sTjQainDp7TE" alt="User Avatar">
                            <!-- login user name -->
                            <span class="user-name">{{ Auth::user()->name }}</span>
                        </div>
                        <div class="post-content">
                            <form method="POST" action="{{ route('messages.store') }}" enctype="multipart/form-data">
                            @csrf
                            <textarea name="content" rows="3" placeholder="What's on your mind?">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <div class="post-actions">
                                <div class="media-upload">
                                    <input type="file" name="media" id="media-upload" accept="image/*, video/*">
                                    @error('media')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                    <label for="media-upload"><img src="{{ asset('image/add_media.png') }}" alt="Add Media" style="width: 35px;">Add media</label>
                                </div>
                                <button type="submit" class="btn-post">Post</button>
                            </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
