<?php
/**
 * MySQLʾ����ͨ����ʾ������ϤBAEƽ̨MySQL��ʹ�ã�CRUD��
 */
require('configure.php');
mysql_query("set name 'UTF8'");

class database{
//使用该类时先调用start()连上数据库，再调用execute_sql($type, $sql)进行对数据库的各种操作。
//start()返回的$link最好用mysql_close($link)关闭，不关闭也可以。
	function start(){
		$dbname = MYSQLNAME;
		$host = 'localhost';
		$port = "3306";
		$user = 'root';
		$pwd = '';
		
		$link = mysql_connect($host . ":" . $port,$user,$pwd);
		if(!$link) {
			print("Connect Server Failed");
		    die("Connect Server Failed: " . mysql_error());
		}
		if(!mysql_select_db($dbname,$link)) {
			print("Select Database Failed");
		    die("Select Database Failed: " . mysql_error($link));
		}
		mysql_query("set name 'UTF8'");
		mysql_query("set character set 'UTF8'");
		return $link;
	}

	public function execute_sql($type, $sql){
		$result = -1;
		mysql_query("set name 'UTF8'");
		mysql_query("set character set 'UTF8'");
		switch($type){
		case "insert":
			$result = $this->_insert_data($sql);
			break;
		case "delete":
			$result = $this->_delete_data($sql);
			break;
		case "update":
			$result = $this->_update_data($sql);
			break;
		case"select":
			$result = $this->_select_data($sql);
			break;
		default:
			$result = "no execution";
		}
		return $result;
	}
	private function _insert_data($sql){
	      if(!mysql_query($sql)){
	        return 0;    //��������ʧ��
	
	    }else{
	          if(mysql_affected_rows()>0){
	              return 1;    //����ɹ�
	          }else{
	              return 2;    //û�����ܵ�Ӱ��
	          }
	    }
	}
	
	//ɾ������
	private function _delete_data($sql){
	      if(!mysql_query($sql)){
	        return 0;    //ɾ��ʧ��
	      }else{
	          if(mysql_affected_rows()>0){
	              return 1;    //ɾ���ɹ�
	          }else{
	              return 2;    //û�����ܵ�Ӱ��
	          }
	    }
	}
	
	//�޸�����
	private function _update_data($sql){
	      if(!mysql_query($sql)){
	        return 0;    //��������ʧ��
	    }else{
	          if(mysql_affected_rows()>0){
	              return 1;    //���³ɹ�;
	          }else{
	              return 2;    //û�����ܵ�Ӱ��
	          }
	    }
	}
	
	//��������
	private function _select_data($sql){
	    $ret = mysql_query($sql);
	    return $ret;
	}
}

?>