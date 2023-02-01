<?php

    class clsLog{
        
        function general($msg,$num=0){
            print $msg;

        }
        

    }
    class clsDatabaseInt{
        var $links;
        var $SQL;
        var $log;
        var $result;

		public function rawQuery($query)
		{
			print "in r->rawQuery";
            print $query;
            /*
            try{
                
				//$this->SQL=$query;
                
				if(isset($this->links)){
					$this->result = $this->links->query($query);
					
					if(!$this->result){
						$this->log->general("No MySQL Result->".$query,3);
						return false;
					}else{
                        $this->log->general("$ r MySQL Session->".$this->result,3);
						return $this->result;
					}
				}else{
					$this->log->general("No MySQL Session->".$query,3);
				}
                
			}catch(MySQLException $e){
				//$this->log->general("MySQL Exception->".var_export($e,true)." ".$query,3);
			
			}
            */
		}
		
		public function NumRows(){
			try{
				$this->log->general("Start Num Rows->",3);
				$num_rows=$this->result->num_rows;
				$this->log->general("Row Count->".$num_rows,3);
				$this->log->general("\n",3);
				return $num_rows;
			}catch(Exception $e){
				$this->log->general("MySQL NumRows Exception->".var_export($e,true)." ".$this->SQL,3);
				return 0;
			}
		}
		
		public function Fetch_Array()
		{
			$row = $this->result->fetch_array(MYSQLI_NUM);
			return $row;
			
		}
		
		public function Fetch_Assoc()
		{
			$row = $this->result->fetch_assoc();
			return $row;
			
		}
		
		public function Error()
		{
			$er = $this->result->error;
			return $er;
			
		}
        
    }
    
   //-----------------------------------------------------------------------------------------------------------
   
   $DB['server_tag']="db-icwl.php";
    $DB['server_desc']="WHM Reseller Server";
    $DB['current_dir']="/home2/icwl0738/public_html";
    $DB['server_number']=2;
    $DB['hostname']="localhost";
    $DB['usernamedb']='icwl0738_bubblel';
    $DB['passworddb']='dfa456%$d';
    $DB['dbName']="icwl0738_bubblelite2";
    $DB['dbNames']=array('icwl0738_bubblelite2','icwl0738_takebookings','icwl0738_partnerspro','icwl0738_smsg');
    $server_login["db-icwl.php"]=array('server_tag'=>$DB['server_tag'],'usernamedb'=>'icwl0738_bubblel','passworddb'=>'DickSux5841','server_desc'=>$DB['server_desc'],'current_dir'=>$DB['current_dir'],'server_number'=>$DB['server_number'],'hostname'=>$DB['hostname'],'usernamedb'=>$DB['usernamedb'],'passworddb'=>$DB['passworddb'],'dbName'=>$DB['dbName'],'dbNames'=>$DB['dbNames']);
    
    $new_links = array();

    $log=new clsLog();
    $log->general("\n\n\n\nStartup Position\n\n\n\n");
    
    $r=new clsDatabaseInt();
    $r->log=&$log;

    $TArr="db-icwl.php";
    $log->general("\n\n\n\nCurrent 1 Position\n\n\n\n");
    
    $db_login=$server_login[$TArr];
    print_r($db_login);
    try{
        $new_links = new mysqli($db_login['hostname'], $db_login['usernamedb'], $db_login['passworddb'],$db_login['dbName'] );
        $log->general("\n\n\n\nCurrent Succc 2 Position\n\n\n\n".$mysqli->connect_error.var_dump($db_login,true).var_dump($new_links,true)."----\n\n");
        $m_error=$new_links->connect_error;
        if(!$m_error){
            $log->general("\n\n\n\nCurrent 22 Success Position\n\n\n\n".$m_error);
        }else{
            $log->general("\n\n\n\nCurrent 44 fail Position\n\n\n\n".$m_error);
        }
    }catch(MySQLException $e){
        $log->general("\n\n\n\nCurrent Fail 2 Position\n\n\n\n".$new_links->connect_error.var_dump($db_login,true).var_dump($new_links,true)."----\n\n");
    
    }
    
    // Check connection
    if($new_links->connect_error) {
        $log->general("-Connection Error-".$new_links->connect_error."\n vars:=".var_export($db_login),3);		
    }else{
        $r->links=$new_links;
        $log->general("-Connection Success->".$TArr,1);
        $log->general("\n",1);
        //$log->general("Success... %s\n".var_export($new_links,true),3); 
        $links[$TArr]=$new_links;
        
        //$log->general("\n\n\n\nCurrent 3 Position\n\n\n\n".$mysqli->connect_error.var_dump($new_links,true)."----\n\n");
        $log->general("\n Current 3 enquery result\n");
        
        try{
            $log->general("\n UPDATE DB Change\n");
            //$query="SELECT id,country_code,country_name,state,city FROM location_data Order By country_name ASC LIMIT 0,5";
            $query="SELECT id,country_code,country_name,state,city FROM location_data Order By country_name ASC LIMIT 0,100000";
                    
            $result = $new_links->query($query);
            //$result_val=
            //print_r($result);
            $result_location=$result->fetch_assoc();
            //while($result_val=$new_links->fetch_assoc(MYSQLI_NUM)){
                //print($query." - ".var_dump($result_val,true)." \n\n ");
            //};
           
            //$result = $new_links->query($query);
            //$result_val=$new_links->fetch_assoc(MYSQLI_NUM);
            $val=$result_location;
            $num_rows=$result->num_rows;
            if($num_rows>0){
                while($result_val=$result->fetch_assoc()){
                    print_r($key);
                    print_r($val);
                    $log->general("\nnoodle result\n".var_dump($result,true));
                    $query="UPDATE ip2location AS t1 SET t1.location_dataID =".$val['id']." WHERE "; 
                    $query.="t1.country_code=".$val["country_code"].",t1.country_name=".$val["country_name"];
                    $query.=",t1.state=".$val['state'].",t1.city=".$val["city"].";";
                    print $query;
                    $log->general("\ndbdb result\n".var_dump($result,true));
                    //$result = $new_links->query($query);
                }
            }
            
        }catch(Exception $me){
            print_r($me);
        }
        
        $log->general("\n</pre>\n");
        $log->general("-Last SQL Error-".var_dump($new_links,true)."\n ");
        $log->general("\n\n\n\nExcell Current 4 Position\n\n\n\n".$new_links->connect_error.var_dump($db_login,true).var_dump($output,true)."----\n\n");
    }
?>