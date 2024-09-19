Makeshop apps用Webhook
==========

## インストール方法
公開ページのディレクトリに`webhook`ディレクトリを作成し、`webhook`配下に`uninstall.php`と`install.php`を配置してください。

```
webhook/
  ├  install.php
  └  uninstall.php
```

## 利用方法
以下の形式でのリクエスト内容を表示し、同ディレクトリに結果を出力します。  

### インストールWebhook
- メソッド : POST
- データ形式 : application/json
- リクエストボディ(JSON)
    - app_id : アプリID
    - plan_id : プランID
    - app_name : アプリ名
    - shop_id : ショップID
    - token : 永続トークン
- 出力ファイル : `install_[YYYYMMDD]_[HHMMSS]_[uuid4].txt`

#### curlでの実行例
```
$ curl http://localhost/webhook/install.php -i -X POST -d "{\"app_id\":\"app_id_str\",\"app_name\":\"app_name_str\",\"plan_id\":\"plan_id_str\",\"shop_id\":\"shop_id_str\",\"token\":\"token_str\"}"
```

#### 出力ファイル例
```
# install_20240919_121126_3ccf5bd6-e66d-4b20-bae9-c2bd402df9ef.txt

app_id : app_id_str
plan_id : app_name_str
app_name : plan_id_str
shop_id : shop_id_str
token : token_str
```

### アンインストールWebhook
- メソッド : POST
- データ形式 : application/json
- リクエストボディ(JSON)
    - app_id : アプリID
    - app_name : アプリ名
    - shop_id : ショップID
- 出力ファイル : `uninstall_[YYYYMMDD]_[HHMMSS]_[uuid4].txt`

#### curlでの実行例
```
$ curl http://localhost/webhook/uninstall.php -i -X POST -d 
"{\"app_id\":\"app_id_str\",\"app_name\":\"app_name_str\",\"shop_id\":\"shop_id_str\"}"
```

#### 出力ファイル例
```
# uninstall_20240919_121215_33b6c796-9bf8-4348-b7b9-a4abbc6f5167.txt

app_id : app_id_str
plan_id : 
app_name : plan_id_str
shop_id : shop_id_str
token : 
```
