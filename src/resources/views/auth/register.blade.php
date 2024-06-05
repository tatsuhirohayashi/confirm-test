@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
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
            <a class="header__logo" href="/register">
                FashionablyLate
            </a>
            <nav>
                <ul class="header-nav-1">
                    <li class="header-nav__item-1">
                        <a class="header-nav__link-1" href="/login">login</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<div class="body">
    <div class="register__content">
        <div class="register__heading">
            <h2>Register</h2>
        </div>
        <div class="register__content-ttl">
            <form class="form" action="/register" method="post">
                @csrf
                <div class="form__group">
                    <div class="form__group-title">
                        <h2 class="form__group-title-h2">お名前</h2>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="name" placeholder="例：山田　太郎" value="{{ old('name') }}" />
                        </div>
                        <div class="form__error">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
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
                    <button class="form__button-submit" type="submit">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection