@extends('layouts.app')
@include('layouts.header')
@section('title')
paiement
@endsection
@section('content')
<!-- component -->

<style>
    /*
module.exports = {
    plugins: [require('@tailwindcss/forms'),]
};
*/
    .form-radio {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        -webkit-print-color-adjust: exact;
        color-adjust: exact;
        display: inline-block;
        vertical-align: middle;
        background-origin: border-box;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        flex-shrink: 0;
        border-radius: 100%;
        border-width: 2px;
    }

    .form-radio:checked {
        background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e");
        border-color: transparent;
        background-color: currentColor;
        background-size: 100% 100%;
        background-position: center;
        background-repeat: no-repeat;
    }

    @media not print {
        .form-radio::-ms-check {
            border-width: 1px;
            color: transparent;
            background: inherit;
            border-color: inherit;
            border-radius: inherit;
        }
    }

    .form-radio:focus {
        outline: none;
    }

    .form-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23a0aec0'%3e%3cpath d='M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z'/%3e%3c/svg%3e");
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        -webkit-print-color-adjust: exact;
        color-adjust: exact;
        background-repeat: no-repeat;
        padding-top: 0.5rem;
        padding-right: 2.5rem;
        padding-bottom: 0.5rem;
        padding-left: 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        background-position: right 0.5rem center;
        background-size: 1.5em 1.5em;
    }

    .form-select::-ms-expand {
        color: #a0aec0;
        border: none;
    }

    @media not print {
        .form-select::-ms-expand {
            display: none;
        }
    }

    @media print and (-ms-high-contrast: active),
    print and (-ms-high-contrast: none) {
        .form-select {
            padding-right: 0.75rem;
        }
    }
</style>
@if(!Auth::user()->paiement)
<div class="min-w-screen min-h-screen bg-gray-100 flex items-center justify-center px-5 pb-10 pt-16">
    <div class="w-full mx-auto rounded-lg bg-white shadow-lg p-5 text-gray-700" style="max-width: 600px">
        <div class="w-full pt-1 pb-5">
            <div class="bg-white text-white overflow-hidden rounded-full w-20 h-20 -mt-16 mx-auto shadow-lg flex justify-center items-center">
                <img src="{{asset('img/paypal.jpg')}}" alt="">
            </div>
        </div>
        <div class="mb-10">
            <h1 class="text-center  font-bold text-xl uppercase" style="color:red;">Pour profiter pleinement de nos services , vous devez d'abord payer les frais d'inscription.</h1>
            <h1 class="text-center  font-bold text-xl uppercase">prix : $1 </h1>

        </div>

        <form action="{{route('paiement')}}" method="post">
            @csrf
            <input type="hidden" name="montant" value="1">
            <div>
                <button type="submit" class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold"><i class="mdi mdi-lock-outline mr-1"></i> PAYER MAINTENANT</button>
            </div>
        </form>
    </div>
</div>
@elseif(Auth::user()->paiement && url()->previous() == route('login'))
@php
header("Location: " . URL::to(route('dashbord')), true, 302);
exit();
@endphp
@else
<div class="min-w-screen min-h-screen bg-gray-100 flex items-center justify-center px-5 pb-10 pt-16">
    <div class="w-full mx-auto rounded-lg bg-white shadow-lg p-5 text-gray-700" style="max-width: 600px">
        <div class="w-full pt-1 pb-5">
            <div class="bg-white text-white overflow-hidden rounded-full w-20 h-20 -mt-16 mx-auto shadow-lg flex justify-center items-center">
                <img src="{{asset('img/paypal.jpg')}}" alt="">
            </div>
        </div>
        <div class="mb-10">
            <h1 class="text-center  font-bold text-xl uppercase" style="color:red;">Votre paiement à bie été effectué</h1>
            <h1 class="text-center  font-bold text-xl uppercase">Transaction ID : {{ $arr['id'] ?? Auth::user()->paiement->payment_id }} </h1>

        </div>

        <div>
            <a href="{{route('dashbord')}}"> <button class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold"><i class="mdi mdi-lock-outline mr-1"></i> CONTINUER VERS LE DASHBORD</button> </a>
        </div>

    </div>
</div>

@endif
@endsection