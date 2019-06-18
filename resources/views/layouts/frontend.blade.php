<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Beercollection</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/frontend.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">Beercollection</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      @if (Auth::check())
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="dashboard">Go to backend</a>
                </li>
            </ul>
        </div>


        @else

          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#register">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#login">Login</a>
                </li>
            </ul>
        </div>


        @endif
    </div>
  </nav>

  <!-- Header -->
  <header class="masthead">
    <div class="container d-flex h-100 align-items-center">
      <div class="mx-auto text-center">
        <h1 class="mx-auto my-0 text-uppercase">Beercollection</h1>
        <h2 class="text-white-50 mx-auto mt-2 mb-5">Managing your beercollection just got a lot easier </h2>
        <a href="#register" class="btn btn-primary js-scroll-trigger">Register your account today</a>
      </div>
    </div>
  </header>





    <section id="register" class="register-section">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto text-center">

          <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
          <h2 class="text-white mb-5">Register your account</h2>



                <form class="form-inline d-flex flex-column" action="{{ route('register') }}" method="post" novalidate>
                    <div class="form-group">
                    @csrf
                         <div class="p-3">
                            <input
                                type="text"

                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0"
                                placeholder="Enter name"
                                name="name"

                                value="{{ old('name') }}"
                                required>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                                </div>
                                 <div class="p-3">
                            <input
                                type="email"
                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0"
                                placeholder="Enter email"
                                name="email"
                                value="{{ old('email') }}"
                                required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                                 </div>
                                  <div class="p-3">

                            <input
                                type="password"
                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0"
                                placeholder="Password"
                                name="password"
                                required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            </div>
                             <div class="p-3">

                            <input
                                type="password"
                                     class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0"
                                placeholder="Confirm Password"
                                name="password_confirmation"
                                id="password-confirm">

                             </div>
                             <div class="p-2">
                            <button type="submit" class="btn btn-primary mx-auto">
                                @lang('Create new account')
                            </button>




                             </div>


                </form>








        </div>
      </div>
    </div>
  </section>

    <section id="login" class="login-section">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto text-center">

            <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
            <h2 class="text-white mb-5">Login to your account</h2>




            <form class="form-inline d-flex flex-column " action="{{ route('login') }}" method="post" novalidate>
            @csrf
                <div class="p-3">



                <input
                    type="email"
                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0"
                    name="email"
                    id="email"
                    aria-describedby="emailHelp"
                    placeholder="Enter email"
                    value="{{ old('email') }}"
                    required
                    >
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

                    </div>
                    <div class="p-3">

                            <input
                                type="password"

                                 class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0"
                                name="password"
                                id="password"
                                placeholder="Password">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            </div>



                         <div class="p-2">
                         <button type="submit" class="btn btn-primary mx-auto">Login</button>
                         </div>
                </form>


        </div>
      </div>
    </div>
  </section>


  <!-- Footer -->
  <footer class="bg-black small text-center text-white-50">
    <div class="container">
      Copyright &copy; Beercollection - 2019
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/frontend.min.js"></script>

</body>

</html>
