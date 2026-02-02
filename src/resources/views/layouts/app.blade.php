<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PiGLy</title>
  <link rel="stylesheet" href="{{asset('css/common.css')}}">
  @yield('css')
</head>
<body class="app-body">
  <header class="header">
    <div class="header-logo">
      <h1 class="header-title">PiGLy</h1>
      <ul class="header-nav-btn">
        <li class="header-config"><a class="setting-btn" href="/weight_logs/goal_setting">目標体重設定</a></li>
        <li class="header-logout">
          <form class="header-logout-form" action="/logout" method="post">
            @csrf
            <button class="logout-btn" type="submit">ログアウト</button>
          </form>
        </li>
      </ul>
    </div>
  </header>
  <main class="main">
    @yield('contents')
  </main>
</body>
</html>
