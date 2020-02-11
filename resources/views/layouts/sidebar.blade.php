<form>
  <div class="form-row">
    <div class="col-6">
      <input type="text" class="form-control" placeholder="Anything...">
    </div>
    <div class="col">
      <select class="custom-select">
		  <option selected>In</option>
		  <option value="1">One</option>
		  <option value="2">Two</option>
		  <option value="3">Three</option>
		</select>
    </div>
    <div class="col">
      <button type="submit" class="btn btn-lg btn-primary">Search</button>
    </div>
  </div>
</form>
<h5 class="page__header bg-dark mt-2">Advert</h5>
<div class="card">
	<div class="card-body"></div>
</div>
{{-- <h5 class="page__header bg-dark mt-2">Tags</h5>
<div class="card">
	<div class="card-body">
		@foreach($tags as $tag)
			<a href="" class="btn btn-danger mb-2">{{ $tag->name }}</a>
		@endforeach
	</div>
</div> --}}
<h5 class="page__header bg-dark mt-2">Recent</h5>
<div class="card">
	<div class="card-body">
		<nav class="mb-2">
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a 
					class="nav-item nav-link active" 
					id="nav-home-tab" 
					data-toggle="tab" 
					href="#nav-home" 
					role="tab" 
					aria-controls="nav-home" 
					aria-selected="true"><i class="fa fa-comment"></i> Forum
				</a>
				<a 
					class="nav-item nav-link" 
					id="nav-profile-tab" 
					data-toggle="tab" 
					href="#nav-profile" 
					role="tab" 
					aria-controls="nav-profile" 
					aria-selected="false"><i class="fa fa-music"></i> Songs
				</a>
				<a 
					class="nav-item nav-link" 
					id="nav-contact-tab" 
					data-toggle="tab" 
					href="#nav-contact" 
					role="tab" 
					aria-controls="nav-contact" 
					aria-selected="false"><i class="fa fa-video"></i> Vidoes
				</a>
			</div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				@forelse($latestPosts as $post)
				<div class="media mt-2">
					<img
						src="{{ $post->getThumbnail() }}"
						width="60px"
						class="img-thumbnail rounded mr-3"
					>
					<div class="media-body">
						<h6 class="mt-2">
							<a href="{{ route('posts.show', $post->id) }}" class="card-link">{{ $post->title }}</a>
						</h6>
						<span class="text-dark">
							<i class="fa fa-clock"></i> {{ $post->created_at->diffForHumans() }}
						</span>
					</div>
					<div></div>
				</div>
				@empty
					<div class="alert alert-danger" role="alert">
						Oops...
					</div>
				@endforelse
			</div>
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				@forelse($latestSongs as $song)
				<div class="media mt-2">
					<img
						src="{{ $song->thumbnail_url }}"
						width="60px"
						class="img-thumbnail rounded mr-3"
					>
					<div class="media-body">
						<h6 class="mt-2">
							<a href="{{ route('songs.show', $song->id) }}" class="card-link">{{ $song->title }}</a>
						</h6>
						<span class="text-dark">
							<i class="fa fa-clock"></i> {{ $song->created_at->diffForHumans() }}
						</span>
					</div>
					<div></div>
				</div>
				@empty
					<div class="alert alert-danger" role="alert">
						Oops... Nothing to show
					</div>
				@endforelse
			</div>

			<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
				@forelse($latestVideos as $video)
				<div class="media mt-2">
					<img
						src="{{ $video->thumbnail_url }}"
						width="60px"
						class="img-thumbnail rounded mr-3"
					>
					<div class="media-body">
						<h6 class="mt-2">
							<a href="{{ route('videos.show', $video->id) }}" class="card-link">{{ $video->title }}</a>
						</h6>
						<span class="text-dark">
							<i class="fa fa-clock"></i> {{ $post->created_at->diffForHumans() }}
						</span>
					</div>
					<div></div>
				</div>
				@empty
					<div class="alert alert-danger" role="alert">
						Oops... Nothing to show
					</div>
				@endforelse
			</div>
		</div>
	</div>
</div>