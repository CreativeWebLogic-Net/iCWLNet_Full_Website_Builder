<?
    print"help";
    phpinfo();

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
        
        
		function __construct(){
			
		}
		
        
        
		public function rawQuery($query)
		{
			print "in r->rawQuery";
            print $query;
            
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

        
		function Escape($string)
		{
			$st = $this->links->real_escape_string($string);
			return $st;
			
		}
		
        
    }

    //-----------------------------------------------------------------------------------------------------------
   
    class clsDatabaseFactory{
        var $new_links = array();
        var $server_login=array();
        var $log;
        var $r;
        var $vs;
        var $TArr="db-icwl.php";
        var $mysqli;
        var $DB;
        var $db_login;

		function __construct(){
			//-----------------------------------------------------------------------------------------------------------
    
            $this->log=new clsLog();
    
            $this->db=new clsDatabaseConnect();
            $this->db->log=&$this->log;
            $this->db->Connect();

            $this->vs=new clsVariables();
            $this->vs->log=&$this->log;
            
            $this->r=new clsDatabaseInt();
            $this->r->log=&$this->log;

            $this->Mail=new SendMail();

            
            //-----------------------------------------------------------------------------------------------------------
		}

        public function go(){

        }
		
    }
    //-----------------------------------------------------------------------------------------------------------
   
   class clsDatabaseConnect{ 
        var $new_links = array();
        var $server_login=array();
        var $log;
        var $r;
        var $vs;
        var $TArr="db-icwl.php";
        var $mysqli;
        var $DB;
        var $db_login;

		function __construct(){
			//-----------------------------------------------------------------------------------------------------------
            /*
            $this->log=new clsLog();
    
            $this->db=$this;
            
            $this->db->Connect();
            $this->db->log=&$this->log;
            
            $this->r=new clsDatabaseInt();
            $this->r->log=&$this->log;
            
            //-----------------------------------------------------------------------------------------------------------
            */
		}
		
        public function Connect(){
            
            $this->DB['server_tag']="db-icwl.php";
            $this->DB['server_desc']="WHM Reseller Server";
            $this->DB['current_dir']="/home2/icwl0738/public_html";
            $this->DB['server_number']=2;
            $this->DB['hostname']="localhost";
            $this->DB['usernamedb']='icwl0738_bubblel';
            $this->DB['passworddb']='dfa456%$d';
            $this->DB['dbName']="icwl0738_bubblelite2";
            $this->DB['dbNames']=array('icwl0738_bubblelite2','icwl0738_takebookings','icwl0738_partnerspro','icwl0738_smsg');
            $this->server_login["db-icwl.php"]=array('server_tag'=>$this->DB['server_tag'],'usernamedb'=>'icwl0738_bubblel','passworddb'=>'DickSux5841','server_desc'=>$this->DB['server_desc'],'current_dir'=>$this->DB['current_dir'],'server_number'=>$this->DB['server_number'],'hostname'=>$this->DB['hostname'],'usernamedb'=>$this->DB['usernamedb'],'passworddb'=>$this->DB['passworddb'],'dbName'=>$this->DB['dbName'],'dbNames'=>$this->DB['dbNames']);
            
            $this->new_links = array();
            
            
            //$this->log=new clsLog();
            $this->log->general("\n\n\n\nStartup Position\n\n\n\n");
            
            $r=new clsDatabaseInt();
            $this->log=&$log;

            $this->TArr="db-icwl.php";
            $this->log->general("\n\n\n\nCurrent 1 Position\n\n\n\n");
            
            $this->db_login=$server_login[$TArr];
            //print_r($this->db_login);
            
            try{
                $this->new_links = new mysqli($this->db_login['hostname'], $this->db_login['usernamedb'], $this->db_login['passworddb'],$this->db_login['dbName'] );
                $this->log->general("\n\n\n\nCurrent Succc 2 Position\n\n\n\n".$this->mysqli->connect_error.var_dump($this->db_login,true).var_dump($this->new_links,true)."----\n\n");
                $m_error=$this->new_links->connect_error;
                if(!$m_error){
                    $this->log->general("\n\n\n\nCurrent 22 Success Position\n\n\n\n".$m_error);
                }else{
                    $this->log->general("\n\n\n\nCurrent 44 fail Position\n\n\n\n".$m_error);
                }
            }catch(MySQLException $e){
                $this->log->general("\n\n\n\nCurrent Fail 2 Position\n\n\n\n".$new_links->connect_error.var_dump($db_login,true).var_dump($new_links,true)."----\n\n");
            
            }
            
            
            // Check connection
            if($this->new_links->connect_error) {
                $this->log->general("-Connection Error-".$this->new_links->connect_error."\n vars:=".var_export($this->db_login),3);		
            }else{
                $this->r->links=$this->new_links;
                $this->log->general("-Connection Success->".$this->TArr,1);
                $this->log->general("\n",1);
                //$log->general("Success... %s\n".var_export($new_links,true),3); 
                $this->links[$this->TArr]=$this->new_links;
                
                //$log->general("\n\n\n\nCurrent 3 Position\n\n\n\n".$mysqli->connect_error.var_dump($new_links,true)."----\n\n");
                $this->log->general("\n Current 3 enquery result\n");
                
                try{
                    $this->log->general("\n UPDATE DB Change\n");
                    $query="SELECT id,country_code,country_name,state,city FROM location_data Order By country_name ASC LIMIT 0,100000";
                    $this->result = $this->new_links->query($query);
                    //$result_val=
                    //print_r($this->result);
                    //$result_val=$result->fetch_assoc();
                    $num_rows=$result->num_rows;
                    if($num_rows>0){
                        while($result_val=$result->fetch_assoc()){
                            
                            $val=$result_val;
                            print($query." | ".var_dump($result_val,true)." | \n\n ".$num_rows);
                        
                            $val["id"]=$r->Escape($val["id"]);
                        
                            $val["country_code"]=$r->Escape($val["country_code"]);
                            $val["country_name"]=$r->Escape($val["country_name"]);
                            $val['state']=$r->Escape($val['state']);
                            $val["city"]=$r->Escape($val["city"]);
                            
                            
                            $query="UPDATE ip2location AS t1 SET location_dataID='".$val["id"]."'  WHERE "; 
                            $query.="t1.country_code='".$val["country_code"]."' AND t1.country_name='".$val["country_name"];
                            $query.="' AND t1.state='".$val['state']."' AND t1.city='".$val["city"]."'";

                            print $query;
                        
                            
                            $this->log->general("\ndbdb result\n".var_dump($this->result,true));
                            $this->result = $this->new_links->query($query);
                            
                        };
                    }else{
                        throw new Exception("Error Updating Foriegn Places", 1);
                        
                    }
                }catch(MySQLException $me){
                    //print_r($me);
                }
                
                $log->general("-Last SQL Error-".var_dump($this->new_links,true)."\n ");
                $log->general("\n\n\n\nExcell Current 4 Position\n\n\n\n".$this->new_links->connect_error.var_dump($this->db_login,true).var_dump($output,true)."----\n\n");
            }
            
        
        }
        
    }
    
   $clsFactory=new clsDatabaseFactory();
   $clsFactory->go();
?>