<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>


@can('access-admin')

<h1>管理者ページ</h1>
@else

<p>権限がありません。</p>
@endcan