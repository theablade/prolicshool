<head>


  <style>
  .bg {
    background-image: url('https://cdn.pixabay.com/photo/2016/09/16/11/04/painting-1673775_1280.jpg');
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;

  }
  </style>

</head>

<x-guest-layout class="flex">
  <div class="bg">

    <x-authentication-card>
      <x-slot name="logo">
        <x-authentication-card-logo />
      </x-slot>

      <x-validation-errors class="mb-4" />

      @if (session('status'))
      <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
      </div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
          <x-label for="email" class="text-bold" value="{{ __('Email') }}" />
          <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
            autofocus autocomplete="username" />
        </div>

        <div class="mt-4">
          <x-label for="password" value="{{ __('Senha') }}" />
          <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
            autocomplete="current-password" />
        </div>

        <div class="block mt-4">
          <label for="remember_me" class="flex items-center">
            <x-checkbox id="remember_me" name="remember" />
            <span class="ms-2 text-sm text-gray-600"></span>
          </label>
        </div>

        <div class="flex items-center justify-end mt-4">


          <x-button class="ms-4">
            {{ __('Entrar') }}
          </x-button>
        </div>
      </form>
    </x-authentication-card>
  </div>

</x-guest-layout>