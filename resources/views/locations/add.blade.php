@include('glob.header')
    <div class="container top-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Konum Ekle
                        <a href="{{ url('/') }}" type="button" class="btn btn-primary btn-sm navigation-buttons"><i class="bi bi-arrow-return-left"></i>Anasayfa</a>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger" role="alert">
                                @foreach($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif
                        @include('locations.form')
                    </div>
                </div>                
            </div>
        </div>
    </div>
@include('glob.footer')