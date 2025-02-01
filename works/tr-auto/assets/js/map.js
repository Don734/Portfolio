document.addEventListener('DOMContentLoaded', function () {
    ymaps.ready(init);
})

function init(){
    // Создание карты.
    let myMap = new ymaps.Map("map", {
        // Координаты центра карты.
        // Порядок по умолчанию: «широта, долгота».
        // Чтобы не определять координаты центра карты вручную,
        // воспользуйтесь инструментом Определение координат.
        center: [55.743644, 37.699669],
        controls: ['geolocationControl', 'trafficControl'],
        // Уровень масштабирования. Допустимые значения:
        // от 0 (весь мир) до 19.
        zoom: 17
    }),
        myGeoObject = new ymaps.GeoObject({
            // Описание геометрии.
            geometry: {
                type: "Point",
                coordinates: [55.743644, 37.699669]
            },
        }, {
            // Опции.
            // Иконка метки будет растягиваться под размер ее содержимого.
            preset: 'islands#blackStretchyIcon',
            // Метку можно перемещать.
            draggable: true
        });

    myMap.controls.add('zoomControl', {
        size: 'small'
    })
    myMap.geoObjects.add(myGeoObject)
}