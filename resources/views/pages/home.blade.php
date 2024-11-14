<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム</title>

    <style>
        body {
            background: linear-gradient(90deg, rgba(233, 238, 242, 1) 0%, rgba(158, 184, 188, 1) 33%, rgba(132, 165, 169, 1) 66%, rgba(97, 139, 144, 1) 100%);
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            overflow: hidden;
        }

        .main-container {
            display: flex;
            height: 100vh;
        }

        .user-container,
        .schedule-container,
        .other-container {
            padding: 10px;
            overflow-y: auto;
        }

        .user-container {
            width: 30%;
            border-right: 1px solid white;
        }

        .schedule-container {
            width: 40%;
            border-right: 1px solid white;
        }

        .other-container {
            width: 30%;
        }

        .header {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 1.2em;
        }

        .user-card,
        .task-card {
            display: flex;
            background-color: white;
            border-radius: 10px;
            height: 60px;
            margin-bottom: 10px;
            padding: 10px;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .active {
            background-color: aqua;
        }

        .create-card {
            display: inline-block;
            background-color: white;
            color: black;
            border-radius: 5px;
            height: auto;
            padding: 10px 20px;
            margin-bottom: 10px;
            text-align: center;
            text-decoration: none;
            font-size: 1em;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, transform 0.3s;
            cursor: pointer;
        }

        .content-card {
            display: flex;
            flex-direction: column;
            background-color: white;
            border-radius: 10px;
            margin-bottom: 10px;
            padding: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }

        .edit-button {
            display: flex;
            flex-direction: column;
            background-color: white;
            color: black;
            border-radius: 5px;
            padding: 10px 20px;
            margin-bottom: 10px;
            text-align: center;
            justify-content: center;
            text-decoration: none;
            font-size: 1em;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, transform 0.3s;
            cursor: pointer;
        }

        .edit-button:hover {
            background-color: #f0f0f0;
        }

        .delete-button {
            display: flex;
            flex-direction: column;
            background-color: red;
            color: black;
            border-radius: 5px;
            padding: 10px 20px;
            text-align: center;
            justify-content: center;
            text-decoration: none;
            font-size: 1em;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, transform 0.3s;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #e57373;
        }

        .user-card:hover,
        .task-card:hover,
        .create-card:hover {
            background-color: #f0f0f0;
        }

        .img-container {
            width: 50px;
            height: 50px;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-image {
            border-radius: 20px;
            width: 50px;
            height: 50px;
        }

        .title-container {
            flex-grow: 1;
            display: flex;
            align-items: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .logout-container,
        .profile {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            cursor: pointer;
        }

        .profile:hover {
            background-color: #f0f0f0;
        }

        .logout-container:hover {
            background-color: #f0f0f0;
        }

        .logout-text {
            margin-right: 10px;
        }

        .logout-icon svg {
            width: 20px;
            height: 20px;
            fill: #333;
        }

        /* スクロールバーのスタイル */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.4);
        }

        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }
    </style>
</head>

<body>

    <div class="main-container">
        <div class="user-container">
            <div class="header">スケジュール</div>
            <div class="create-card" onclick="window.location='{{ route('add-content') }}';">
                <div>新規作成</div>
            </div>
            @foreach ($contents as $content)
            <form method="POST" action="{{ route('home') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $content->id }}">
                <div class="task-card {{ isset($active) && $active == $content->id ? 'active' : '' }}" onclick="event.preventDefault();this.closest('form').submit();">
                    <div class="title-container">
                        <div>{{ $content->content }}</div>
                    </div>
                </div>
            </form>
            @endforeach
        </div>
        <div class="schedule-container">

            @if (isset($target_content))
                <div class="content-card">
                    <div>開始時間：</div>
                    <div>{{ $target_content->begin }}</div>
                </div>
                <div class="content-card">
                    <div>終了時間：</div>
                    <div>{{ $target_content->end }}</div>
                </div>
                <div class="content-card">
                    <div>場所：</div>
                    <div>{{ $target_content->place }}</div>
                </div>
                <div class="content-card">
                    <div>内容：</div>
                    <div>{{ $target_content->content }}</div>
                </div>

                <form class="edit-container" method="GET" action="{{ route('edit') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $target_content->id }}">
                    <div class="edit-button" onclick="event.preventDefault();this.closest('form').submit();">
                        <div>編集</div>
                    </div>
                </form>

                <form method="POST" action="{{ route('delete-content') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $target_content->id }}">
                    <div class="delete-button" onclick="event.preventDefault();this.closest('form').submit();">
                        <div>削除</div>
                    </div>
                </form>
            @endif

        </div>
        <div class="other-container">
            <div class="profile" onclick="window.location='{{ route('profile.edit') }}';">
                {{ Auth::user()->name }}
                {{ __('(Profile)') }}
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <div class="logout-container" onclick="event.preventDefault();this.closest('form').submit();">

                    <div class="logout-text">ログアウト</div>
                    <div class="img-container logout-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                        </svg>
                    </div>

                </div>
            </form>
        </div>
        
    </div>

</body>

</html>