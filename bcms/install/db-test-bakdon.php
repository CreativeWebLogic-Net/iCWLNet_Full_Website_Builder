<?
    //session_start();
?>
<a href="db-test.php">Next Page</a>
<pre>
<?    /*
    class clsLog{
        /*
        var $MessageArray=array();
        function general($msg,$num=0){
            $MessageArray[]=$msg;

        }
        function display(){
            print var_export($MessageArray,true);

        }
        
        *//*
    }*/

/*
    class clsDatabaseInt{
        var $links;
        var $SQL;
        var $log;
        var $result;
        
        /*
		function __construct(){
			
		}
		
        
        
		public function rawQuery($query)
		{
			$this->log->general("in r->rawQuery");
            $this->log->general($query);
            
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
		*//*
        
    }*/

    //-----------------------------------------------------------------------------------------------------------
   /*
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
            //$this->db->clsFact=$this;

            $this->vs=new clsVariables();
            $this->vs->log=&$this->log;
            //$this->vs->clsFact=$this;
            
            $this->r=new clsDatabaseInt();
            $this->r->log=&$this->log;
            //$this->r->clsFact=$this;

            $this->Mail=new SendMail();
            //$this->Mail->clsFact=$this;

            
            //-----------------------------------------------------------------------------------------------------------
		}

        public function go(){

        }
		
    }*/
    //-----------------------------------------------------------------------------------------------------------
   /*
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
        var $rslt;
        var $result;
        var $num_rows_search;
        var $current_row;
        var $clsFact;
        /*
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
            *//*
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
            
            //$r=new clsDatabaseInt();
            //$this->log=&$log;

            $this->TArr="db-icwl.php";
            $this->log->general("\n\n\n\nCurrent 1 Position\n\n\n\n");
            
            $this->db_login=$this->server_login[$this->TArr];
            $this->log->general($this->db_login);
            
            try{
                $this->new_links = new mysqli($this->db_login['hostname'], $this->db_login['usernamedb'], $this->db_login['passworddb'],$this->db_login['dbName'] );
                //$this->log->general("\n\n\n\nCurrent Succc 2 Position\n\n\n\n".$this->mysqli->connect_error.var_dump($this->db_login,true).var_dump($this->new_links,true)."----\n\n");
                $this->log->general("\n\n\n\nCurrent Succc 2 Position\n\n\n\n".$this->mysqli->connect_error."----\n\n");
                $m_error=$this->new_links->connect_error;
                if(!$m_error){
                    $this->log->general("\n\n\n\nCurrent 22 Success Position\n\n\n\n".$m_error);
                }else{
                    $this->log->general("\n\n\n\nCurrent 44 fail Position\n\n\n\n".$m_error);
                }
            }catch(MySQLException $e){
                //$this->log->general("\n\n\n\nCurrent Fail 2 Position\n\n\n\n".$new_links->connect_error.var_dump($db_login,true).var_dump($new_links,true)."----\n\n");
                $this->log->general("\n\n\n\nCurrent Fail 2 Position\n\n\n\n".$new_links->connect_error."----\n\n");
            
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
                    /*
                    $query_watch=array();
                    $this->log->general("\n UPDATE DB Change\n");
                    $query="SELECT COUNT(id) AS IDCount FROM ip2location WHERE location_dataID=0";
                    
                    $this->result = $this->new_links->query($query);
                    $record_count=array();
                    $record_count=$this->result->fetch_assoc();
                    $record_count=$record_count["IDCount"];
                    $this->log->general("-xr-".$query."-".$record_count."- | \n");
                    $query_watch[]=$query;
                    
                    $this->log->general("-lr-".var_export($_SESSION,true)."-lr- |",3);
                    $_SESSION['current_page']+=1;
                    $num_rows_search=1000;
                    $current_row=$_SESSION['current_page']*$num_rows_search;
                    //$query="SELECT id,country_code,country_name,state,city FROM location_data Order By country_name DESC LIMIT ".$current_row.",".$num_rows_search;
                    $query="SELECT id,country_code,country_name,state,city FROM location_data Order By country_name DESC LIMIT 0,1000";
                    $this->result = $this->new_links->query($query);
                    //$result_val=
                    $this->log->general("-ar-".$query."-");
                    $this->log->general(var_export($this->result,true));
                    $this->log->general("-br-");
                    $query_watch[]=$query;
                    //$result_val=$this->result->fetch_assoc();
                    $num_rows=$this->result->num_rows;
                    $this->log->general("-dr-".$num_rows."-");
                    $row_count=0;
                    *//*
                    if($num_rows>0){
                        
                        while($row_count<10){
                            /*
                            $result_val=$this->result->fetch_assoc();
                            $this->log->general($row_count." - cr | ".var_export($result_val,true)." | \n\n ".$num_rows);
                            $row_count++;
                            $val=$result_val;
                            *//*
                            if($row_count>1000){
                                throw new Exception("Too many rows updated", 1);
                            }
                            
                            $this->log->general($row_count." - hr | ".var_export($val,true)." | \n\n ".$num_rows);
                           
                            foreach($val as $key=>$value){
                                //$value=$this->clsFact->r->Escape($value);
                                $this->log->general(" jr - ".var_export($val,true)." - ".$key." - ".$value." | \n\n");
                            }
                            
                            $this->log->general($query." | ".var_export($result_val,true)." | \n\n ".$row_count);
                            
                            $val["id"]=$this->r->Escape($val["id"]);
                            
                            $val["country_code"]=$this->r->Escape($val["country_code"]);
                            $val["country_name"]=$this->r->Escape($val["country_name"]);
                            $val['state']=$this->r->Escape($val['state']);
                            $val["city"]=$this->r->Escape($val["city"]);
                            *//*
                            
                            $this->log->general("\n vr Loading locations into db\n");

                            $query="UPDATE ip2location AS t1 SET location_dataID='".$val["id"]."'  WHERE "; 
                            $query.="t1.country_code='".$val["country_code"]."' AND t1.country_name='".$val["country_name"];
                            $query.="' AND t1.state='".$val['state']."' AND t1.city='".$val["city"]."' AND location_dataID=0";
                            $query_watch[]=$query;
                            $this->log->general($query);
                        
                            $this->log->general("\n kr Load locations ID into ip2location db\n");
                            $this->log->general("\n wr dbdb result\n".var_export($this->rslt,true));
                            $this->rslt = $this->new_links->query($query);
                            $number_of_rows=$this->rslt->num_rows;
                            $this->log->general("\n sr Should have Loaded locations ID into ip2location db\n - ".$number_of_rows."- |");
                            if($this->new_links->connect_error) {
                                //throw new MySQLException("No location data Loaded", 1);
                                $this->log->general("\n No location data Loaded \n");
                            }else{
                                $this->log->general("\n Congrats Loaded locations ID \n");
                            }
                            
                        };
                    }else{
                        $log->general("-nr-".$num_rows."-");
                        //throw new Exception("Number of rows from location data", 1);
                        
                    }
                }catch(MySQLException $me){
                    //print_r($me);
                    $log->general("-Me SQL Error-".var_export($me,true)."\n ");
                }
                
                $log->general("-Last SQL Error-".var_export($this->new_links,true)."\n ");
                $log->general("\n\n\n\nExcell Current 4 Position\n\n\n\n".$this->new_links->connect_error.var_export($this->db_login,true).var_export($output,true)."----\n\n");
            }
            
        
        }
        *//*
    }*/
    
    /*
   $clsFact=new clsDatabaseFactory();
   $clsFact->go();
   //phpinfo();
   //print"help me";
   //header("Location: db-test.php");
   $clsFact->log->general("-Last SQL Error-".var_export($query_watch,true)."\n ");
   $clsFact->log->display();
   */
?></pre><a href="db-test.php">Next Page</a>
<script>
    location.href="/bcms/tmp/db-test.php?id=true";
</script>