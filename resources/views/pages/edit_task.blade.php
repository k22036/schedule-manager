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

        .temp-container,
        .create-container,
        .other-container {
            padding: 10px;
            overflow-y: auto;
        }

        .temp-container {
            width: 30%;
            border-right: 1px solid white;
        }

        .edit-container {
            width: 40%;
            border-right: 1px solid white;
            justify-content: center;
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
            background-color: white;
            color: black;
            border-radius: 5px;
            padding: 10px 20px;
            margin: 0 auto;
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

        .other-container {
            width: 30%;
        }

        #content-field {
            height: 100px;
        }
    </style>
</head>

<body>

    <div>
        <div class="main-container">
            <div class="temp-container"></div>

            <form class="edit-container" method="POST" action="{{ route('edit-content') }}">
                @csrf
                <div class="content-card">
                    <div>開始時間：</div>
                    <input type="datetime-local" name="begin" value="{{ $content->begin }}">
                </div>
                <div class="content-card">
                    <div>終了時間：</div>
                    <input type="datetime-local" name="end" value="{{ $content->end }}">
                </div>
                <div class="content-card">
                    <div>場所：</div>
                    <textarea name="place">{{ $content->place }}</textarea>
                </div>
                <div class="content-card">
                    <div>内容：</div>
                    <textarea name="content" id="content-field">{{ $content->content }}</textarea>
                </div>

                <input type="hidden" name="id" value="{{ $content->id }}">
                <div class="edit-button" onclick="event.preventDefault();this.closest('form').submit();">
                    <div>編集完了</div>
                </div>
            </form>

            <div class="other-container"></div>
        </div>
    </div>

</body>

</html>