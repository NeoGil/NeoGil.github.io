//$("#form")[0].reset();


let article = document.getElementsByTagName("label"),
    form = document.getElementsByTagName('form');



/*
article[4].addEventListener('click', function(event) {
    let target = event.target;
    console.log('Произошло событие: '+ event.type + ' на элементе ' + 5);
});
article[5].addEventListener('click', function(event) {
    let target = event.target;
    console.log('Произошло событие: '+ event.type + ' на элементе ' + 6);
});
article[6].addEventListener('click', function(event) {
    let target = event.target;
    console.log('Произошло событие: '+ event.type + ' на элементе ' + 7);
});
article[7].addEventListener('click', function(event) {
    let target = event.target;
    console.log('Произошло событие: '+ event.type + ' на элементе ' + 8);
});
article[8].addEventListener('click', function(event) {
    let target = event.target;
    console.log('Произошло событие: '+ event.type + ' на элементе ' + 9);
});

*/
var l = 0;
function openg() {
    PlusAnswer = document.querySelectorAll('div[class^=pluss]');
    MinusAnswer = document.querySelectorAll('div[class^=minus]');
    answer = document.querySelectorAll('.answer');
    plusTest = document.querySelectorAll('div[class^=tpluss]');
    minusTest = document.querySelectorAll('div[class^=tminus]');
    testings = document.querySelectorAll('.testing');
}

let PlusAnswer = document.querySelectorAll('div[class^=pluss]'),
        MinusAnswer = document.querySelectorAll('div[class^=minus]'),
        answer = document.querySelectorAll('.answer'),
        plusTest = document.querySelectorAll('div[class^=tpluss]'),
        minusTest = document.querySelectorAll('div[class^=tminus]'),
        testings = document.querySelectorAll('.testing');

setInterval(function() {
    openg();
}, 2000);
var strGET = window.location.search.replace( '?', ''); 
var params = window
    .location
    .search
    .replace('?','')
    .split('&')
    .reduce(
        function(p,e){
            var a = e.split('=');
            p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
            return p;
        },
        {}
    );

    //test elements
$( this ).on( "click", function( event ) {
    target = event.target;
    t = event.target;
    p = PlusAnswer[target.innerHTML];
    m = MinusAnswer[target.innerHTML];
    tp = plusTest[0];
    tm = minusTest[0];
    

    if ( t == p ) {
        content = p.innerHTML;
        //console.log(content);
        let rowans = answer[target.innerHTML].querySelectorAll(".row");
        testing = (($(testings).children()).length);
        ansvid = (($(rowans).children()).length)+1;
        $(`<div class="col-md-4 col-lg-3"><input type="text" name="test[${content}][answer][${ansvid}]", placeholder="Введите ответ"><input type="checkbox" name="test[${content}][choice][${ansvid}]"></div>`).appendTo($(rowans));
        //console.log(($(rowans).children()).length);
    } else if ( t == m) {
        let rowans = answer[target.innerHTML].querySelectorAll(".row");
        $(rowans).children().last().remove();
    } else if ( t == tp) {
        testing = (($(testings).children()).length);
        $(`<div class="testing_form" id="test1">
    <textarea name="test[${testing}][question]" id="1" cols="80" rows="10" placeholder="Введите вопрос ${testing+1}"></textarea>
    <div class="answer">
        <div class="row">
            <div class="col-md-4 col-lg-3">
                <input type="text" name="test[${testing}][answer][1]", placeholder="Введите ответ">
                <input type="checkbox" name="test[${testing}][choice][1]">
            </div>
            <div class="col-md-4 col-lg-3">
                <input type="text" name="test[${testing}][answer][2]", placeholder="Введите ответ">
                <input type="checkbox" name="test[${testing}][choice][2]">
            </div>
            <div class="col-md-4 col-lg-3">
                <input type="text" name="test[${testing}][answer][3]", placeholder="Введите ответ">
                <input type="checkbox" name="test[${testing}][choice][3]">
            </div>
            <div class="col-md-4 col-lg-3">
                <input type="text" name="test[${testing}][answer][4]", placeholder="Введите ответ">
                <input type="checkbox" name="test[${testing}][choice][4]">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="minus">${testing}</div>
        
        <div class="pluss">${testing}</div>
    </div>
</div>`).appendTo($(testings));
    } else if ( t == tm){
        $(testings).children().last().remove();
    } else {}

});
