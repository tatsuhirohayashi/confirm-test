@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
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
            <a class="header__logo" href="/admin">
                FashionablyLate
            </a>
            <nav>
                <ul class="header-nav-1">
                    <form class="form-logout" action="/logout" method="post">
                        @csrf
                        <li class="header-nav__item-1">
                            <button class="header-nav__link-1" type="submit">logout</button>
                        </li>
                    </form>
                </ul>
            </nav>
        </div>
    </div>
</header>

<div class="admin__content">
    <div class="admin__heading">
        <h2>Admin</h2>
    </div>
    <div class="search">
        <form class="search-form" action="/search" method="get">
            <div class="search-form__item">
                <input class="search-form__item-keyword" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="名前やメールアドレスを入力してください">
                <select class="search-form__item-gender" name="gender">
                    <option value="">性別</option>
                    <option value="all">全て</option>
                    <option value="1">男性</option>
                    <option value="2">女性</option>
                    <option value="3">その他</option>
                </select>
                <select class="search-form__item-contact" name="category_id">
                    <option value="">お問い合わせの種類</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
                    @endforeach
                </select>
                <input class="search-form__item-date" type="date" name="created_at" value="{{ old('created_at') }}">
                <div class="search-form__button">
                    <button class="search-form__button-submit" type="submit">検索</button>
                </div>
                <div class="search-form__reset">
                    <a class="search-form__button-reset" href="/admin">リセット</a>
                </div>
            </div>
        </form>
    </div>
    <div class="export-paginate">
        <div class="export">
            <form class="form-export" action="{{ $search ? '/exportsearch' : '/export' }}" method="post">
                @csrf
                <button class="export-button" type="submit">エクスポート</button>
                <input type="hidden" name="created_at" value="{{ request('created_at') }}">
                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                <input type="hidden" name="gender" value="{{ request('gender') }}">
                <input type="hidden" name="keyword" value="{{ request('keyword') }}">
            </form>
        </div>
        <div class="paginate">
            {{ $contacts->appends(request()->query())->links('vendor.pagination.custom') }}
        </div>
    </div>
    <div class="contact-table">
        <table class="contact-table__inner">
            <tr class="contact-table__row">
                <th class="contact-table__header">
                    <div class="contact-table__header-div">お名前</div>
                    <div class="contact-table__header-div2">性別</div>
                    <div class="contact-table__header-div3">メールアドレス</div>
                    <div class="contact-table__header-div4">お問い合わせの種類</div>
                    <div class="contact-table__header-div5"></div>
                </th>
            </tr>
            @foreach ($contacts as $contact)
            <tr class="contact-table__row">
                <form class="form-contact" action="#modal_{{ $contact['id'] }}" method="get">
                    <td class="contact-table__item">
                        <div class="contact-form__item-name">
                            <p class="contact-form__itme-p">{{ $contact['last_name'] }}</p>　
                            <p class="contact-form__itme-p">{{ $contact['first_name'] }}</p>
                            <input type="hidden" name="id" value="{{ $contact['id'] }}">
                        </div>
                        <div class="contact-form__item-gender">
                            <input class="contact-form__itme-input" type="hidden" name="gender" value="{{ $contact['gender'] }}" readonly>
                            <?php
                            if ($contact['gender'] == '1') {
                                echo '男性';
                            } else if ($contact['gender'] == '2') {
                                echo '女性';
                            } else if ($contact['gender'] == '3') {
                                echo 'その他';
                            }
                            ?>
                        </div>
                        <div class="contact-form__item">
                            <p class="contact-form__itme-p">{{ $contact['email'] }}</p>
                        </div>
                        <div class="contact-form__item">
                            <p class="contact-form__itme-p">{{ $contact['category']['content'] }}</p>
                        </div>
                        <div class="contact-form__button">
                            <a href="#modal_{{ $contact['id'] }}" class="contact-form__button-submit">詳細</a>
                        </div>
                    </td>
                </form>
            </tr>
            @endforeach
        </table>
    </div>
</div>

@foreach ($contacts as $contact)
<div class="modal" id="modal_{{ $contact['id'] }}">
    <form class="form" action="/delete" method="post">
        @method('DELETE')
        @csrf
        <a href="#!" class="modal-overlay"></a>
        <div class="modal-close-round">
            <a href="#!" class="modal-close">×</a>
        </div>
        <div class="form-item">
            <p class="form-item-label">
                お名前
            </p>
            <input type="text" name="last_name" class="form-item-input-name" value="{{ $contact['last_name'] }}" readonly />　
            <input type="text" name="first_name" class="form-item-input-name-1" value="{{ $contact['first_name'] }}" readonly />
            <input type="hidden" name="id" value="{{ $contact['id'] }}">
        </div>
        <div class="form-item">
            <p class="form-item-label">
                性別
            </p>
            <input type="hidden" name="gender" class="form-item-input" value="{{ $contact['gender'] }}" readonly />
            <div class="form-item-gender">
                <?php
                if ($contact['gender'] == '1') {
                    echo '男性';
                } else if ($contact['gender'] == '2') {
                    echo '女性';
                } else if ($contact['gender'] == '3') {
                    echo 'その他';
                }
                ?>
            </div>
        </div>
        <div class="form-item">
            <p class="form-item-label">
                メールアドレス
            </p>
            <input type="email" name="email" class="form-item-input" value="{{ $contact['email'] }}" readonly />
        </div>
        <div class="form-item">
            <p class="form-item-label">
                電話番号
            </p>
            <input type="tel" name="tel" class="form-item-input" value="{{ $contact['tell'] }}" readonly />
        </div>
        <div class="form-item">
            <p class="form-item-label">
                住所
            </p>
            <input type="text" name="address" class="form-item-input" value="{{ $contact['address'] }}" readonly />
        </div>
        <div class="form-item">
            <p class="form-item-label">
                建物名
            </p>
            <input type="text" name="building" class="form-item-input" value="{{ $contact['building'] }}" readonly />
        </div>
        <div class="form-item">
            <p class="form-item-label">
                問い合わせの種類
            </p>
            <input type="text" name="category_id" class="form-item-input" value="{{ $contact['category']['content'] }}" readonly />
        </div>
        <div class="form-item-contact">
            <p class="form-item-label">
                問い合わせ内容
            </p>
            <textarea type="text" name="detail" class="form-item-textarea" readonly>{{ $contact['detail'] }}</textarea>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">削除</button>
        </div>
    </form>
</div>
@endforeach

@endsection