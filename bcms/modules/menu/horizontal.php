
<div id="link-menu-container">&nbsp;&nbsp;
<?php
	$first=true;
	if(count($domain_user_data)==0){
		/*
		if(isset($_SESSION['membersID'])){
			if($_SESSION['membersID']){
				$sql="SELECT URI,MenuTitle FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Member' OR Exposure='Both') AND languagesID=".LANGUAGESID." AND (domainsID=".$domain_data['id']." OR domainsID=0) ORDER BY Sort_Order";
			}else{
				$sql="SELECT URI,MenuTitle FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Public' OR Exposure='Both') AND module_viewsID IN (SELECT module_viewsID FROM module_views_menu WHERE Exposure='Public' OR Exposure='Both') AND languagesID=".LANGUAGESID." AND (domainsID=".DOMAINSID." OR domainsID=0) ORDER BY Sort_Order";
			}
		}else{
			$sql="SELECT URI,MenuTitle FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Public' OR Exposure='Both') AND module_viewsID IN (SELECT module_viewsID FROM module_views_menu WHERE Exposure='Public' OR Exposure='Both') AND languagesID=".LANGUAGESID." AND (domainsID=".DOMAINSID." OR domainsID=0) ORDER BY Sort_Order";
		}*/
		if(isset($domain_data["original_db"])){
			$domain_name=$domain_data["original_db"]['Name'];
			$SEOFriendly=$domain_data["original_db"]['SEOFriendly'];
		}else{
			$domain_name=$domain_data["db"]['Name'];
			$SEOFriendly=$domain_data["db"]['SEOFriendly'];
		}
		

		if($_SESSION['membersID']>0){
			
			$sql="SELECT DISTINCT URI AS uri,MenuTitle AS menutitle,id AS content_pagesid FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Member' OR Exposure='Both')";
			$sql.=" AND languagesID=".$app_data['LANGUAGESID']." AND (domainsID=".$domain_data['id']." OR domainsID=0) GROUP BY URI ORDER BY Sort_Order";
			
		}else{
			$sql="SELECT DISTINCT URI AS uri,MenuTitle AS menutitle,id AS content_pagesid FROM content_pages WHERE Menu_Hide='No' AND (Exposure='Public' OR Exposure='Both')";
			$sql.=" AND module_viewsID IN (SELECT module_viewsID FROM module_views_menu WHERE Exposure='Public' OR Exposure='Both')";
			$sql.=" AND languagesID=".$app_data['LANGUAGESID']." AND (domainsID=".$domain_data["db"]['id']." OR domainsID=0) GROUP BY URI ORDER BY Sort_Order";
		}
		///print $sql."\n";	
		$rslt=$r->RawQuery($sql);
		//while($data=$r->Fetch_Array($rslt)){
		while($data=$r->Fetch_Assoc($rslt)){
			if(!$first){
				?> | <?php
			}else{
				$first=false;
			}
			$menu_data["db"][]=$data;
			//print_r($data);
			if($SEOFriendly=="No"){
				//print $sql."\n";
				?><a id="link-item-id"  class="link-item-cl" href="http://<?php print $domain_name.$app_data['ROOTDIR']."index.php?guid=1&cpid=".$data["content_pagesid"];?>"><?php print $data["menutitle"];?></a><?php
			}else{
				?><a id="link-item-id"  class="link-item-cl" href="http://<?php print $domain_name.$data["uri"];?>"><?php print $data["menutitle"];?></a><?php
			}
		}
	}else{
		?><a href="http://<? print $domain_data["db"]['name']; ?>">Directory Home</a><?php	
	}

?>
</div>