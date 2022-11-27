<!-- <?php
var_dump($_SERVER);//$_SERVERの情報を出力
?> -->

<?php
define('ROOT_PATH', str_replace('public', '', $_SERVER["DOCUMENT_ROOT"]));
$parse = parse_url($_SERVER["REQUEST_URI"]);
// ファイル名が省略されていた場合、index.phpを補填する
if(mb_substr($parse['path'], -1) === "/"){
    $parse['path'] .= $_SERVER["SCRIPT_NAME"];
}
require_once(ROOT_PATH.'Views'.$parse['path']);

#define; 定義する
#str_replace(); 検索した文字列に一致した全ての文字列を置換する
#parse_url(); URL の様々な構成要素のうち特定できるものに関して 連想配列にして返す
#mb_substr();文字列の一部を抽出
# $a.=$b; 「$a = $a.$b」の代入演算子と同じ意味
#require_once("ファイルパス"); ファイルが既に読み込まれている場合は再読み込みしない
# $_SERVER; サーバー情報をとってくるphpが決めた関数

// アクセス制御
// 続いて「index.php」ファイルの中身を編集します。
// 左記のように、入力URLからViews配下の読み込むファイルを判定します。
// 例えば「localhost/Players/xxx.php」とすればViews/Players配下の「xxx.php」が読み込ます。
// Views配下にディレクトリやファイルが存在しない場合、requireによるエラーが発生します。
