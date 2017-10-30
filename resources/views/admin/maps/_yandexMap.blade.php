@if(Request::url() == route('clubs.create') || (isset($club) && Request::url() == route('clubs.edit', $club->slug)) ||
	Request::url() == route('treners.create') || (isset($trener) && Request::url() == route('treners.edit', $trener->slug)))
	<script src="{{ asset('libs/js/jquery.min.js') }}"></script>
@endif

<div class="checkbox hidden">
    <label class="control control--checkbox">
        <input id="move_map" type="checkbox" name="" value="1" checked>Отображать на карте при вводе
	    <div class="control__indicator"></div>
    </label>
</div>
@InputBlock([$type = "input", $item = 'searchAddress', $label = null, $var = null, $p = "class=\"form-group b-map-search\" placeholder=\"Введите адрес для поиска по карте\""])
<div id="ymaps-map" style="width: 96%;height: 300px;overflow: hidden;"></div>

<script>
    $(function () {
        ymaps.ready(initYmaps);

        function initYmaps() {
            myMap = new ymaps.Map("ymaps-map", {
                @if(Request::old('lat_lng'))
                    center: [{{ Request::old('lat_lng') }}],
                @elseif(isset($instance) && $instance->lat_lng)
                    center: [{{ $instance->lat_lng }}],
                @elseif($defaultCity)
                    center: [{{ $defaultCity->lat_lng }}],
                @else
                    center: [42.875989, 74.603674],
                @endif
                zoom: '<?= Request::segment(1) == 'admin_panel' && Request::segment(2) == 'cities' ? 10 : 17 ?>'
            });
//            myMap.behaviors.disable('scrollZoom');
            myMap.controls.remove('typeSelector');
            myMap.controls.remove('trafficControl');
            myMap.controls.remove('searchControl');
            myMap.controls.remove('scaleLine');
            myMap.controls.remove('geolocationControl');
            myMap.controls.remove('rulerControl');
            myMap.controls.remove('fullscreenControl');

            myPlacemark = new ymaps.Placemark (
                    @if(Request::old('lat_lng'))
                        [{{ Request::old('lat_lng') }}],
                    @elseif(isset($instance) && $instance->lat_lng)
                        [{{ $instance->lat_lng }}],
                    @elseif($defaultCity)
                        [{{ $defaultCity->lat_lng }}],
                    @else
                        [42.875989, 74.603674],
                    @endif
                    {
                        hintContent: 'Передвиньте маркер на объект',
                        balloonContent: '{{ isset($instance) ? $instance->title : '' }}'
                    },
                    {
                        draggable: true,
                        preset: 'twirl#redIcon'
                    });

            myMap.geoObjects.add(myPlacemark);


            myPlacemark.events.add('dragend', function (e) {
                // Получение ссылки на объект, который был передвинут.
                var thisPlacemark = e.get('target');
                // Определение координат метки
                var coords = thisPlacemark.geometry.getCoordinates();
	            var corners = myMap.getBounds();
	            $('#lat_lng').val(coords);
	            $('#corners').val(corners);
                // и вывод их при щелчке на метке
//                thisPlacemark.properties.set('balloonContent', coords);
            });
//            myMap.events.add(['actiontickcomplete', 'actiontick'], function (e) {
//                var mapCenter = myMap.getCenter();
//                myPlacemark.geometry.setCoordinates(mapCenter);
//            });
        }

        $('input[name=address], input[name=searchAddress]').on('input', function (e) {
            var self = $(this);
	        findOnMap(self.val());
        });
    });
</script>