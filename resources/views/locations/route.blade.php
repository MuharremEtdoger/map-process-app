@php
    $latitude=old('latitude');
    $longitude=old('longitude');
    if(isset($post_datas)){
        $latitude=$post_datas['latitude'];
        $longitude=$post_datas['longitude'];
    }
@endphp
@include('glob.header')
<div class="container top-container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Rota Oluştur
                </div>
                <div class="card-body">
                    <div class="alert alert-info" role="alert">
                        {{ $location->name }} İle Rota Oluşturmak İçin Enlem ve Boylam Değerlerini Girin
                    </div> 
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif                    
                    <form action="{{ Request::url() }}" class="create-route-form" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="location_latitude" class="form-label">Enlem</label>
                                    <input type="text" value="{{ $latitude }}" name="latitude" id="location_latitude" class="form-control" placeholder="Enlem" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="location_longitude" class="form-label">Boylam</label>
                                    <input type="text" value="{{ $longitude }}" name="longitude" id="location_longitude" class="form-control" placeholder="Boylam"  required>
                                </div>
                            </div> 
                            <div class="col-md-4"> 
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="form-control btn btn-info">ROTA OLUŞTUR</button>
                            </div>                          
                        </div>
                    </form> 
                    @if(isset($post_datas))
                        <div class="create-route-maps" 
                            data-source-latitude="{{ $location->latitude }}" 
                            data-source-longitude="{{ $location->longitude }}" 
                            data-target-latitude="{{ $post_datas['latitude'] }}" 
                            data-target-longitude="{{ $post_datas['longitude'] }}" 
                        ></div>
                    @endif              
                </div>
            </div>
        </div>
    </div>
</div>  
@include('glob.footer')