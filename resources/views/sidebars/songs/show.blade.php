<div class="card bd-rd-20">
	{{-- <div class="card-header">Relea</div> --}}
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
					aria-selected="true">Related
				</a>
				<a 
					class="nav-item nav-link" 
					id="nav-profile-tab" 
					data-toggle="tab" 
					href="#nav-profile" 
					role="tab" 
					aria-controls="nav-profile" 
					aria-selected="false">Recent
				</a>
				<a 
					class="nav-item nav-link" 
					id="nav-contact-tab" 
					data-toggle="tab" 
					href="#nav-contact" 
					role="tab" 
					aria-controls="nav-contact" 
					aria-selected="false">Trending
				</a>
			</div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				@forelse($related as $song)
				<div class="media mt-2">
					<img
						src="{{ $song->thumbnail_url }}"
						width="60px"
						class="img-thumbnail rounded mr-3"
					>
					<div class="media-body">
						<h6 class="mt-2">
							<a href="{{ $song->permalink }}" class="card-link">{{ $song->title }}</a>
						</h6>
						<span class="text-dark">
							<i class="fa fa-clock"></i> {{ $song->created_at->diffForHumans() }}
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
				@forelse($recent as $song)
				<div class="media mt-2">
					<img
						src="{{ $song->thumbnail_url }}"
						width="60px"
						class="img-thumbnail rounded mr-3"
					>
					<div class="media-body">
						<h6 class="mt-2">
							<a href="{{ $song->permalink }}" class="card-link">{{ $song->title }}</a>
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
				@forelse($related as $song)
				<div class="media mt-2">
					<img
						src="{{ $song->thumbnail_url }}"
						width="60px"
						class="img-thumbnail rounded mr-3"
					>
					<div class="media-body">
						<h6 class="mt-2">
							<a href="{{ $song->permalink }}" class="card-link">{{ $song->title }}</a>
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
		</div>
	</div>
</div>