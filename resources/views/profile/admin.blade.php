
@extends('layouts.tempadmin')

@section('admin')
<div class="content">
</div>
<div class="rightside">
  @include('layouts.navbaradmin')
    <div class="table-container flex mt-16">
        <center>
            <img src="{{ asset('img/davi.png') }}" class="h-60 rounded-full mt-6 mb-3" alt="davi" />
        </center>
        <div class="flex-1 flex-row px-16">
            <div>
                <h1 class="text-3xl font-happy">Admin Profile</h1>
            </div>
            <div class="flex mt-4">
                <div style="flex:1 1 0;">
                    <p class=" text-2xl font-semibold p-1">Username</p>
                    <p class=" text-2xl font-semibold p-1">Name</p>
                    <p class=" text-2xl font-semibold p-1">Email</p>
                    <p class=" text-2xl font-semibold p-1">Role</p>
                </div>
                <div style="flex:3 1 0;">
                <form method="post" action="{{ route('admin.profile.update') }}" class="">
        @csrf
        @method('patch')
        <div>
            <x-text-input id="name" name="name" type="text" class=" text-xl my-1 py-1 px-2 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-text-input id="username" name="username" type="text" class=" text-xl my-1 py-1 px-2 block w-full" :value="old('username', $user->username)" required autofocus autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-text-input id="email" name="email" type="email" class=" text-xl my-1 py-1 px-2 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div>
            <x-text-input id="jabatan" name="jabatan" type="jabatan" class=" text-xl my-1 py-1 px-2 block w-full" :value="old('jabatan', $user->jabatan)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('jabatan')" />
        </div>
        

        <div class="flex absolute bottom-50 left-50 mt-48 px-12 py-1 border border-solid rounded-xl border-stone-950" style="margin-left:-31rem; background-color: #7895cb;">
            <button type="submit" class="">{{ __('Save') }}</button>
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class=""
                ></p>
            @endif
        </div>
    </form>
                </div>
            </div>
            <a href="">
            <div class="flex flex-col mt-4">
                
            <button class="text-lg w-40 border border-solid rounded-2xl border-stone-950 h-10 place-self-end" style="background-color:#f26464">Reset Password</button>
        </div>
        </a>
    </div>

  
</div>

@endsection

