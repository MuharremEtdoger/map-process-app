@include('glob.header')
    <div class="container top-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Konum Listesi
                        <a href="{{ url('/') }}" type="button" class="btn btn-primary btn-sm navigation-buttons"><i class="bi bi-arrow-return-left"></i>Anasayfa</a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                        <thead>
                            <tr>
                                <th>Sıra</th>
                                <th>Konum Adı</th>
                                <th>Enlem</th>
                                <th>Boylam</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <thead>
                        <tbody>
                            @if(isset($locations))
                                @php
                                    $sayac=0; 
                                @endphp   
                                @foreach($locations as $location)
                                    @php
                                        $sayac++; 
                                    @endphp                             
                                    <tr>
                                        <td>{{ $sayac }}</td>
                                        <td>{{ $location->name }}</td>
                                        <td>{{ $location->latitude }}</td>
                                        <td>{{ $location->longitude }}</td>
                                        <td>
                                            <a href="{{ url('/update-location/'.$location->id) }}" class="btn btn-info btn-sm"><i class="bi bi-pencil-square"></i></a>
                                            <a href="{{ url('/location/'.$location->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></a>
                                        </td>
                                    </tr> 
                                @endforeach
                            @endif
                        <tbody>  
                    </table> 
                    {{ $locations->links() }}
                    <input type='hidden' name='locations_data' value="{{ json_encode($locations) }}">
                    <div id="maps-show-area"></div> 
                    </div>    
                </div>              
            </div>
        </div>
    </div>
@include('glob.footer')