<?php
class Counter {
	private $str_fileName = "_A_COUNT.txt";
	protected $str_fileDir;
	protected $int_count;
	/**
	 * @アクセスカウンタ
	 * @インスタンス時にカウントアップ
	 * @
	 * @コンストラクタ
	 * @void __construct($str_fileDir = "./")
	 * @ String $str_fileDir カウンタファイルのあるディレクトリ、デフォルトはルートディレクトリ
	 * @
	 * @カウント数を取得
	 * @int Get_int_Count()
	 */
	function __construct($str_fileDir = "./") {
		$this -> str_fileDir = rtrim($str_fileDir, "/") . "/";
		if(! file_exists($this -> str_fileDir)){
			die("not found directry.<br>\n" . $this -> str_fileDir);
		}
		try{
			if(! file_exists($this -> str_fileDir . $this -> str_fileName)){
				if(false === @file_put_contents($this -> str_fileDir . $this -> str_fileName, "0")){
					die("failed make file.<br>\n" . $this -> str_fileDir . $this -> str_fileName);
				}
			}
			$this -> int_count = (intval(file_get_contents($this -> str_fileDir . $this -> str_fileName)));
			$this -> int_count++;
			if(false === @file_put_contents($this -> str_fileDir . $this -> str_fileName, $this -> int_count)){
				die("failed update file.<br>\n" . $this -> str_fileDir . $this -> str_fileName);
			}
		}catch(exeption $e){
			echo $e;
		}
	}
	function Get_int_Count() {
		return $this -> int_count;
	}
}