<?php
require_once './Classes/Counter/Counter.php';
class ImageCounter extends Counter {
	const IMAGE_EXTENTIONS = ".{jpg,png,img}";
	private $str_imgDir;
	private $str_imgExtension;
	/**
	 * @画像アクセスカウンタ
	 * Counterクラスを継承
	 * @
	 * @コンストラクタ
	 * void __construct($str_fileDir = "./", $str_imgDirName = "CounterImg")
	 * String $str_fileDir カウンタファイルのあるディレクトリ
	 * String $str_imgDirName 画像ファイルのあるディレクトリ名 $str_fileDir の下に配置すること
	 * @
	 * @カウント数を取得
	 * parent int Get_int_Count()
	 * @
	 * @画像カウントの imgタグ を取得
	 * String Get_HTMLTag_CountImage()
	 */
	function __construct($str_fileDir = "./", $str_imgDirName = "CounterImg") {
		$str_imgDirName = rtrim($str_imgDirName, "/") . "/";
		$this -> str_imgDir = $str_fileDir . $str_imgDirName; // __DIR__ . "\\" . $str_imgDirName . "\\";
		if(! file_exists($this -> str_imgDir)){
			die("not found ImageDirectry. <br>\n" . $this -> str_imgDir);
		}
		$arr_str_imgFiles = glob($this -> str_imgDir . '[0-9]' . self :: IMAGE_EXTENTIONS, GLOB_BRACE);
		for($i = 0; $i < 9; $i++){
			if(intval(substr($arr_str_imgFiles[$i], - 5, 1)) != $i){
				die("error");
			}
		}
		$this -> str_imgExtension = substr($arr_str_imgFiles[0], - 4);
		parent :: __construct($str_fileDir);
	}
	function Get_HTMLTag_CountImage() {
		$count = str_split($this -> int_count);
		$result = "";
		foreach($count as $num){
			$result .= "<img src='{$this->str_imgDir}{$num}{$this->str_imgExtension}'>";
		}
		return $result;
	}
}