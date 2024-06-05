@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<header class="header">
    <div class="header__inner">
        <a class="header__logo" href="/">
            FashionablyLate
        </a>
    </div>
</header>

<div class="contact__content">
    <div class="contact__heading">
        <h2>Contact</h2>
    </div>
    <form class="form" action="/confirm" method="post">
        @csrf
        <div class="form-item">
            <p class="form-item-label">
                お名前<span class="form-item-label-required">※</span>
            </p>
            <input type="text" name="last_name" class="form-item-input-name" placeholder="例：山田" value="{{ old('last_name') }}" />
            <input type="text" name="first_name" class="form-item-input-name" placeholder="例：太郎" value="{{ old('first_name') }}" />
        </div>
        <div class="form__error">
            @error('last_name')
            {{ $message }}
            @enderror
            @error('first_name')
            {{ $message }}
            @enderror
        </div>
        <div class="form-item">
            <p class="form-item-label">
                性別<span class="form-item-label-required">※</span>
            </p>
            <input type="radio" name="gender" class="form-item-input-gender" value="1" checked /><span class="form-item-input-gender-span">男性</span>
            <input type="radio" name="gender" class="form-item-input-gender" value="2" /><span class="form-item-input-gender-span">女性</span>
            <input type="radio" name="gender" class="form-item-input-gender" value="3" /><span class="form-item-input-gender-span">その他</span>
        </div>
        <div class="form__error">
            @error('gender')
            {{ $message }}
            @enderror
        </div>
        <div class="form-item">
            <p class="form-item-label">
                メールアドレス<span class="form-item-label-required">※</span>
            </p>
            <input type="email" name="email" class="form-item-input" placeholder="例：test@example.com" value="{{ old('email') }}" />
        </div>
        <div class="form__error">
            @error('email')
            {{ $message }}
            @enderror
        </div>
        <div class="form-item">
            <p class="form-item-label">
                電話番号<span class="form-item-label-required">※</span>
            </p>
            <input type="tel" name="tell1" class="form-item-input-tel" placeholder="例：080" value="{{ old('tell1') }}" /><span class="form-item-input-tel-span">ー</span>
            <input type="tel" name="tell2" class="form-item-input-tel" placeholder="例：1234" value="{{ old('tell2') }}" /><span class="form-item-input-tel-span">ー</span>
            <input type="tel" name="tell3" class="form-item-input-tel" placeholder="例：5678" value="{{ old('tell3') }}" />
        </div>
        <div class="form__error">
            @error('tell1')
            {{ $message }}
            @enderror
            @error('tell2')
            {{ $message }}
            @enderror
            @error('tell3')
            {{ $message }}
            @enderror
        </div>
        <div class="form-item">
            <p class="form-item-label">
                住所<span class="form-item-label-required">※</span>
            </p>
            <input type="text" name="address" class="form-item-input" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}" />
        </div>
        <div class="form__error">
            @error('address')
            {{ $message }}
            @enderror
        </div>
        <div class="form-item">
            <p class="form-item-label">
                建物名
            </p>
            <input type="text" name="building" class="form-item-input" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building') }}" />
        </div>
        <div class="form-item">
            <p class="form-item-label">
                問い合わせの種類<span class="form-item-label-required">※</span>
            </p>
            <select class="form-item-input" name="category_id">
                <option value="">選択してください</option>
                @foreach ($categories as $category)
                <option value="{{ $category['id'] }}" {{ old('category_id') == $category['id'] ? 'selected' : '' }}>
                    {{ $category['content'] }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form__error">
            @error('category_id')
            {{ $message }}
            @enderror
        </div>
        <div class="form-item">
            <p class="form-item-label">
                問い合わせ内容<span class="form-item-label-required">※</span>
            </p>
            <textarea name="detail" class="form-item-textarea" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
        </div>
        <div class="form__error">
            @error('detail')
            {{ $message }}
            @enderror
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>

@endsection