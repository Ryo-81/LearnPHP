<?php
/**
 * アクセスカウンタ<br>
 * インスタンス時にカウントアップ
 * @author VM
 */
class Counter {
	// カウントデータファイル名
	private $str_fileName = "_A_COUNT.txt";
	// アクセスカウント
	protected $int_count;
	
	/**
	 * コンストラクタ<br>&emsp
	 * void __construct($str_fileDir = "./")
	 *
	 * @param String $str_fileDir
	 *        	カウンタファイルのあるディレクトリ、デフォルトはルートディレクトリ
	 */
	function __construct($str_fileDir = "./") {
		$str_fileDir = rtrim($str_fileDir, "/") . "/";
		if(! file_exists($str_fileDir)){
			die("not found directry.<br>\n" . $str_fileDir);
		}
		try{
			if(! file_exists($str_fileDir . $this -> str_fileName)){
				if(false === @file_put_contents($str_fileDir . $this -> str_fileName, "0")){
					die("failed make file.<br>\n" . $str_fileDir . $this -> str_fileName);
				}
			}
			$this -> int_count = (intval(file_get_contents($str_fileDir . $this -> str_fileName)));
			$this -> int_count++;
			if(false === @file_put_contents($str_fileDir . $this -> str_fileName, $this -> int_count)){
				die("failed update file.<br>\n" . $str_fileDir . $this -> str_fileName);
			}
		}catch(exeption $e){
			echo $e;
		}
	}
	/**
	 * アクセス数を取得
	 *
	 * @return Integer
	 */
	function Get_int_Count() {
		return $this -> int_count;
	}
}