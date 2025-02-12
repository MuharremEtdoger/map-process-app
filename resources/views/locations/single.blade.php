@include('glob.header')

<div class="container top-container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-geo-alt"></i> {{ $location->name }}
                    <a href="{{ url('/locations') }}" type="button" class="btn btn-primary btn-sm navigation-buttons"><i class="bi bi-arrow-return-left"></i>Konum Listesi</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>Konum Adı</strong></td>
                                <td>{{ $location->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Enlem</strong></td>
                                <td>{{ $location->latitude }}</td>
                            </tr>  
                            <tr>
                                <td><strong>Boylam</strong></td>
                                <td>{{ $location->longitude }}</td>
                            </tr>                                                        
                        </tbody>
                    </table>
                    <div id="map-show-area" data-latitude="{{ $location->latitude }}" data-longitude="{{ $location->longitude }}"></div>
                </div>    
            </div>            
        </div>
    </div>
</div>                

@include('glob.footer')