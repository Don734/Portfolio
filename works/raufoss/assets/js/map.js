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
        center: [55.76, 37.64],
        controls: ['geolocationControl', 'trafficControl'],
        // Уровень масштабирования. Допустимые значения:
        // от 0 (весь мир) до 19.
        zoom: 7
    });

    myMap.controls.add('zoomControl', {
        size: 'small'
    })
}