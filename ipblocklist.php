<?php
    /*
    Plugin Name: ipBlockList
    Plugin URI: http://www.kesz1.com
    Description: ipBlockList.com is a community and server based blocklist that is constantly updated with the help of user submission and web server iptable reports.  ipBlockList.com has created this free plugin to allow WordPress users the ability to add another layer of protection to their website.
    Author: Kesz1 Technologies
    Version: 1.0
    Author URI: http://www.kesz1.com
    */

function ipblocklist_load() {
global $wpdb;
 
		//check ipblocklist
		if (get_option('ipblocklist_service')=="Yes"){
        //Define visitor IP    
        if ( isset($_SERVER["REMOTE_ADDR"]) )    { 
        $ip =  $_SERVER["REMOTE_ADDR"]; 
        } else if ( isset($_SERVER["HTTP_X_FORWARDED_FOR"]) )    { 
        $ip =  $_SERVER["HTTP_X_FORWARDED_FOR"]; 
        } else if ( isset($_SERVER["HTTP_CLIENT_IP"]) )    { 
        $ip =  $_SERVER["HTTP_CLIENT_IP"]; 
        } 
        
        
        //Variables - Counter to track if the ip addresses is flagged under one of the services
        $action_loop=0;
        $dshield = "No"; 
    	$spamhous_bgp_service="No";         
          

    			if (get_option('dshield_service')=="Yes"){
    			$dshield="Yes";
    			}
	            if (get_option('spamhous_bgp_service')=="Yes"){
    			$spamhous_bgp_service="Yes";
    			}                
    
    				$ipurl = "http://www.ipblocklist.com/ipblocklist.php?spamhous_bgp_service=$spamhous_bgp_service&dshield=$dshield&ipaddress=" . $ip;
    				$handle = fopen($ipurl, "r");
    				$block=file_get_contents($ipurl);
    				if (trim($block)=="Yes"){
    				$action_loop++; //increase the counter to trigger action
    				}
    		
    
    		//check local user added lists
    		$local_blacklist_array = explode("\n", get_option('ipblocklist_blacklist'));
    		if (in_array($ip, $local_blacklist_array)) {//$_SERVER['REMOTE_ADDR']
    		$action_loop++; //increase the counter to trigger action
    		}
            
    		$local_whitelist_array = explode("\n", get_option('ipblocklist_whitelist'));
    		if (in_array($ip, $local_whitelist_array)) {//$_SERVER['REMOTE_ADDR']
    		$action_loop=0; //increase the counter to trigger action
    		}
    		//Action loop if $action_loop > 0 means the IP address is banned
    		if ($action_loop>0){
            update_option( 'ipblocklist_log', (get_option('ipblocklist_log')."|".$ip."-".date("m/d/Y h:i a",strtotime(current_time( 'mysql' )))) );
    		$ipblocklist_display_option = get_option('ipblocklist_display_option'); //get the display option type
    		$ipblocklist_display_action = get_option('ipblocklist_'.get_option('ipblocklist_display_option')); //get the display option value
    
    		//echo $ipblocklist_display_option;
    				  if ($ipblocklist_display_option=="redirect_url"){ //if the display option value is redirect then send the user
                      $ipblocklist_display_action = str_replace("#ip",$ip,$ipblocklist_display_action);
    						header("Location:$ipblocklist_display_action");
    					}else{  //show the text/html
                            if (empty($ipblocklist_display_action)){
			                     header("Location:http://www.ipblocklist.com/?submit=ip&ip=$ip");                               
                            }else{
                                 echo str_replace('\"','"',$ipblocklist_display_action);  //remove magic quotes                                
                            }    					  
    					}
    
    						exit();  //stop the page from fully loading
    		}
        }
}


function ipblocklist_admin() {
    include('ipblocklist_admin.php');
}

function ipblocklist_admin_actions() {
    add_options_page("ipBlockList", "ipBlockList", 1, "ipBlockList", "ipblocklist_admin");
}
add_action('init', 'ipblocklist_load');
add_action('admin_menu', 'ipblocklist_admin_actions');
//add_action('wp_head', 'ipblocklist_load');
?>