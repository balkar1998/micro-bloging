@extends('layouts.app')

@section('content')

<style>
    .timeline {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.timeline li {
  position: relative;
  min-height: 50px;
}

.timeline li:after {
  content: "";
  position: absolute;
  left: 50%;
  bottom: 0;
  transform: translateX(-50%);
  width: 2px;
  height: 100%;
}

.timeline li:last-child:after {
  display: none;
}

.timeline-content {
  position: relative;
  margin-bottom: 20px;
  padding: 10px;
  background-color: #f2f2f2;
  border-radius: 8px;
}

.timeline-content .timeline-time {
  position: absolute;
  top: -18px;
  right: 0;
  font-size: 14px;
  color: #999;
}

.timeline-content .timeline-title {
  margin-top: 0;
  margin-bottom: 6px;
  font-weight: bold;
  font-size: 16px;
}

.timeline-content .timeline-title a {
  color: #1877f2;
  text-decoration: none;
}

.timeline-content .timeline-description {
  font-size: 14px;
  line-height: 20px;
  margin-bottom: 0;
}

.timeline-content .timeline-description a {
  color: #1877f2;
  text-decoration: none;
}

.timeline-media {
  margin-top: 10px;
      display: flex;
    justify-content: center;
}

.timeline-media img,
.timeline-media video {
  max-width: 50%;
  height: auto;
  border-radius: 5px;
}

.timeline-media video {
  width: 100%;
}

.timeline-media .timeline-media-action-list {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 10px;
}

.timeline-media .timeline-media-action-list li {
  display: flex;
  align-items: center;
}

.timeline-media .timeline-media-action-list li a {
  display: flex;
  align-items: center;
  color: #1877f2;
  text-decoration: none;
  margin-right: 10px;
}

.timeline-media .timeline-media-action-list li a svg {
  margin-right: 5px;
}

.timeline-media .timeline-media-action-list li a:hover {
  text-decoration: underline;
}

.timeline-media .timeline-media-action-list li:last-child a {
  margin-right: 0;
}

.timeline-media .timeline-media-action-list li:last-child a svg {
  margin-right: 0;
}

.timeline-media .timeline-media-action-list li:last-child a:hover {
  text-decoration: none;
}

.timeline-media .timeline-media-comment-list {
  margin-top: 10px;
}

.timeline-media .timeline-media-comment-list li {
  display: flex;
  margin-bottom: 10px;
}

.timeline-media .timeline-media-comment-list li:last-child {
  margin-bottom: 0;
}

</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @if ($messages->count() > 0)
            <ul class="timeline">
                @foreach ($messages as $message)
                <li>
                    <div class="timeline-content">
                        <div class="timeline-time">{{ $message->created_at->diffForHumans() }}</div>
                        
                        <p class="timeline-description">{{ $message->content }}</p>
                        @if ($message->media)
                        <div class="timeline-media">

                          <!-- check if its image then show image tag other wise video -->
                          @if (Str::contains($message->media, 'png') || Str::contains($message->media, 'jpg') || Str::contains($message->media, 'jpeg') || Str::contains($message->media, 'gif') || Str::contains($message->media, 'webp') || Str::contains($message->media, 'svg'))
                            <img src="{{ asset('storage/' . $message->media) }}" alt="">
                          @else
                            <video controls>
                              <source src="{{ asset('storage/' . $message->media) }}" type="video/mp4">
                            </video>
                          @endif
                        </div>
                        @endif
                    </div>
                </li>
                @endforeach
            </ul>
          @else
            <p style="display: flex;justify-content: center;">No post found</p>
          @endif
        </div>
    </div>
</div>
@endsection
