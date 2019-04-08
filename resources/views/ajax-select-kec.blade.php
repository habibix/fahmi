<option>--- Kecamatan ---</option>
@if(!empty($states))
  @foreach($states as $state)
    <option value="{{ $state->kode }}">{{ $state->nama }}</option>
  @endforeach
@endif