@foreach($categories as $category)
<a href="" style="text-decoration: none;">
	<div class="bg-white p-3 m-1 relative d-flex justify-content-between bd-rd-20">
		<span><i class="fas fa-folder" aria-hidden="true"></i> {{ $category->title }}</span>
		<i class="fas fa-angle-right" aria-hidden="true"></i>
	</div>
</a>
@endforeach