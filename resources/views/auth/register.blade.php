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
    <div class="input" style="height:500px;">
      <div class="logo">
        <img src="{{ asset ('img/digi.png') }}" alt="Logo Lab" />
      </div>
      <h1>Register</h1>
      <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="box-input">
          <i class="fas fa-envelope-open-text"></i>

            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="name"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="box-input">
          <i class="fas fa-envelope-open-text"></i>

            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="box-input">
        <i class="fas fa-lock"></i>
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            placeholder="Password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="box-input">
        <i class="fas fa-lock"></i>
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" 
                            placeholder="Confirm Password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="">


        <x-primary-button  class="btn-input" style="margin-bottom:0px;">
                {{ __('Register') }}
            </x-primary-button>
            <div class="bottom">
            <p>
                Already have an account?
                <a href="{{ route('login') }}">Login!</a>
              </p>
        </div>
        </div>

    </form>
    </div>
  </body>
</html>
