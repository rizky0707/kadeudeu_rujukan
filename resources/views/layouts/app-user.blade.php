<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
              <!-- PWA  -->
<meta name="theme-color" content="#6777ef"/>
{{-- <link rel="apple-touch-icon" href="{{ asset('logo.png') }}"> --}}
<link rel="manifest" href="{{ asset('/manifest.json') }}">
  <title>Rujukan</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome CDN untuk ikon -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <!-- Google Fonts: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
  <style>

    /* Menggunakan font Poppins */
    body {
      font-family: 'Poppins', sans-serif;
    }
    /* Membuat sticky menu di bawah */
    .sticky-bottom-menu {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background-color: #007bff; /* Warna background yang lebih modern */
      border-radius: 25px 25px 0 0; /* Membuat sudut menu menjadi melengkung */
      box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.1); /* Shadow agar lebih terlihat elegan */
      z-index: 1000;
      transition: transform 0.3s ease-in-out; /* Animasi saat interaksi */
    }

    .sticky-bottom-menu .nav-item {
      text-align: center;
      flex: 1;
    }

    .sticky-bottom-menu .nav-link {
      font-size: 30px; /* Ukuran ikon lebih besar */
      padding: 12px;
      color: rgb(31, 28, 28);
      transition: color 0.3s ease, transform 0.2s ease;
    }

    /* Efek saat hover pada ikon */
    .sticky-bottom-menu .nav-link:hover {
      color: #3A81C9; /* Warna saat hover */
      transform: scale(1.2); /* Membesarkan ikon sedikit saat hover */
    }

    /* Efek saat menu aktif */
    .sticky-bottom-menu .nav-link.active {
      color: #3A81C9; /* Warna hijau untuk ikon yang aktif */
    }

    /* Menambahkan animasi sliding untuk tampilan awal */
    .sticky-bottom-menu.show {
      transform: translateY(0);
    }

    .sticky-bottom-menu.hide {
      transform: translateY(100%);
    }
    .content-container {
      padding-bottom: 100px; /* Adjust this value to create enough space */
  }
    
  </style>
</head>
<body>

  <!-- Konten utama -->

  <div class="container mt-2 content-container">
    {{-- area header --}}
    <img src="{{asset('img/logo kadeudeu.png')}}" class="mx-auto d-block" width="158" height="79" alt="" srcset="">
    
    <div class="row">
      <div class="col">
        <h6>{{ Auth::user()->name }}</h6>
        <img src="{{asset('img/Line.png')}}">

      </div>
      <div class="col text-end">
        <img src="{{asset('img/profile.png')}}" alt="" srcset="">

        |
        <a  href="{{ route('logout') }}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
         <span class="badge bg-secondary">Logout</span>
     </a>

     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
         @csrf
     </form>
        
      </div>

    </div>
  
    {{-- area konten --}}

    @yield('content')

    
    
  </div>

  <!-- Sticky Bottom Menu -->
  <nav class="sticky-bottom-menu navbar navbar-light bg-light">
    <ul class="nav justify-content-between w-100">
      <li class="nav-item">
        <a class="nav-link active" href="{{route('home')}}">
          <i class="fas fa-home"></i>
          <h6>Home</h6>
          <!-- <p class="font-weight-light">Home</p> -->
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('rujukan.indexUser')}}">
          <i class="fa fa-users"></i>
          <h6>Rujukan</h6>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fa fa-table"></i>
          <h6>Jadwal</h6>
        </a>
      </li>
      <li class="nav-item">
        
        <a class="nav-link" href="#">
          <i class="fa fa-ellipsis-h"></i>
          <h6>More</h6>
        </a>
      </li>
    </ul>
  </nav>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Menambahkan efek animasi sliding pada menu saat halaman pertama dimuat
    document.querySelector('.sticky-bottom-menu').classList.add('show');
  </script>
   <script src="{{ asset('/sw.js') }}"></script>
   <script>
      if ("serviceWorker" in navigator) {
         // Register a service worker hosted at the root of the
         // site using the default scope.
         navigator.serviceWorker.register("/sw.js").then(
         (registration) => {
            console.log("Service worker registration succeeded:", registration);
         },
         (error) => {
            console.error(`Service worker registration failed: ${error}`);
         },
       );
     } else {
        console.error("Service workers are not supported.");
     }
   </script>
</body>
</html>
