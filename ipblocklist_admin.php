
<?php
 

if($_POST['ipblocklist_custom'] == 'Yes') {
if (empty($_REQUEST['ipblocklist_service'])){ $frm_ipblocklist_service = "No"; }else{ $frm_ipblocklist_service = "Yes"; } 
if (empty($_REQUEST['dshield_service'])){ $frm_dshield_service = "No"; }else{ $frm_dshield_service = "Yes"; }  
if (empty($_REQUEST['spamhous_bgp_service'])){ $frm_spamhous_bgp_service = "No"; }else{ $frm_spamhous_bgp_service = "Yes"; }  
   
    
update_option( 'ipblocklist_whitelist', $_REQUEST['ipblocklist_whitelist'] );
update_option( 'ipblocklist_blacklist', $_REQUEST['ipblocklist_blacklist'] );
update_option( 'ipblocklist_service', $frm_ipblocklist_service );
update_option( 'dshield_service', $frm_dshield_service );
update_option( 'spamhous_bgp_service', $frm_spamhous_bgp_service );
update_option( 'ipblocklist_display_option', $_REQUEST['ipblocklist_display_option'] );
update_option( 'ipblocklist_default_notice', $_REQUEST['ipblocklist_default_notice'] );
update_option( 'ipblocklist_redirect_url', $_REQUEST['ipblocklist_redirect_url'] );
update_option( 'ipblocklist_custom_html', $_REQUEST['ipblocklist_custom_html'] );
}

if($_POST['ipblocklist_service']) {
//update_option( 'ipblocklist_service', $_REQUEST['ipblocklist_service'] );
}

if($_POST['dshield_service']) {
//update_option( 'dshield_service', $_REQUEST['dshield_service'] );
}

?>

<style>
.button-ipblocklist {  width: 150px; background: #555; border: 1px solid #fff; color:white; cursor: pointer;}
.button-ipblocklist:hover{  width: 150px; background: #B0C836; border: 1px solid #fff; color:black; cursor: pointer;}
ul.ipblocklist a { display:block; color: #fff; font-family: Verdana;  text-decoration: none;}
ul.ipblocklist, ul.ipblocklist li, ul.ipblocklist ul { list-style: none; margin: 0; padding: 0; border: 1px solid #fff; background: #555; color: #fff;}
ul.ipblocklist { position: relative; z-index: 597; float: left; }
ul.ipblocklist li { float: left; line-height: 1.3em; vertical-align: middle; zoom: 1; padding: 5px 10px; }
ul.ipblocklist li.hover, ul.ipblocklist li:hover { position: relative; z-index: 599; cursor: default; background: #B0C836; }
ul.ipblocklist ul { visibility: hidden; position: absolute; top: 100%; left: 0; z-index: 598; width: 215px; background: #555; border: 1px solid #fff; }
ul.ipblocklist ul li { float: none; }
ul.ipblocklist ul ul { top: -2px; left: 100%; }
ul.ipblocklist li:hover > ul { visibility: visible } 
#ipblocklist_settings {display: block;}
#ipblocklist_logs {display: none;}
#ipblocklist_logs_table td, th {
    border: 1px solid #cecece;
}
#ipblocklist_logs_header {background: #cecece;font-weight:bold;}
#ipblocklist_logs_header td {border-right-color:#ffffff;}
#ipblocklist_logs_table td:last-child {
    border: 1px solid #cecece;
}

</style>

<div class="wrap">
        <div id="ipblocklist_header">
                    <p>
                    <img src="http://www.kesz1.com/wp-content/uploads/2013/09/ipblocklist-300x84.jpg"></p>
                    
                    <ul id="nav_ipblocklist" class="ipblocklist">
                      <li id="btn_ipblocklist_settings"><a href="#" id="ipblocklist_nav_settings">Settings</a></li>
                      <li id="btn_ipblocklist_logs"><a href="#" id="ipblocklist_nav_logs">Logs</a></li>
                     
                      <li><a href="http://www.ipblocklist.com" target="_blank">Submit IP Address</a></li>
                      <li><a href="#">Resource Center</a>
                    			<ul>
                                  <li class="dir"><a href="http://www.ipblocklist.com/iptables.php" target="_blank">Download ipBlockList.txt</a></li>
                                  <li class="dir"><a href="http://www.ipblocklist.com/iptables.php?report=iptables" target="_blank">Generate IPTABLES</a></li>
                                  <li class="dir"><a href="http://www.ipblocklist.com/iptables.php?report=csf" target="_blank">Generate CSF</a>
                                  <li class="dir"><a href="http://www.ipblocklist.com/iptables.php?report=apf" target="_blank">Generate APF</a>
                                  <li class="dir"><a href="http://www.ipdeny.com/ipblocks/" target="_blank">Block IP by Country Code</a>
                    			</ul>
                    	</li>
                      <li><a href="http://ipblocklist.com/index.php?p=contact" target="_blank">Contact Us</a> 
                    </ul>  
                    <div style="height:25px;"></div>
        </div>
        
        
        
        <div id="ipblocklist_settings">
                    <form   method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
                    
                    <p>Select a list to check visitor IP's?</p>
                    <input type="checkbox" name="ipblocklist_service"  id="ipblocklist_service" value="Yes" <?php if (get_option('ipblocklist_service')=='Yes'){?>CHECKED<?php }?>> <label>ipBlockList.com</label><br />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="dshield_service"  id="dshield_service" value="Yes" <?php if (get_option('dshield_service')=='Yes'){?>CHECKED<?php }?>> <label>dshield.org</label><br />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="spamhous_bgp_service"  id="spamhous_bgp_service" value="Yes" <?php if (get_option('spamhous_bgp_service')=='Yes'){?>CHECKED<?php }?>> <label>Spamhaus BGP feed (BGPf)</label>
  
                    
                    	<?php
                    
                      if (get_option('ipblocklist_display_option')=="default_notice"){
                    	$ipblocklist_show_div = "default_notice";
                    	$ipblocklist_display_option_checked = "default_notice";
                    	}elseif (get_option('ipblocklist_display_option')=="redirect_url"){
                    	$ipblocklist_show_div = "redirect_url";
                    	$ipblocklist_display_option_checked = "redirect_url";
                    	}elseif (get_option('ipblocklist_display_option')=="custom_html"){
                    	$ipblocklist_show_div = "custom_html";
                    	$ipblocklist_display_option_checked = "custom_html";
                    	}else{
                    	$ipblocklist_show_div = "default_notice";
                    	$ipblocklist_display_option_checked = "default_notice";
                    	}
                    	//echo $ipblocklist_show_div;
                    	?>
                    
                    
                    <div style="height:15px;"></div>
                    <?php    echo "<h4>Local IP Management & Settings</h4>"; ?>
 
                    <p>Block IP's (one per line)<br><textarea  rows="15" cols="75" name="ipblocklist_blacklist" id="ipblocklist_blacklist"><?php echo get_option('ipblocklist_blacklist'); ?></textarea></p>
                    <p>Whitelist IP's (one per line) <a href="#" onclick="jQuery('#ipblocklist_whitelist').append('\n<?php echo $_SERVER['REMOTE_ADDR']; ?>')"><img src="http://www.kesz1.com/wp-content/uploads/2013/10/whatismyip.png" border="0"></a></a><br><textarea  rows="15" cols="75" name="ipblocklist_whitelist" id="ipblocklist_whitelist"><?php echo get_option('ipblocklist_whitelist'); ?></textarea></p>                    
                    <p>Display Options <br>
                    <input type="radio" id="ipblocklist_display_option" name="ipblocklist_display_option" value="default_notice" <?php if ($ipblocklist_show_div =='default_notice'){?> CHECKED <?php }?> onClick="jQuery('.ipblocklist_display_options').hide();jQuery('#div_ipblocklist_default_notice').show();"> Display basic text notice<br>
                    <input type="radio" id="ipblocklist_display_option" name="ipblocklist_display_option" value="redirect_url" <?php if ($ipblocklist_show_div =='redirect_url'){?> CHECKED <?php }?> onClick="jQuery('.ipblocklist_display_options').hide();jQuery('#div_ipblocklist_redirect_url').show();jQuery('#ipblocklist_redirect_url').val('http://www.ipblocklist.com/?submit=ip&ip=#ip')"> Redirect user to specific page<br>
                    <input type="radio" id="ipblocklist_display_option" name="ipblocklist_display_option" value="custom_html" <?php if ($ipblocklist_show_div =='custom_html'){?> CHECKED <?php }?> onClick="jQuery('.ipblocklist_display_options').hide();jQuery('#div_ipblocklist_custom_html').show();"> Display a custom page using your own HTML<br>
                    
                    <div style="display:none" id="div_ipblocklist_default_notice" name="div_ipblocklist_default_notice" class="ipblocklist_display_options">
                    <?php _e(" ex: Your IP Address has been Blocked." ); ?><br><textarea rows="5" cols="75" name="ipblocklist_default_notice" id="ipblocklist_default_notice"><?php echo get_option('ipblocklist_default_notice'); ?></textarea>
                    </div>
                    <div style="display:none" id="div_ipblocklist_redirect_url" name="div_ipblocklist_redirect_url" class="ipblocklist_display_options">
                    <?php _e(" ex: http://google.com " ); ?><br>
                    <input type="text" name="ipblocklist_redirect_url" id="ipblocklist_redirect_url" value="<?php echo get_option('ipblocklist_redirect_url'); ?>" size="75"> <br />(#ip is a placeholder for the visitors IP address)
                    </div>
                    <div style="display:none" id="div_ipblocklist_custom_html" name="div_ipblocklist_custom_html" class="ipblocklist_display_options">
                    <?php _e(" ex: if left blank, visitor will be redirected to ipBlockList.com" ); ?><br>
                    <textarea  rows="15" cols="75" name="ipblocklist_custom_html" id="ipblocklist_custom_html"><?php echo str_replace('\"','"',get_option('ipblocklist_custom_html')); ?></textarea>
                    
                    </div>
                    
                    
                    
                    
                    
                    <p class="submit">
                    <input type="submit"  class="button-ipblocklist"  name="Submit" value="<?php _e('Update Settings') ?>" />
                    <input type="hidden" name="ipblocklist_custom" value="Yes" />
                    </p>
                    </form> 
        </div>
        

        <div id="ipblocklist_logs">        
                    <p>
                    
                    <form   method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">IP Address <input name="search_ip" type="text"> <input type="submit"  class="button-ipblocklist"  name="search_ipblocklist" value="<?php _e('Search Logs') ?>" /></form>
                    </p>
                    <?php 
                        if ($_REQUEST['search_ipblocklist']){
                        echo "<p>Searching IP Address " . $_REQUEST['search_ip'] . "</p>"; 
                        } 
                    ?>                    
                    <table cellpadding="3" cellspacing="0"  id="ipblocklist_logs_table">
                    <tr id="ipblocklist_logs_header"><td>IP Address</td><td>Date/Time</td> </tr>
                    <?php 
                    $ipblocklist_log = get_option('ipblocklist_log'); 
                    $ipblocklist_log_array = explode("|",$ipblocklist_log);
                    $ipblocklist_log_array = array_reverse($ipblocklist_log_array);
                    foreach ($ipblocklist_log_array as $ipblocklist_log_entries){//$log_key=>
                    $log_data = explode("-",$ipblocklist_log_entries);
                    if (empty($log_data[0])){
                        continue;
                    }
                    if ($_REQUEST['search_ipblocklist']){
                        //echo trim($_REQUEST['search_ip']) . "<br>" . trim($log_data[0]) ;
                        if (trim($_REQUEST['search_ip']) != trim($log_data[0])){
                           continue;
                        }
                    }
                    ?>
                    <tr><td><a href="http://www.infosniper.net/index.php?ip_address=<?php echo $log_data[0];?>&map_source=1&overview_map=1&lang=1&map_type=1&zoom_level=7" target="_blank"><?php echo $log_data[0];?></a></td><td><?php echo ($log_data[1]);?><?php //echo date("m/d/Y h:i a",strtotime($log_data[1]));?></td> </tr>
                    <?php } ?>
                    </table>
                    <?php if ($_REQUEST['search_ipblocklist']){?>
              <form   method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>"><p><input type="submit" class="button-ipblocklist"  name="clear_search_ipblocklist" value="<?php _e('Clear Search') ?>" /></p>      </form>                 
                    <?}?>                     
    
        </div>

        
</div>
 
<script>
jQuery("#div_ipblocklist_<?=$ipblocklist_show_div;?>").show();
jQuery("#ipblocklist_nav_settings").click(function(){
 jQuery("#ipblocklist_settings").show(); 
 jQuery("#ipblocklist_logs").hide();   
 jQuery("#btn_ipblocklist_settings").css("background-color", "#B0C836");
 jQuery("#btn_ipblocklist_logs").css("background-color", "#555");
});
jQuery("#ipblocklist_nav_logs").click(function(){
 jQuery("#ipblocklist_settings").hide(); 
 jQuery("#ipblocklist_logs").show();   
 jQuery("#btn_ipblocklist_settings").css("background-color", "#555");
 jQuery("#btn_ipblocklist_logs").css("background-color", "#B0C836");
});
 jQuery("#btn_ipblocklist_settings").css("background-color", "#B0C836");
 
 <? if (($_REQUEST['search_ipblocklist'])||($_REQUEST['clear_search_ipblocklist'])){?>
 jQuery("#ipblocklist_settings").hide(); 
 jQuery("#ipblocklist_logs").show();   
 jQuery("#btn_ipblocklist_settings").css("background-color", "#555");
 jQuery("#btn_ipblocklist_logs").css("background-color", "#B0C836");
 <?}?>
</script>
 