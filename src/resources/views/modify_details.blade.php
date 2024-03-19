<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="{{ asset('css/modify_details.css') }}">
</head>

<h1>店舗作成</h1>


@section('title', 'add.blade.php')

@section('content')

@if(session()->has('message'))
<div>{{ session('message') }}</div>
@endif

<form action="/modify_details" method="post" enctype="multipart/form-data">
    @csrf
    <table>
        <tr>
            <th>店舗名</th>
            <td><input type="text" name="shop_name"></td>
        </tr>
        <tr>
            <th>店舗の写真</th>
            <td><input type="file" name="document" class="form-control"></td>
        </tr>
        <tr>
            <th>都道府県</th>
            <td>
                <select name="prefecture_id" class="select-prefecture">
                    @foreach ($prefectures as $prefecture)
                    <option value="{{ $prefecture->id }}">{{ $prefecture->prefecture_name }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <th>ジャンル</th>
            <td>
                <select name="genre_id" class="select-genre">
                    @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <th>店舗概要</th>
            <td><input type="text" name="shop_overview"></td>
        </tr>
        <tr>
            <th></th>
            <td><button type="submit">送信</button></td>
        </tr>
    </table>
</form>