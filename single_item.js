$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


/*
 * Renders map on one club page
 * */
var single_map = $('#single-map'), map_lat, map_lng;
if (single_map.attr('data-map-lat')) {
    map_lat = single_map.attr('data-map-lat');
    map_lng = single_map.attr('data-map-lng');
} else {
    map_lat = 42.875989;
    map_lng = 74.603674;
}

if (single_map.length > 0) {

    ymaps.ready(function () {
        var myMap = new ymaps.Map("single-map", {
            center: [map_lat, map_lng],
            zoom: 17
        });
        myMap.controls.remove('typeSelector');
        myMap.controls.remove('trafficControl');
        myMap.controls.remove('searchControl');
        myMap.controls.remove('scaleLine');
        myMap.controls.remove('geolocationControl');
        myMap.controls.remove('rulerControl');
        myMap.controls.remove('fullscreenControl');

        var myPlacemark = new ymaps.Placemark(
            [map_lat, map_lng],
            {
                hintContent: 'Передвиньте маркер на объект',
                balloonContent: 'Название заведения',
            },
            {
                iconLayout: 'default#image',
                iconImageHref: '/img/markers/static.png'
            }
        );
        myMap.geoObjects.add(myPlacemark);
    });
}

$(function () {
    $('.open_stocks_modal').on('click', function (e) {
        e.preventDefault();
        var self = $(this);
        var modal = $('.stocks_modal');
        var modal_content = modal.find('.modal-body');
        $.post('/ajax/stocks/show', {id: self.data('id')}, function (data) {
            modal_content.html(data);
            modal.modal('show');
            modal_content.find('.modal-body').css({
                width:'auto', //probably not needed
                height:'auto', //probably not needed
                'max-height':'100%'
            });
            ymaps.ready(function () {
                var myMap = new ymaps.Map("stock-map", {
                    center: [42.875989, 74.603674],
                    zoom: 17
                });
                myMap.behaviors.disable('scrollZoom');
                myMap.controls.remove('typeSelector');
                myMap.controls.remove('trafficControl');
                myMap.controls.remove('searchControl');
                myMap.controls.remove('scaleLine');
                myMap.controls.remove('geolocationControl');
                myMap.controls.remove('rulerControl');
                myMap.controls.remove('fullscreenControl');

                var myPlacemark = new ymaps.Placemark(
                    [42.875989, 74.603674],
                    {
                        hintContent: 'Передвиньте маркер на объект',
                        balloonContent: 'Название заведения',
                    },
                    {
                        iconLayout: 'default#image',
                        iconImageHref: '/img/markers/static.png'
                    }
                );
                myMap.geoObjects.add(myPlacemark);
            });
            modal.modal('handleUpdate');
        });
    });


    /*
    * Load price list by category
    * */
    $('.price_list').on('click', function(e){
        var self = $(this);
        var category_id = self.data('category-id');
        var type = self.data('type');
        var item_id = self.data('item_id');
        var container = $('.price_list_container');
        $.post('/ajax/price_list', {cid: category_id, type: type, item_id: item_id}, function(data){
            container.html(data);
        });
    });
});

// Rating
$(function () {
    if(document.querySelector('.rating-star-box')) {
        var ratingStars = $('.ratingInput'), path;
        var setRating = ratingStars.attr('data-set-rating');
        var avgRate = ratingStars.attr('data-avg-rating');
        var changedElement = '.rating-star-box span div:nth-child(' + setRating + ') div:nth-child(2)';

        $(changedElement).addClass('star-checked');
        $(changedElement + ' span').addClass('glyphicon glyphicon-star');
        ratingStars.rating('rate', avgRate);
        body.on('change', '.ratingInput', function(e) {
            ratingStars = $(e.target);
            var item_id = ratingStars.attr('data-id');
            var rate = ratingStars.val();

            ratingStars.attr('data-type') === 'club' ? path = '/c-rated' : path = '/t-rated';
            sendAjaxWIthValidation($(this), {item_id: item_id, rating: rate}, "GET", path, refreshRating);
        });

        function refreshRating(data) {
            var setRating = $.parseJSON($("#setRating").text()).avgRating;
            $('.ratingInput').rating('rate', setRating);
        }
    }
});

// toFavourites
$(function () {
    var toFavourites = $('.heart');

    toFavourites.on('click', function (e) {
        e.preventDefault();
        var item_id = toFavourites.attr('data-id');

        toFavourites.attr('data-type') === 'club' ? path = '/c-toFavourites' : path = '/t-toFavourites';
        $.get(path, {item_id: item_id}, function (d) {
            toFavourites.toggleClass('active');
            getAjaxModal(toFavourites);
        });
    });
});

//REVIEWS
$(function () {
    var show_more = $('.show_more');

    // Sort Reviews by
    $('.sort-reviews').on('click',  function (e) {
        var self = $(this);
        var parent = self.closest('section.reviews');
        var seemore = parent.find('.seemore');

        var data = {
            type: seemore.attr('data-type'),
            item_id: $('.create-reviews').attr('data-id'),
            page: 1,
            sort: self.attr('data-sort'),
            changedSort: true
        };

        sendAjaxWIthValidation(self, data, "GET", '/ajax/showMore');
    });
});