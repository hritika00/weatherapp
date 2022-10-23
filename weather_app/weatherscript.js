window.alert("Welcome to my Weather app!!"); //alerts before opeining the page
let weather = {
  apiKey: "36bd7330103e2dbca2c20a5d99eea7cd", //from openweathermap.org
  fetchWeather: function () {
    fetch(
      //the fetch function requests the server and load the information that is returned by the server onto the web pages
      'http://localhost/myapi.php'
    )
      .then((response) => {
        if (!response.ok) {
          alert("No weather found.");
          throw new Error("No weather found.");
        }
        return response.json(); //transmitting data in web application.
      })
      .then((data) => this.displayWeather(data));
  },
  displayWeather: function (data) {
    const { weather_description, weather_temperature, weather_wind, city, humidity, pressure, deg, icon} = data;
    console.log(weather_description, weather_temperature, weather_wind, city, humidity, pressure, deg, icon);
    document.querySelector(".city").innerText = " Weather in " + city;
    document.querySelector(".icon").src =
      "https://openweathermap.org/img/wn/" + icon + ".png"; //src=source
    document.querySelector(".description").innerText = weather_description;
    document.querySelector(".temp").innerHTML = weather_temperature + "°C";
    document.querySelector(".humidity").innerText =
      "Humidity:" + humidity + "%";
    document.querySelector(".wind").innerText = "Wind speed:" + weather_wind + "m/s";
    document.querySelector(".pressure").innerText =
      "Pressure:" + pressure + "hPa";
    let date = new Date().toLocaleDateString()
    document.getElementById('date').innerHTML = date;
    document.querySelector(".weather").classList.remove("loading");
  },
  search: function () {
    this.fetchWeather(document.querySelector(".search.box").value);
 },
};

// document.querySelector(".search button").addEventListener("click", function () {
//   weather.search();
// });
// document
//   .querySelector(".search-box")
//   .addEventListener("keyup", function (event) {
//     if (event.key == "Enter") {
//       weather.search();
//     }
//   });

weather.fetchWeather();
