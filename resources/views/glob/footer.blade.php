    <script src="/assets/js/jquery-3.7.1.min.js"></script>
    @if(isset($pageAssets['js']))
        @foreach ($pageAssets['js'] as $_js)
            <script src="{{ $_js }}"></script>
        @endforeach
    @endif    
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/map.js"></script>
</body>
</html>