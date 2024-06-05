@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')

<div class="thanks-container">
    <div class="thanks">
        <p class="thanks-p">Thank you</p>
    </div>
    <div class="thanks-you">
        <p class="thanks-you-p">お問い合わせありがとうございました</p>
        <div class="thanks-you-div">
            <a class="thanks-you-a" href="/">HOME</a>
        </div>
    </div>
</div>

@endsection