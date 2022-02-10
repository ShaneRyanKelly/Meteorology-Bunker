var timeStamp;
var temperature;
var wSpd;
var wDir;
var shortForecast;

$(function(){
    console.log("firing main!");
    // testPHP("./scripts/php/getSILSO.php");
    // testPHP("./scripts/php/parseFile.php");
    // testPHP("./scripts/php/uploadTable.php");
    testPHP("./scripts/php/addToday.php");
    testPHP("./scripts/php/updateNDBC.php");
    //testPHP("./scripts/php/getLocalForecast.php");
    connectMysql();
    getDateTime();
    getSSpotNum();
    getBuoyData();
    getLocalForecast();
    createToday();
});

function connectMysql(){
    $.ajax({
        type: "GET",
        url: "./scripts/php/connectSILSO.php",
        async: false,
        cache: false,
        success: function(result){
            $('#connectionStatus').append("Connected");
        }
    });
}

function getDateTime(){
    $.ajax({
        type: "GET",
        url: "./scripts/php/datetime.php",
        async: false,
        cache: false,
        success: function(result){
            timeStamp = result;
            $('#datetime').append(timeStamp);
            
        }
    });
}

function createToday(){
    var weatherArray = {
        "timestamp":timeStamp,
        "temperature":temperature,
        "shortForecast":shortForecast,
        "wDir":wDir,
        "wSpd":wSpd
    }
    console.log(weatherArray);
    $.ajax({
        type: "POST",
        url: "./scripts/php/addLocalForecast.php",
        async: false,
        cache: false,
        data: weatherArray,
        success: function(result){
            console.log(result);
        },
        error: function(result){
            console.log("php error");
            console.log(result);
        }
    });
}

function getBuoyData(){
    $.ajax({
        type: "GET",
        url: "./scripts/php/NDBCQuery.php",
        dataType: 'json',
        async: false,
        cache: false,
        success: function(result){
            $('#sunspots').append("Wind Direction: " + result.wdir + "&#176;</br>");
            $('#sunspots').append("Wind Speed: " + result.wspd + " m/s</br>");
            $('#sunspots').append("Gust Speed: " + result.gst + " m/s</br>");
            $('#sunspots').append("Wave Height: " + result.wvht + " m</br>");
            $('#sunspots').append("Dominant Wave Period: " + result.dpd + " s</br>");
            $('#sunspots').append("Average Wave Period: " + result.apd + " s</br>");
            $('#sunspots').append("Wave Direction: " + result.mwd + "&#176;</br>");
            $('#sunspots').append("Air Pressure: " + result.pres + " hPa</br>");
            $('#sunspots').append("Water Temperature: " + result.wtmp + "&#176;C</br>");
        }
    });
}

function getLocalForecast(){
    $.ajax({
        type: "GET",
        url: "./scripts/php/getLocalForecast.php",
        dataType: 'json',
        async: false,
        cache: false,
        success: function(result){
            temperature = result['properties']['periods'][0]['temperature'].toString();
            shortForecast = result['properties']['periods'][0]['shortForecast'];
            wDir = result['properties']['periods'][0]['windDirection'];
            wSpd = result['properties']['periods'][0]['windSpeed'];

            $('#forecast1').append("<h3>" + result['properties']['periods'][0]['name'] + "</h3>");
            $('#forecast1').append("<b>Temperature:</b> " + result['properties']['periods'][0]['temperature'] + "&#176;</br>");
            $('#forecast1').append("<b>Winds:</b> " + result['properties']['periods'][0]['windSpeed'] + ", ");
            $('#forecast1').append(result['properties']['periods'][0]['windDirection'] + "</br>");
            $('#forecast1').append("<b>Local Forecast:</b> " + result['properties']['periods'][0]['detailedForecast'] + "</br>");
            $('#forecast1').append("<b>" + result['properties']['periods'][1]['name'] + "</b> " + result['properties']['periods'][1]['shortForecast']);

            $('#forecast2').append("<h3>" + result['properties']['periods'][2]['name'] + "</h3>");
            $('#forecast2').append("<b>Temperature:</b> " + result['properties']['periods'][2]['temperature'] + "&#176;</br>");
            $('#forecast2').append("<b>Winds:</b> " + result['properties']['periods'][2]['windSpeed'] + ", ");
            $('#forecast2').append(result['properties']['periods'][2]['windDirection'] + "</br>");
            $('#forecast2').append("<b>Local Forecast:</b> " + result['properties']['periods'][2]['detailedForecast'] + "</br>");
            $('#forecast2').append("<b>" + result['properties']['periods'][3]['name'] + "</b> " + result['properties']['periods'][3]['shortForecast']);

            $('#forecast3').append("<h3>" + result['properties']['periods'][4]['name'] + "</h3>");
            $('#forecast3').append("<b>Temperature:</b> " + result['properties']['periods'][4]['temperature'] + "&#176;</br>");
            $('#forecast3').append("<b>Winds:</b> " + result['properties']['periods'][4]['windSpeed'] + ", ");
            $('#forecast3').append(result['properties']['periods'][4]['windDirection'] + "</br>");
            $('#forecast3').append("<b>Local Forecast:</b> " + result['properties']['periods'][4]['detailedForecast'] + "</br>");
            $('#forecast3').append("<b>" + result['properties']['periods'][5]['name'] + "</b> " + result['properties']['periods'][5]['shortForecast']);
            console.log(result);
        },
        error: function(result){
            console.log("forecast error");
            console.log(result);
        }
    });
}

function getSSpotNum(){
    $.ajax({
        type: "GET",
        url: "./scripts/php/sSpotQuery.php",
        async: false,
        cache: false,
        success: function(result){
            $('#sunspots').append("Sunspots: ");
            $('#sunspots').append(result + "</br>");
            console.log(result);
        }
    });
}

function getSunspotData(){
    $.ajax({
        type: "GET",
        url:"./scripts/php/getSILSO.php",
        async: false,
        cache: false,
        success: function(result){
            console.log(result);
        }
    });
}
function testPHP(scriptPath){
    $.ajax({
        type: "GET",
        url:scriptPath,
        async: false,
        cache: false,
        success: function(result){
            console.log(result);
        }
    });
}

function testPHPPOST(scriptPath, postData){
    $.ajax({
        type: "POST",
        url: scriptPath,
        async: false,
        cache: false,
        data: { buoyNumber : postData },
        success: function(result){
            console.log(result);
        }
    });
}
