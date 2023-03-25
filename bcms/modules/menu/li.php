<?php
	global $domain_user_data;
	if(count($domain_user_data)==0){
		if(isset($domain_data["original_db"])){
			$domain_name=$domain_data["original_db"]['Name'];
		}else{
			$domain_name=$domain_data["db"]['Name'];
		}
		/*
		
		if(isset($_SESSION['membersID'])){
			$sql="SELECT URI,MenuTitle FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Member' OR Exposure='Both') AND languagesID=".LANGUAGESID." AND (domainsID=".$domain_data['id']." OR domainsID=0) ORDER BY Sort_Order";
		}else{
			$sql="SELECT URI,MenuTitle FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Public' OR Exposure='Both') AND module_viewsID IN (SELECT module_viewsID FROM module_views_menu WHERE Exposure='Public' OR Exposure='Both') AND languagesID=".LANGUAGESID." AND (domainsID=".DOMAINSID." OR domainsID=0) ORDER BY Sort_Order";
		}
		*/
		if($_SESSION['membersID']>0){
			
			$sql="SELECT URI,MenuTitle FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Member' OR Exposure='Both')";
			$sql.=" AND languagesID=".$app_data['LANGUAGESID']." AND (domainsID=".$domain_data['db']['id']." OR domainsID=0) ORDER BY Sort_Order";
			
		}else{
			$sql="SELECT URI,MenuTitle FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Public' OR Exposure='Both')";
			$sql.=" AND module_viewsID IN (SELECT module_viewsID FROM module_views_menu WHERE Exposure='Public' OR Exposure='Both')";
			$sql.=" AND languagesID=".$app_data['LANGUAGESID']." AND (domainsID=".$domain_data['db']['id']." OR domainsID=0) ORDER BY Sort_Order";
		}
		//print $sql."\n";
		$rslt=$r->RawQuery($sql);
		while($data=$r->Fetch_Array($rslt)){
			?><li><a href="http://<?php print $domain_name.$data[0];?>"><?php print $data[1];?></a></li><?php
		}
	}else{
		?><li><a href="http://<? print $domain_name; ?>">Directory Home</a></li><?php	
	}
?>