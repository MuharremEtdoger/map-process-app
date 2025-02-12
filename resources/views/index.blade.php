@include('glob.header') 
<div class="container top-container">
    <div class="row">
        <div class="col-md-4">
            <a href="{{ url('/add-location') }}" class="card bg-info text-white text-center p-3 map-process-card">
                <blockquote class="blockquote mb-0">
                    <i class="bi bi-plus-square"></i>
                    <p>Konum eklemek için tıklayın</p>
                    <footer class="blockquote-footer">
                        <small>
                        Konum Ekleme Uç Noktası
                        </small>
                    </footer>
                </blockquote>
            </a>            
        </div>
        <div class="col-md-4">
            <a href="{{ url('/locations') }}"  class="card bg-warning text-white text-center p-3 map-process-card">
                <blockquote class="blockquote mb-0">
                    <i class="bi bi-geo-alt"></i>
                    <p>Konumları görüntülemek için tıklayın</p>
                    <footer class="blockquote-footer">
                        <small>
                        Konum Listeleme Uç Noktası
                        </small>
                    </footer>
                </blockquote>
            </a>            
        </div>  
        <div class="col-md-4">
            <a class="card bg-success text-white text-center p-3 map-process-card">
                <blockquote class="blockquote mb-0">
                    <i class="bi bi-map"></i>
                    <p>Rotalama için tıklayın</p>
                    <footer class="blockquote-footer">
                        <small>
                        Rotalama Uç Noktası
                        </small>
                    </footer>
                </blockquote>
            </a>            
        </div>               
    </div>
</div>
@include('glob.footer') 