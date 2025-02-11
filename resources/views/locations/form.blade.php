@php
    $latitude=old('latitude');
    $longitude=old('longitude');
    $name=old('name');
    $color=old('color');
    $btn='KAYDET';
@endphp

@if (isset($location))
    @php
        $latitude=$location->latitude;
        $longitude=$location->longitude;
        $name=$location->name;
        $color=$location->color;
        $btn='GÜNCELLE';
    @endphp           
@endif
<form action="{{ Request::url() }}" class="add-location-form" method="POST">
    @csrf
    <div class="form-group">
        <label for="location_latitude" class="form-label">Enlem</label>
        <input type="text" value="{{ $latitude }}" name="latitude" id="location_latitude" class="form-control" placeholder="Enlem" required>
    </div>
    <div class="form-group">
        <label for="location_longitude" class="form-label">Boylam</label>
        <input type="text" value="{{ $longitude }}" name="longitude" id="location_longitude" class="form-control" placeholder="Boylam"  required>
    </div>
    <div class="form-group">
        <label for="location_name" class="form-label">Konumun Adı</label>
        <input type="text" value="{{ $name }}" name="name" id="location_name" class="form-control" placeholder="Konumun Adı"  required>
    </div> 
    <div class="form-group">
        <label for="location_color" class="form-label">İkon Rengi</label>
        <input type="text" value="{{ $color }}"  name="color" id="location_color" class="form-control color-picker" placeholder="İkon Rengi" required>
    </div> 
    <div class="form-group">
        <button type="submit" class="btn btn-info">{{ $btn }}</button>
    </div>                                                                                                                   
</form>