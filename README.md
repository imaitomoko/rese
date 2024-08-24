# rese
ある企業のグループ会社の飲食店予約サービス
<img width="829" alt="スクリーンショット 2024-08-24 13 43 47" src="https://github.com/user-attachments/assets/55882cc1-c233-4422-a7ed-7710b4f45c84">

## 作成した目的
外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい。

## 機能一覧
ユーザー
　会員登録
　ログイン
　ログアウト
　お気に入り登録
　予約登録
　予約編集
　予約削除
　stripe決済機能
　レビュー登録
管理者
　ログイン
　オーナー登録
　一斉メール送信
オーナー
　ログイン
　店舗情報一覧
　店舗新規登録
　店舗編集
　予約一覧

## 使用技術
Laravel Framework 8.83.27

## テーブル設計
<img width="325" alt="スクリーンショット 2024-08-24 14 07 48" src="https://github.com/user-attachments/assets/052444c3-504e-494e-ba74-083b02fc1f67">
<img width="327" alt="スクリーンショット 2024-08-24 14 05 17" src="https://github.com/user-attachments/assets/10488717-f647-4683-bdc2-47bf36c52da1">

## ER図
<img width="400" alt="スクリーンショット 2024-08-15 15 15 45" src="https://github.com/user-attachments/assets/1e129dc3-687e-461c-86bf-d6d805a632a2">

# 環境構築
１リポジトリのクローン
　git clone https://github.com/imaitomoko/rese.git
  cd Rese
2 Composer依存パッケージのインストール
 composer install
3 環境ファイルの設定
　cp .env.example .env

　APP_NAME=Laravel
　APP_ENV=local
　APP_URL=http://localhost
　DB_CONNECTION=mysql
　DB_HOST=mysql
　DB_PORT=3306
　DB_DATABASE=laravel_db
　DB_USERNAME=laravel_user
　DB_PASSWORD=laravel_pass

４　アプリケーションキーの生成
　php artisan key:generate

５　データベースの設定とマイグレーション
　php artisan migrate
　php artisan db:seed

６　開発サーバーの起動
　php artisan serve


