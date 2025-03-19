@extends('layouts.app-user')
@section('content')

<div class="row">
    <div class="col">
      <div class="shadow-sm p-3 mb-3 bg-body-tertiary rounded text-end">
          <h5>0</h5>
        Rujukan 
      </div>
    </div>
    <div class="col">
      <div class="shadow-sm p-3 mb-3 bg-body-tertiary rounded">
       <h5>0</h5>
       Terapis
      </div>
    </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="shadow-sm p-3 mb-5  rounded text-end">
          <div class="row">
            <div class="col-md-6">
          <h5><span id="weather-icon"></span> Cuaca Today</h5>
        <span id="weather">Loading weather...</span>
            </div>
            <div class="col-md-6">
              <h5>
                <i class="fas fa-clock mt-3 mb-2"></i> 
                <span id="realtime-clock">Loading time...</span> | WIB</h5>
        Jl Reog No 17 Turangga Lengkong Bandung
            </div>
            
         </div>
      </div>
    </div>
<h4 class="text-center"><b>Table Rujukan Today</b></h4>
    <table class="table tabel-responsive">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama Pasien</th>
          <th scope="col">Rujuk Pasien</th>
          <th scope="col">Keterangan</th>
        </tr>
      </thead>
      <tbody>
          <?php $no= 1; ?>
        @foreach ($rujukan as $item)   
                <tr>
                  <td> {{$no++}} </td>
                  <td> {{$item->nama_pasien}} </td>
                  <td>
                    {{ $item->rujuk_pasien_users->pluck('name')->implode(', ') }}
                </td>                  
                <td> {{$item->keterangan}} </td>
                </tr>
                @endforeach
        
      </tbody>
    </table>
    <script>
      // Real-time clock
      function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        document.getElementById('realtime-clock').textContent = timeString;
      }
      setInterval(updateClock, 1000);
      updateClock();
    
      // Weather forecast using OpenWeatherMap API
      async function fetchWeather() {
        const apiKey = '4f5b5a414f95aeaebaff1dc33e798992'; // Replace with your OpenWeatherMap API key
        const city = 'Bandung';
        const url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric&lang=id`;
    
        try {
            const response = await fetch(url);
            const data = await response.json();
            const weatherDescription = data.weather[0].description
          .split(' ')
          .map(word => word.charAt(0).toUpperCase() + word.slice(1))
          .join(' ');
            const weatherIcon = data.weather[0].icon;
            const iconUrl = `https://openweathermap.org/img/wn/${weatherIcon}@2x.png`;
            document.getElementById('weather-icon').innerHTML = `<img src="${iconUrl}" alt="${weatherDescription}" style="width: 41px; filter: grayscale(100%); background-color: transparent;">`;
            const temperature = data.main.temp;
            document.getElementById('weather').textContent = `${weatherDescription}, ${temperature}°C`;
        } catch (error) {
          document.getElementById('weather').textContent = 'Gagal memuat cuaca.';
        }
      }
      setInterval(fetchWeather, 1000);
      fetchWeather();
    </script>
@endsection