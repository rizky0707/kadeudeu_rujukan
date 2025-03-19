<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#6777ef"/>
{{-- <link rel="apple-touch-icon" href="{{ asset('img/logo-app.png') }}"> --}}
<link rel="manifest" href="{{ asset('/manifest.json') }}">
  <title>Login | Rujukan</title>
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
    
  </style>
</head>
<body>

  <!-- Konten utama -->

  <div class="container mt-2">
    <img src="{{asset('img/logo kadeudeu.png')}}" class="mx-auto d-block" width="158" height="79" alt="" srcset="">
    <h3 class="text-center">Log In</h3>
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" required autocomplete="current-password">
        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>
      <div class="d-grid col mx-auto">
      <button type="submit" class="btn btn-primary">Sign In</button>
    </div>
    </form>
    
  </div>

  
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
