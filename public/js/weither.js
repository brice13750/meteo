  var app = {
    init: function(){

          $.getJSON('https://api.openweathermap.org/data/2.5/weather?q=Toulouse,fr&APPID=c070300b7d93c20fa46ec6ea42ca74dc&units=metric',function(data){
            $('#zone').html('Température à Toulouse: ' + data.main.temp + '<br>');
          });

      $('#submit').on('click', app.getData);
    }, 

    getData: function(){
      let value = $('#user').val();
      let url = 'https://api.openweathermap.org/data/2.5/weather?q='+value+',fr&APPID=c070300b7d93c20fa46ec6ea42ca74dc&units=metric';

      $.get(url, app.getDataSuccess).done(function() {
        
      })
      .fail(function() {
        $('.result').html( "Ville introuvable");
        $('.feel, .min, .max').html("");    
      })
    },

    getDataSuccess: function(data) {
      console.log("data", data)

      $('.result').html( "La température actuelle est de "+ data.main.temp+" °C" );
      $('.feel').html( "La température ressentie est de "+ data.main.feels_like+" °C" );
      $('.min').html( "La température minimum est de "+ data.main.temp_min+" °C" );
      $('.max').html( "La température maximum est de "+ data.main.temp_max+" °C" );
    },

}
app.init();