
$.getJSON("http://api.openweathermap.org/data/2.5/weather?q=Pristina&units=metric&appid=1e7aa2e467277f2b1073c6d3d56548f4",function(data) {
    console.log(data);
    var icon = "http://openweathermap.org/img/w/"+data.weather[0].icon+".png";
    var temp =Math.floor(data.main.temp);
    var weather =data.weather[0].main;
    var city = data.name;

    $('.icon').attr('src',icon);
    $('.weather').append(weather);
    $('.temp').append(temp);
    $('.temp').append("°C")
    $('.city').append(city);
})
