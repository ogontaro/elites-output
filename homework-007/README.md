ELITES 課題007「サブクエリ」
===========================

## 課題内容
### 基本要件(必須)
下記のような売上情報を格納したテーブル`sales`と社員情報を格納したテーブル`members`が存在する。  
このとき、サブクエリや関数を用いて次のレコードを求めるようなSQL文を作成し、実行結果を確認せよ。  

1. 最大の売上を出した社員の名前
2. 売上の平均以上を達成した社員の名前
3. 30代以下の社員が達成した売上の合計

``` salesテーブル
member_id, sale, month
1 , 75 , 4
2 , 200 , 5
3 , 15 , 6
4 , 700 ,5
5 , 672 , 4
6 , 56 , 8
7 , 231 , 9
8 , 459 , 8
9 , 8 , 7
10 , 120 , 4 
```

``` membersテーブル
member_id, name 
1 , Tanaka
2 , Sato
3 , Suzuki
4 , Tsuchiya
5 , Yamada
6 , Sasaki
7 , Harada
8 , Takahashi
9 , Nishida
10 , Nakada
```

``` ageテーブル
member_id, age
1 , 24
2 , 25
3 , 47
4 , 55
5 , 39
6 , 26
7 , 43
8 , 33
9 , 24
10 , 20
```

## 達成状況
1 最大の売上を出した社員の名前  
クエリ
```
SELECT name AS '名前', sale AS '売上最高金額'
FROM sales
JOIN members 
ON sales.menber_id = members.menber_id
WHERE sale = (SELECT max(sale) FROM sales)
```

結果

|   名前   | 売上最高金額 |
| :------- | :----------- |
| Tsuchiya | 700          |

2 売上の平均以上を達成した社員の名前  
クエリ
```
SELECT name AS '名前', sale AS '売上金額'
FROM sales
JOIN members
ON sales.menber_id = members.menber_id
WHERE (SELECT AVG(sale) FROM sales) <= sale
```

結果

|    名前   | 売上最高金額 |
| :-------- | :----------- |
| Tsuchiya  | 700          |
| Yamada    | 672          |
| Takahashi | 459          |

3 30代以下の社員が達成した売上の合計  
クエリ
```
SELECT avg(sale) AS '売上平均金額'
FROM sales
JOIN members ON sales.menber_id = members.menber_id 
JOIN age ON age.menber_id = sales.menber_id
WHERE age <= 39  
```

結果

| 売上平均金額 |
| :----------- |
| 227.1429     |


## 補足
スキーマ定義と初期データのダンプ  
http://elites-ur.mydns.jp/homework-007/homework-007-database.sql

## 確認先
http://elites-ur.mydns.jp/homework-007/  
  
ID,PWは下記を参照  
https://github.com/ogontaro/elites-output/