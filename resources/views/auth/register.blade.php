@extends('layouts.app')
@section('title')
register
@endsection

@section('content')
<!-- component -->
<script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script>

<!-- page -->
<main class="relative min-h-screen w-full bg-white">
    <!-- component -->
    <div class="p-6" x-data="app">
        <!-- header -->
        <header class="flex w-full justify-between">
            <a href="/">
                <svg class="h-7 w-7 cursor-pointer text-gray-400 hover:text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                    <path stroke-width="1" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </a>

            <!-- buttons -->
            <div>
                <button type="button" class="rounded-2xl border-b-2 border-b-gray-300 bg-white py-3 px-4 font-bold text-red-500 ring-2 ring-gray-300 hover:bg-gray-200 active:translate-y-[0.125rem] active:border-b-gray-200">
                    <a href="{{route('login')}}">Se connecter</a>
                </button>


            </div>
        </header>

        <section class="absolute top-1/2 left-1/2 mx-auto max-w-sm -translate-x-1/2 -translate-y-1/2 transform space-y-4 text-center">
            <!-- register content -->
            <form action="/register" method="POST">
            @csrf
                <div x-show="isLoginPage" class="space-y-4">
                    <header class="mb-3 text-2xl font-bold">Creer un profil</header>
                    <div class="w-full rounded-2xl bg-gray-50 px-4 ring-2 ring-gray-200 focus-within:ring-blue-400">
                        <input type="text" name="nom" placeholder="Nom" class="my-3 w-full border-none bg-transparent outline-none focus:outline-none" />
                    </div>
                    <div class="w-full rounded-2xl bg-gray-50 px-4 ring-2 ring-gray-200 focus-within:ring-blue-400">
                        <input type="text" name="prenom" placeholder="Prenom " class="my-3 w-full border-none bg-transparent outline-none focus:outline-none" />
                    </div>
                    <div class="w-full rounded-2xl bg-gray-50 px-4 ring-2 ring-gray-200 focus-within:ring-blue-400">
                        <input type="text" name="email" placeholder="adresse email" class="my-3 w-full border-none bg-transparent outline-none focus:outline-none" />
                    </div>
                    <div class="w-full rounded-2xl bg-gray-50 px-4 ring-2 ring-gray-200 focus-within:ring-blue-400">
                        <input type="password" name="password" placeholder="Entrez un mot de passe" class="my-3 w-full border-none bg-transparent outline-none focus:outline-none" />
                    </div>
                    <div class="w-full rounded-2xl bg-gray-50 px-4 ring-2 ring-gray-200 focus-within:ring-blue-400">
                        <input type="password" name="password_confirmation" placeholder="Ressaisissez le mot de passe" class="my-3 w-full border-none bg-transparent outline-none focus:outline-none" />
                    </div>
                    <button class="w-full rounded-2xl border-b-4 border-b-red-600 bg-red-500 py-3 font-bold text-white hover:bg-reg-400 active:translate-y-[0.125rem] active:border-b-red-400">
                        Creer un compte
                    </button>
                </div>
                @if($errors->any())
                @foreach($errors->all() as $error)
                <div class="bg-red-100 rounded-lg py-5 px-6 mb-3 text-base text-red-700 inline-flex items-center w-full" role="alert">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times-circle" class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z"></path>
                    </svg>
                    <li> {{ $error }} </li>
                </div>
                @endforeach
                @endif
            </form>

            <!-- login content -->


            <div class="flex items-center space-x-4">
                <hr class="w-full border border-gray-300" />
                <div class="font-semibold text-gray-400"> - </div>
                <hr class="w-full border border-gray-300" />
            </div>

            <footer>
                <!-- <div class="grid grid-cols-2 gap-4">
                    <a href="#"
                        class="rounded-2xl border-b-2 border-b-gray-300 bg-white py-2.5 px-4 font-bold text-blue-700 ring-2 ring-gray-300 hover:bg-gray-200 active:translate-y-[0.125rem] active:border-b-gray-200">FACEBOOK</a>
                    <a href="#"
                        class="rounded-2xl border-b-2 border-b-gray-300 bg-white py-2.5 px-4 font-bold text-blue-500 ring-2 ring-gray-300 hover:bg-gray-200 active:translate-y-[0.125rem] active:border-b-gray-200">GOOGLE</a>
                </div> -->

                <div class="mt-8 text-sm text-gray-400">
                    By signing in to ********, you agree to our
                    <a href="#" class="font-medium text-gray-500">Terms</a> and
                    <a href="#" class="font-medium text-gray-500">Privacy Policy</a>.
                </div>
            </footer>
        </section>
    </div>
</main>

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("app", () => ({
            isLoginPage: true,
        }));
    });
</script>

@endsection