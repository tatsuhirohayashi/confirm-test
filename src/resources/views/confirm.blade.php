@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')

<header class="header">
    <div class="header__inner">
        <a class="header__logo" href="/">
            FashionablyLate
        </a>
    </div>
</header>

<div class="confirm__content">
    <div class="confirm__heading">
        <h2>Confirm</h2>
    </div>
    <form class="form" action="/thanks" method="post">
        @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        <input type="text" name="last_name" class="confirm-table__text-name" value="{{ $contact['last_name'] }}" readonly />
                        <input type="text" name="first_name" class="confirm-table__text-name" value="{{ $contact['first_name'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text-gender">
                        <input type="hidden" name="gender" value="{{ $contact['gender'] }}" readonly />
                        <?php
                        if ($contact['gender'] == '1') {
                            echo '男性';
                        } else if ($contact['gender'] == '2') {
                            echo '女性';
                        } else if ($contact['gender'] == '3') {
                            echo 'その他';
                        }
                        ?>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        <input type="email" name="email" class="confirm-table__text-input" value="{{ $contact['email'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        <input type="tel" name="tell" class="confirm-table__text-input" value="{{ $contact['tell'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        <input type="text" name="address" class="confirm-table__text-input" value="{{ $contact['address'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        <input type="text" name="building" class="confirm-table__text-input" value="{{ $contact['building'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__text">
                        <input type="text" name="content" class="confirm-table__text-input" value="{{ $category['content']}}" readonly />
                        <input type="hidden" name="category_id" value="{{ $contact['category_id']}}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        <textarea type="text" name="detail" class="confirm-table__text-textarea" readonly>{{ $contact['detail'] }}</textarea>
                    </td>
                </tr>
            </table>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">送信</button>
            <a class="form__button-modification" type="button" onclick="history.back()">修正</a>
        </div>
    </form>
</div>

@endsection