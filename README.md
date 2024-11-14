# chat app

## Dockerを使って動かす

- Docker環境が必要です
- MAMPなどが動いていると競合する可能性があります

### ビルド

```zsh
make build
```

### アプリケーションの起動

```zsh
make start
```

- アプリケーションのリンク
- [http://0.0.0.0:8000/home](http://0.0.0.0:8000/home)

## cloneした場合

以下はこのプロジェクトのgithubのレポジトリです

こちらからクローンしてください

[https://github.com/k22036/schedule-manager](https://github.com/k22036/schedule-manager)

- .envを作成してください
- .envに.env.exampleの内容をコピーしてください

## 開発用

以下は開発用

### start

```zsh
php artisan serve
```

### DB migrate

```zsh
php artisan migrate
```

freshする場合

```zsh
php artisan migrate:fresh
```

## 利用技術

- Laravel Breeze

## 参考

## 課題
