@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')

<header class="header">
    <div class="header__inner">
        <div class="header-utilities">
            <nav>
                <ul class="header-nav">
                    <li class="header-nav__item">
                        <a class="header-nav__link"></a>
                    </li>
                </ul>
            </nav>
            <a class="header__logo" href="/login">
                FashionablyLate
            </a>
            <nav>
                <ul class="header-nav-1">
                    <li class="header-nav__item-1">
                        <a class="header-nav__link-1" href="/register">register</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<div class="body">
    <div class="login__content">
        <div class="login__heading">
            <h2>Login</h2>
        </div>
        <div class="login__content-ttl">
            <form class="form" action="/login" method="post">
                @csrf
                <div class="form__group">
                    <div class="form__group-title">
                        <h2 class="form__group-title-h2">メールアドレス</h2>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}" />
                        </div>
                        <div class="form__error">
                            @error('email')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <h2 class="form__group-title-h2">パスワード</h2>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="password" name="password" placeholder="例：coachtech" value="{{ old('password') }}" />
                        </div>
                        <div class="form__error">
                            @error('password')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">ログイン</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection