<?php
$str_extententionPath = dirname(__FILE__) . "/Counter.php";
require_once $str_extententionPath;
/**
 * 画像アクセスカウンタ Counterクラスを継承
 * 
 * @author VM
 */
class ImageCounter extends Counter {
	// 利用可能な拡張子
	const IMAGE_EXTENTIONS = ".{jpg,png,img}";
	// 画像ファイルのあるディレクトリパス
	private $str_imgDir;
	// 取得した画像ファイルの拡張子
	private $str_imgExtension;
	/**
	 * コンストラクタ <br>&emsp;
	 * void __construct($str_imgDirName = "CounterImg", $str_counterFileDir = "./")
	 *
	 * @param String $str_imgDirName
	 *        	画像ファイルのあるディレクトリ名 このファイル直下に配置すること 画像ファイル名は [0-9].{jpg,png,img}
	 * @param String $str_counterFileDir
	 *        	カウンタファイルのあるディレクトリパス、デフォルトはルートディレクトリ
	 */
	function __construct($str_imgDirName = "ImageCounter_Images", $str_counterFileDir = "./") {
		// 画像ファイルのアドレス
		$str_imagesPath = dirname(__FILE__) . "/" . $str_imgDirName;
		// 末尾の / を調整
		$this -> str_imgDir = rtrim($str_imagesPath, "/") . "/";
		if(! file_exists($this -> str_imgDir)){
			die("Not found ImageDirectry. <br>\n" . $this -> str_imgDir);
		}
		$arr_str_imgFiles = glob($this -> str_imgDir . '[0-9]' . self :: IMAGE_EXTENTIONS, GLOB_BRACE);
		for($i = 0; $i < 9; $i++){
			if(intval(substr($arr_str_imgFiles[$i], - 5, 1)) != $i){
				die("Error ImageFiles.");
			}
		}
		// 画像ファイルの拡張子を抽出
		$this -> str_imgExtension = substr($arr_str_imgFiles[0], - 4);
		parent :: __construct("./");
	}
	/**
	 * カウンタイメージの HTMLタグ を出力
	 *
	 * @param $int_length <a>
	 *        	: 指定桁数を"0" で穴埋めして取得。 0 で全桁取得。
	 */
	function Echo_HTML_CountImage($int_length = 0) {
		echo $this -> Get_str_CountImage($int_length);
	}
	/**
	 * カウンタイメージの HTMLタグ を取得
	 *
	 * @param $int_length <a>
	 *        	: 指定桁数を"0" で穴埋めして取得。 0 で全桁取得。
	 * @param $int_width <a>
	 *        	: 各桁の幅(単位=px) 0 で元画像のまま出力。
	 * @param $int_height <a>
	 *        	: 高さ(単位=px) 0 で元画像のまま出力。
	 * @return String
	 */
	function Get_str_CountImage($int_length = 0, $int_width = 0, $int_height = 0) {
		// 0で穴埋め
		$count = str_pad($this -> int_count, $int_length, "0", STR_PAD_LEFT);
		// 配列に変換
		$count = str_split($count);
		
		// 幅高さ
		$str_width = "";
		$str_height = "";
		if(0 < $int_width){
			$str_width = "width='$int_width'";
		}
		if(0 < $int_height){
			$str_height = "height='$int_height'";
		}
		
		// 文字列作成
		$result = "";
		foreach($count as $num){
			$result .= "<img src='{$this->str_imgDir}{$num}{$this->str_imgExtension}' $str_width $str_height>";
		}
		// ルートからのパスに書き換え
		$result = str_replace("\\", "/", $result);
		$result = str_replace(dirname($_SERVER['SCRIPT_FILENAME']), ".", $result);
		return $result;
	}
}