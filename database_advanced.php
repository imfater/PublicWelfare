 <?php
require('database_basic.php');
date_default_timezone_set('PRC');
mysql_query("set name 'UTF8'");

class memberDB
{
	public function change_point_less($userId)
	{
		$text = "update member set point=point-1 where userid = '%s'";
		$sql = sprintf($text, $userId);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("update", $sql);
		mysql_close($link);
		return $result;
	}
	
	public function change_point_more($memberid)
	{
		$text = "update member set point=point+2 where id = %s";
		$sql = sprintf($text, $memberid);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("update", $sql);
		mysql_close($link);
		return $result;
	}
	
	public function select_member_by_userId($userId)
	{
		$text = "select * from member where userid = '%s'";
		$sql = sprintf($text, $userId);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("select", $sql);
		mysql_close($link);
		return $result;
	}
	
	
	public function check_point($userid)
	{
		$text = "select point from member where userid = '%s'";
		$sql = sprintf($text, $userid);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("select", $sql);
		mysql_close($link);
		return $result;
	}
	public function select_all_member_message()
	{
		$text = "select * from member order by point desc,account desc,evaluation desc";
		$sql = sprintf($text);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("select", $sql);
		mysql_close($link);
		return $result;
	}
	
	public function select_member_by_Id($Id)
	{
		$text = "select * from member where id = %s";
		$sql = sprintf($text, $Id);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("select", $sql);
		mysql_close($link);
		return $result;
	}
	
	public function update_message($userId,$nickname,$phone,$qq)
	{
		$text = "update member set nickname='%s',phone='%s',qq='%s'where userid='%s'";
		$sql = sprintf($text, $nickname, $phone, $qq,$userId);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("update", $sql);
		mysql_close($link);
		return $result;
	}
	
	public function update_all_message($userId,$nickname,$phone,$qq,$point)
	{
		$text = "update member set nickname='%s',phone='%s',qq='%s' point='%s' where userid='%s'";
		$sql = sprintf($text, $nickname, $phone, $qq,$point,$userId);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("update", $sql);
		mysql_close($link);
		return $result;
	}
	
	public function get_memberid_by_userid($userId)
	{
		$text = "select id from member where userid = '%s'";
		$sql = sprintf($text, $userId);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("select", $sql);
		mysql_close($link);
		return $result;
	}
	
	public function find_the_same_nickname($nickname)
	{
		$text = "select nickname from member where nickname = '%s'";
		$sql = sprintf($text, $nickname);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("select", $sql);
		mysql_close($link);
		return $result;
	}
	
	
	public function insert_message($userId,$nickname,$phone,$qq)
	{
		$text = "insert member set nickname='%s',phone='%s',qq='%s' where userid='%s'";
		$sql = sprintf($text, $nickname, $phone, $qq, $userId);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("insert", $sql);
		mysql_close($link);
		return $result;
	}
	
	public function set_new_evaluation($memberid, $newEvaluation,$newAccount)
	{
		$text = "update member set evaluation=%s,account=%s where id='%s'";
		$sql = sprintf($text, $newEvaluation,$newAccount,$memberid);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("update", $sql);
		mysql_close($link);
		return $result;
	}
	
	public function delete_member_by_userid($userid)
	{
		$text = "delete from member where userid = '%s'";
		$sql = sprintf($text, $userid);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("delete", $sql);
		mysql_close($link);
	}
	
}

class missionDB
{
	public function select_mission_by_userId($userId)
	{
		$text = "select * from mission where userid = '%s'";
		$sql = sprintf($text, $userId);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("select", $sql);
		mysql_close($link);
		return $result;
	}
	
	public function check_my_mission($missionid,$userid)
	{
		$text = "select * from mission where id = %s and userid='%s' ";
		$sql = sprintf($text, $missionid,$userid);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("select", $sql);
		mysql_close($link);
		return $result;
	}
	
	
	public function select_mission_by_id($id)
	{
		$text = "select * from mission where id = %s";
		$sql = sprintf($text, $id);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("select", $sql);
		mysql_close($link);
		return $result;
	}
	
	public function select_mission_by_missionId($missionid)
	{
		$text = "select * from mission where id = %s";
		$sql = sprintf($text, $missionid);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("select", $sql);
		mysql_close($link);
		return $result;
	}
	
	public function update_mission_state($missionid)
	{
		$text = "update mission set missionstate='off' where id= %s";
		$sql = sprintf($text, $missionid);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("update", $sql);
		mysql_close($link);
		return $result;
	}
	
	public function update_mission_state_selected($missionid)
	{
		$text = "update mission set missionstate='selected' where id= %s";
		$sql = sprintf($text, $missionid);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("update", $sql);
		mysql_close($link);
		return $result;
	}
	
	public function insert_new_mission($userid,$tagname,$title,$content,$peoplenum)
	{
		$text = "insert mission set userid='%s',tagname='%s',title='%s',content='%s',peoplenum=%s ";
		$sql = sprintf($text, $userid,$tagname,$title,$content,$peoplenum);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("insert", $sql);
		mysql_close($link);
		return $result;
	}
	
	public function select_all_mission()
	{
		$sql = "select * from mission";
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("select", $sql);
		mysql_close($link);
		return $result;
	}
	
	public function delete_mission_by_id($id)
	{
		$sql = "delete from mission where id = %s";
		$sql = sprintf($sql, $id);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("delete", $sql);
		mysql_close($link);
	}
}

class missiontakeDB
{
	public function select_number_of_member($missionid)
	{
		$text = "select count(*) from missiontake where missionid = %s";
		$sql = sprintf($text, $missionid);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("select", $sql);
		mysql_close($link);
		return $result;
	}
	
	public function select_memberstate_by_id($missionid,$memberid)
	{
		$text = "select memberstate from missiontake where missionid = %s and memberid=%s";
		$sql = sprintf($text, $missionid,$memberid);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("select", $sql);
		mysql_close($link);
		return $result;
	}
	
		public function check_same_receive($missionid,$memberid)
	{
		$text = "select * from missiontake where missionid = %s and memberid=%s ";
		$sql = sprintf($text, $missionid,$memberid);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("select", $sql);
		mysql_close($link);
		return $result;
	}
	
	public function select_missionid_by_memberid($memberid)
	{
		$text = "select missionid from missiontake where memberid = %s";
		$sql = sprintf($text, $memberid);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("select", $sql);
		mysql_close($link);
		return $result;
	}
	
		public function select_memberid_by_missionid($missionid)
	{
		$text = "select memberid from missiontake where missionid = %s";
		$sql = sprintf($text, $missionid);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("select", $sql);
		mysql_close($link);
		return $result;
	}
	
	    public function select_selected_memberid($missionid)
	    {
	    	$text = "select memberid from missiontake where missionid = %s and memberstate='selected'";
		    $sql = sprintf($text, $missionid);
		    $db = new database();
		    $link = $db->start();
		    $result = $db->execute_sql("select", $sql);
		    mysql_close($link);
		    return $result;
	    }
	

   public function delete_missiontake_record($memberid,$missionid)
   {
   	    $text = "delete  from missiontake where memberid = %s and missionid= %s";
		$sql = sprintf($text, $memberid,$missionid);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("delete", $sql);
		mysql_close($link);
		return $result;
   }
   
   public function update_memberstate($missionid)
   {
   	   $text = "update missiontake set memberstate='终止' where missionid= %s";
		$sql = sprintf($text, $missionid);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("update", $sql);
		mysql_close($link);
		return $result;
   }
   
   public function update_memberstate_selected($missionid,$memberid)
   {
   	   $text = "update missiontake set memberstate='selected' where missionid= %s and memberid= %s";
		$sql = sprintf($text, $missionid,$memberid);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("update", $sql);
		mysql_close($link);
		return $result;
   }
   
   public function set_state_success($missionid,$memberid)
   {
   	    $text = "update missiontake set memberstate='success',evaluation='yes' where missionid= %s and memberid= %s";
		$sql = sprintf($text, $missionid,$memberid);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("update", $sql);
		mysql_close($link);
		return $result;
   }
   
   public function insert_new_missiontake($missionid,$memberid)
   {
   	    $text =" insert into missiontake(missionid,memberid) values (%s,%s)";
		$sql = sprintf($text, $missionid,$memberid);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("insert", $sql);
		mysql_close($link);
		return $result;
   }
   
   public function update_memberstate_refused($missionid)
   {
   	    $text = "update missiontake set memberstate='refused' where missionid= %s";
		$sql = sprintf($text, $missionid);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("update", $sql);
		mysql_close($link);
		return $result;
   }
   
   public function delete_mission_member($missionid)
   {
   	    $text = "delete from missiontake where missionid= %s";
		$sql = sprintf($text, $missionid);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("delete", $sql);
		mysql_close($link);
		return $result;
   }
   
   public function check_evaluation($missionid,$memberid)
   {
   	    $text = "select evaluation from missiontake  where missionid= %s and memberid= %s";
		$sql = sprintf($text, $missionid,$memberid);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("select", $sql);
		mysql_close($link);
		return $result;
   }
}

class tagDB
{
	public function select_tag_name()
	{
		$text = "select name from tag ";
		$sql = sprintf($text);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("select", $sql);
		mysql_close($link);
		return $result;
	}
		
	public function insert_tag($tag)
	{
   	    $text =" insert into tag set name='%s'";
		$sql = sprintf($text, $tag);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("insert", $sql);
		mysql_close($link);
   	}
   	
   	public function find_tag($tag)
	{
   	    $text =" select * from tag where name='%s'";
		$sql = sprintf($text, $tag);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("select", $sql);
		mysql_close($link);
   	}
   	
   	public function delete_tag($tag)
   	{
   		$text = "delete from tag where name = '%s'";
   		$sql = sprintf($text, $tag);
   		$db = new database();
   		$link = $db->start();
   		$result = $db->execute_sql("delete", $sql);
   		mysql_close($link);
   	}
}

class donationDB
{
	public function select_donation()
	{
		$text = "select * from publicdonation ";
		$sql = sprintf($text);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("select", $sql);
		mysql_close($link);
		return $result;
	}
	
	public function select_donation_by_Id($id)
	{
		$text = "select * from publicdonation where donationid= %s";
		$sql = sprintf($text,$id);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("select", $sql);
		mysql_close($link);
		return $result;
	}
	public function set_donation_end($id)
	{
		$text = "update publicdonation set state='end' where donationid= %s";
		$sql = sprintf($text,$id);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("update", $sql);
		mysql_close($link);
		return $result;
	}
}

class dataDB
{
	public function select_data()
	{
		$text = "select * from data ";
		$sql = sprintf($text);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("select", $sql);
		mysql_close($link);
		return $result;
	}
	public function update_text($context)
	{
		$text = "update data set text='%s' ";
		$sql = sprintf($text,$context);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("update", $sql);
		mysql_close($link);
		return $result;
	}
	public function update_name($name)
	{
		$text = "update data set name='%s' ";
		$sql = sprintf($text,$name);
		$db = new database();
		$link = $db->start();
		$result = $db->execute_sql("update", $sql);
		mysql_close($link);
		return $result;
	}
}
?>
