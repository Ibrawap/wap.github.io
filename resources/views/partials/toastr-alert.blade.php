@foreach(['info', 'error', 'success', 'warning'] as $type)
  @if(session()->has($type))
    <script>
      window.addEventListener('DOMContentLoaded', ()=> {
        Toastr.{{ $type }}("{{ ucwords(session()->get($type)) }}")
      })
    </script>
  @endif
@endforeach