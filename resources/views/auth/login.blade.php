<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset ('css/style.css') }}" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
    />
    <title>Login Page</title>
  </head>

  <body>
    <div class="input">
      <div class="logo">
        <img src="{{ asset ('img/digi.png') }}" alt="Logo Lab" />
      </div>
      <h1>LOGIN</h1>
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="box-input">
            <i class="fas fa-envelope-open-text"></i>
            <x-text-input id="email" class="" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="box-input">
            <i class="fas fa-lock"></i>

            <x-text-input id="password" class=""
                            type="password"
                            name="password"
                            placeholder="Password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->


        <div class="">


            <x-primary-button class="btn-input">
                {{ __('Log in') }}
            </x-primary-button>
            <div class="bottom">
          <p>
            Belum punya akun?
            <a href="{{ route ('register')}}">Register!</a>
          </p>
        </div>
        </div>
    </form>
    </div>
  </body>
</html>
