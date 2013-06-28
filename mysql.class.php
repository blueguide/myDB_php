<?php
/**
 * 
 * php Mysql通用类
 * @author BlueguideLong Email: Blueguide@163.com
 * @version 1.0.0
 *
 */
class DB_mysql{
	
	public $DbLink;
	public $DbQuery;
	protected $DbSqlStr="";
	protected $DbFormat;
	
	function __construct($db_host,$db_username,$db_password,$db_database,$db_charset="utf-8",$pconnect=0){
		$this->connection($db_host, $db_username, $db_password, $db_database, $db_charset);
	}

	function connection($db_host,$db_username,$db_password,$db_database,$db_charset,$pconnect=0){ 

		$this->DbLink=@mysql_connect($db_host,$db_username,$db_password) or die("数据库链接错误");
		if(!@mysql_select_db($db_database)){
			echo "数据库不可用！";
		}
		mysql_set_charset($db_charset,$this->DbLink);
	}

	/**
	 * 
	 * 查询 和普通SQL相同
	 * @param string $from
	 * @param string $select
	 * @param string $where
	 * @param string $orderby
	 * @param string $order
	 * @param string $limit_start
	 * @param string $limit_end
	 * @return Ambigous <string, multitype:>
	 */
	function select($from,$select,$where="",$orderby="",$order="",$limit_start="",$limit_end=""){
		$this->SEL_str($from,$select,$where,$orderby,$order,$limit_start,$limit_end);
		$selResult=$this->formatResult($this->query($this->DbSqlStr),$this->DbFormat);
		return $selResult;
	}
	
	/**
	 * 
	 * 格式化返回内容
	 * @param string $result 查询结果集
	 * @param string $format 参数格式 json或者数组
	 */
	function formatResult($result,$format){
		while($row=mysql_fetch_array($result,MYSQL_ASSOC)){
			$ResultArray[]=$row;
		}
		$result="";
		switch ($format) {
			case "JSON":$result=json_encode($ResultArray);break;
			default:$result=$ResultArray;break;
		}
		return $result;
	}
	
	/**
	 * 
	 * 插入  和普通插入操作一样
	 * @param string $table 表
	 * @param string $cols 列
	 * @param string $values 数据 格式和SQL相同，以逗号隔开
	 */
	function insert($table,$cols,$values){
		$this->INS_str($table,$cols,$values);
		$this->query($this->DbSqlStr);
	}
	
	/**
	 * 
	 * 保存 将数据保存如数据库
	 * @param string $table 表
	 * @param array $values 插入到表中的数据的数组，其中key为字段名称，value为值
	 */	
	function save($table,$values){
		$this->INS_str($table,$values);
		$this->query($this->DbSqlStr);
	}
	
	/**
	 * 
	 * 更新 更新数据用
	 * @param string $table
	 * @param string $set
	 * @param string $where
	 */
	function update($table,$set,$where){
		$this->Upd_str($table,$set,$where);
		$this->query($this->DbSqlStr);
	}
	
	/**
	 * 
	 * 删除 删除数据
	 * @param string $table
	 * @param string $where
	 */
	function delete($table,$where){
		$this->Del_str($table,$where);
		$this->query($this->DbSqlStr);
	}
	
	function close(){
		mysql_close($this->DbLink);
	}
	
	public function setDbFormat($format){
		$this->DbFormat=$format;
	}
	
	public function getDbFormat(){
		return $this->DbFormat;
	}
	
	public function getSqlStr(){
		return $this->DbSqlStr;
	}
	/**
	 * 
	 * 执行SQL语句
	 * @param string $sql
	 */	
	function query($sql){
		$this->DbQuery=@mysql_query($sql,$this->DbLink);
		return $this->DbQuery;
	}
	
    function free_result($query_id)
    {
         @mysql_free_result($query_id);
    }
	/**
	 * 
	 * 查询语句生成方法
	 */
	protected function SEL_str(){
		$argnum=func_num_args();
		$args=func_get_args();
		$this->DbSqlStr="SELECT ";
		if($argnum>1 && $args[1]) $this->DbSqlStr=$this->DbSqlStr.$args[1];
		if($argnum>0 && $args[0]) $this->DbSqlStr=$this->DbSqlStr.(($argnum==1 OR $args[1]=="")?" * FROM ".$args[0]:" FROM ".$args[0]);
		if($argnum>2 && $args[2]) $this->DbSqlStr=$this->DbSqlStr." WHERE ".$args[2];
		if($argnum>3 && $args[3]) $this->DbSqlStr=$this->DbSqlStr." ORDER BY ".$args[3];
		if($argnum>4 && $args[4]) $this->DbSqlStr=$this->DbSqlStr." ".($args[4]=="DESC"?"DESC":"ASC");
		if($argnum>6 && $args[6]) $this->DbSqlStr=$this->DbSqlStr." LIMIT ".($args[5]==""?"0":$args[5]).",".$args[6];
	}
	/**
	 * 
	 * 生成插入语句的方法
	 */
	protected function INS_str(){
		$argnum=func_num_args();
		$args=func_get_args();
		switch ($argnum) {
			case 2:{
				$this->DbSqlStr="INSERT INTO ";
				$this->DbSqlStr=$this->DbSqlStr.$args[0];
				$cols="";$values="";
				foreach ($args[1] as $key=>$value){
					$cols=(!$cols)?$key:$cols.",".$key;
					$values=(!$values)?$value:$values.",".$value;
				}
				$this->DbSqlStr=$this->DbSqlStr." (".$cols.") "." VALUES(".$values.")";
			}break;
			case 3:{
				$this->DbSqlStr="INSERT INTO ";
				if($argnum>0 && $args[0]) $this->DbSqlStr=$this->DbSqlStr.$args[0];
				if($argnum>1 && $args[1]) $this->DbSqlStr=$this->DbSqlStr." (".$args[1].")";
				if($argnum>2 && $args[2]) $this->DbSqlStr=$this->DbSqlStr." VALUES(".$args[2].")";
			}break;
			default:{
				
			}break;
		}	
	}
	/**
	 * 
	 * 生成删除语句的方法
	 */
	protected function Del_str(){
		$argnum=func_num_args();
		$args=func_get_args();
		$this->DbSqlStr="DELETE FROM ";
		if($argnum>0 && $args[0]) $this->DbSqlStr=$this->DbSqlStr.$args[0];
		if($argnum>1 && $args[1]) $this->DbSqlStr=$this->DbSqlStr." WHERE ".$args[1];
	}
	/**
	 * 
	 * 生成更新语句的方法
	 */
	protected function Upd_str(){
		$argnum=func_num_args();
		$args=func_get_args();
		$this->DbSqlStr="UPDATE ";
		if($argnum>0 && $args[0]) $this->DbSqlStr=$this->DbSqlStr.$args[0];
		if($argnum>1 && $args[1]) $this->DbSqlStr=$this->DbSqlStr." SET ".$args[1];
		if($argnum>2 && $args[2]) $this->DbSqlStr=$this->DbSqlStr." WHERE ".$args[2];
	}
}	
