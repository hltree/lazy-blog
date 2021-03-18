# MySite

## About

This is Mysite Project

## Requirements

Python v3.7.4
<br />
Pipenv v2018.11.26
<br />
Other.. look at Pipfile.lock

## Usage

1. pipenvを初期化
```
$ pipenv install
```

2. pipenvで仮想環境を立ち上げる
```
$ pipenv run dev
```

3. 仮想環境に入って、マイグレートする
```
$ pipenv shell
$ python manage.py migrate
```

4. 管理者ユーザーを作成する

```
$ python manage.py createsuperuser
```

対話式でいくつか質問されるので、それに答える。
（ユーザー名やパスワードなどを入力します）

5. static環境をビルドする

```
$ cd ./static
$ npm i && npm run build
```

**仮想環境から出て行ってください**

## Memo

お役立ちメモ程度

### DBの構造を変更する

1. model.pyで構造を変更
2. `python manage.py makemigrations` でモデル情報をマイグレーションファイルとして作成
3. `python manage.py migrate` でマイグレート
