<?
    ini_set( 'display_errors', '1' );
    session_start();
?>
<html>
<body>

<a href="db-test.php">Next Page</a>
<?    
    
    class clsLog{
        
        var $MessageArray=array();
        var $PriorityMessages=array();
        var $clsFact;

        function general($msg,$num=0){
            
            if($num>=3){
                $this->PriorityMessages[]=$msg;
            }else{
                $this->MessageArray[]=$msg;
            }
            error_log(var_export($msg,true), $num, "./my-errors.log");
            //print $msg;

        }

        function display_all(){
            print var_export($this->MessageArray,true);

        }

        function display_priority(){
            print var_export($this->PriorityMessages,true);

        }
    }
    

    
    class clsDatabaseInt{
        var $links;
        var $SQL;
        var $log;
        var $result;
        var $clsFact;
        
        
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
		
        
    }
    
    //-----------------------------------------------------------------------------------------------------------
   
    class clsDatabaseFactory{
        var $log;
        var $r;
        var $vs;
        var $db;
        var $mail;
        var $clsFact;
        var $clsArray=array();
        
		function __construct(){
			//-----------------------------------------------------------------------------------------------------------
            

            $this->log=new clsLog();
            $this->log->clsFact=&$this;

            $this->log->general("\n Start DB Factory - \n");
    
            $this->db=new clsDatabaseConnect();
            $this->db->log=&$this->log;
            //$this->db->Connect();
            //$this->db->Connect_Query();
            $this->db->clsFact=&$this;
            
            /*
            $this->vs=new clsVariables();
            $this->vs->log=&$this->log;
            $this->vs->clsFact=$this;
            */
            
            $this->r=new clsDatabaseInt();
            $this->r->log=&$this->log;
            $this->r->clsFact=&$this;
            /*
            $this->mail=new SendMail();
            //$this->Mail->clsFact=$this;
            */
            //$this->clsArray=array("log"=>&$this->log,"db"=>&$this->db,"vs"=>&$this->vs,"r"=>&$this->r,"Mail"=>&$this->mail);
            $this->clsArray=array("log"=>&$this->log,"db"=>&$this->db,"r"=>&$this->r);
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
        var $rslt;
        var $result;
        var $num_rows_search;
        var $current_row;
        var $clsFact;
        
		function __construct(){
			//-----------------------------------------------------------------------------------------------------------
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
            //$this->log->general("\n\n\n\nStartup Position\n\n\n\n");
            
            //$r=new clsDatabaseInt();
            //$this->log=&$log;

            $this->TArr="db-icwl.php";
            //$this->log->general("\n\n\n\nCurrent 1 Position\n\n\n\n");
            
            $this->db_login=$this->server_login[$this->TArr];
            //-----------------------------------------------------------------------------------------------------------
            
		}

		function DB_Connect(){
			//-----------------------------------------------------------------------------------------------------------
           
            try{
                $this->new_links = new mysqli($this->db_login['hostname'], $this->db_login['usernamedb'], $this->db_login['passworddb'],$this->db_login['dbName'] );
                //$this->log->general("\n\n\n\nCurrent Succc 2 Position\n\n\n\n".$this->mysqli->connect_error.var_dump($this->db_login,true).var_dump($this->new_links,true)."----\n\n");
                $this->log->general("\n\n\n\nCurrent Succc 2 Position\n\n\n\n".$this->mysqli->connect_error."----\n\n");
                $m_error=$this->new_links->connect_error;
                if(!$m_error){
                    $this->log->general("\n\n\n\nCurrent 22 Success Position\n\n\n\n".$m_error);
                }else{
                    $this->log->general("\n\n\n\nCurrent 44 fail Position\n\n\n\n".$m_error,3);
                }
            }catch(MySQLException $e){
                //$this->log->general("\n\n\n\nCurrent Fail 2 Position\n\n\n\n".$new_links->connect_error.var_dump($db_login,true).var_dump($new_links,true)."----\n\n");
                $this->log->general("\n\n\n\nCurrent Fail 2 Position\n\n\n\n".$new_links->connect_error."----\n\n",3);
            
            }
            
            //-----------------------------------------------------------------------------------------------------------
            
		}

        public function Connect_Query(){
            $this->DB_Connect();
            $this->log->general("\n RUN Query Change\n");
            $_SESSION['current_page']=7;
            $this->log->general("\n RUN 2\n". $_SESSION['current_page']);
            $page_count=$_SESSION['current_page'];
            //$max_segment=$current_segment+1;
            //$loop_run=true;
            //while($loop_run){
            for($x=$page_count;$x<($page_count+5);$x++){
                /*
                if(($current_segment*8000)>3500000)$loop_run=false;
                if($current_segment>$max_segment)$loop_run=false;
                
                $to_id=$current_segment*8000;
                $from_id=$to_id-8000;
                */
                $to_id=$x*8000;
                $from_id=$to_id-8000;
                $query="UPDATE ip2location ";
                $query.="INNER JOIN location_data ";
                $query.="ON ((ip2location.city =location_data.city) AND ";
                $query.=" (ip2location.country_code =location_data.country_code) AND ((ip2location.id>".$from_id.")AND(ip2location.id<".$to_id."))) ";
                $query.="SET ip2location.location_dataID = location_data.id";
                $this->log->general("\n RUN Query Change\n - ".$query);
                $this->result = $this->new_links->query($query);
                //$current_segment++;
                
                
            }
            
            
        }
		
        public function Connect(){
            
            
            
            
            $this->DB_Connect();
            
            // Check connection
            if($this->new_links->connect_error) {
                $this->log->general("-Connection Error-".$this->new_links->connect_error."\n vars:=".var_export($this->db_login),3);		
            }else{
                //$this->r->links=$this->new_links;
                $this->log->general("-Connection Success->".$this->TArr,1);
                $this->log->general("\n",1);
                //$log->general("Success... %s\n".var_export($new_links,true),3); 
                $this->links[$this->TArr]=$this->new_links;
                
                //$log->general("\n\n\n\nCurrent 3 Position\n\n\n\n".$mysqli->connect_error.var_dump($new_links,true)."----\n\n");
                $this->log->general("\n Current 3 enquery result\n");
                
                try{
                    //$_SESSION['current_page']=0;
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
                    $num_rows_search=50;
                    $current_row=$_SESSION['current_page']*$num_rows_search;
                    $query="SELECT id,country_code,country_name,state,city FROM location_data Order By country_name DESC LIMIT ".$current_row.",".$num_rows_search;
                    //$query="SELECT DISTINCT id,country_code,country_name,state,city FROM location_data Order By country_name DESC LIMIT 0,50";
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
                    
                    if($num_rows>0){
                        $this->log->general($num_rows." - Number of location rows\n",1);
                        while($row_count<$num_rows_search){
                            //-----------------------------------------------------------------------------------------------------------
                            $log_msg="---".$row_count."-of-".$num_rows_search."-------------------------------------";
                            $log_msg.="-----------------------------------------------------------------\n\n";
                            $this->log->general($log_msg,1);
            
                            $result_val=$this->result->fetch_assoc();
                            $this->log->general($row_count." - cr | ".var_export($result_val,true)." | \n\n ".$num_rows);
                            $row_count++;
                            $val=$result_val;
                            
                            if($row_count>$num_rows_search){
                                throw new Exception("Too many rows updated", 1);
                            }
                            
                            $this->log->general($row_count." - hr |  | \n\n ".$num_rows);
                           /*
                            foreach($val as $key=>$value){
                                //$value=$this->clsFact->r->Escape($value);
                                $value=addslashes($value);
                                //$this->log->general(" jr -  - ".$key." - ".$value." | \n\n");
                            }
                            */
                            
                            $this->log->general($query." |  | \n\n ".$row_count);
                            $val['country_code']=stripslashes($val['country_code']);
                            $val['country_name']=stripslashes($val['country_name']);
                            $val['state']=stripslashes($val['state']);
                            $val['city']=stripslashes($val['city']);
                            
                            $this->log->general("\n vr Loading locations into db\n");

                            $query="UPDATE ip2location AS t1 SET location_dataID='".$val["id"]."'  WHERE "; 
                            $query.="t1.country_code='".$val["country_code"]."' AND t1.country_name='".$val["country_name"];
                            $query.="' AND t1.state='".$val['state']."' AND t1.city='".$val["city"]."' AND location_dataID=0";
                            $query_watch[]=$query;
                            $query=stripslashes($query);
                            $this->log->general($query);
                        
                            $this->log->general("\n kr Load locations ID into ip2location db\n");
                            $this->log->general("\n wr dbdb result\n".var_export($this->rslt,true));
                            $this->rslt = $this->new_links->query($query);
                            $number_of_rows=$this->rslt->num_rows;
                            $this->log->general("\n sr Should have Loaded locations ID into ip2location db\n - ".$number_of_rows."- |");
                            if($this->new_links->connect_error) {
                                //throw new MySQLException("No location data Loaded", 1);
                                $this->log->general("\n No location data Loaded \n",3);
                            }else{
                                $this->log->general("\n Congrats Loaded locations ID \n");
                            }
                            
                        };
                    }else{
                        $this->log->general("-nr-no rows from db".$num_rows."-");
                        //throw new Exception("Number of rows from location data", 1);
                        
                    }
                }catch(MySQLException $me){
                    //print_r($me);
                    $this->log->general("-Me SQL Error-".var_export($me,true)."\n ",3);
                }
                
                $this->log->general("-Last SQL Error-".var_export($this->new_links,true)."\n ");
                $this->log->general("\n\n\n\nExcell Current 4 Position\n\n\n\n".$this->new_links->connect_error.var_export($this->db_login,true).var_export($output,true)."----\n\n");
            }
            
        
        }
        
    }
    
    
   $clsFact=new clsDatabaseFactory();
   $clsFact->go();
   //phpinfo();
   //print"help me";
   //header("Location: db-test.php");
   $clsFact->log->general("-Last SQL Error-".var_export($query_watch,true)."\n ");
   $clsFact->db->Connect_Query();

   
   
?><a href="db-test.php">Next Page</a>
<script>
    var Get_String=Math.random( ) * 1000;
    location.href="/bcms/tmp/db-test.php?id="+Get_String;
</script>
<pre><?
$clsFact->log->display_all();
?></pre>
</body>
</html>