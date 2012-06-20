<?php
/*
Plugin Name: Red5 Recorder Player
Plugin URI: http://red5.svnlabs.com/
Description: Red5 Recorder allows wordpress users to easily use Red5 Recorder Player on their website to record Video / Audio Streams as response and embed to website. 
Date: 2012, May, 28
Author: Sandeep Verma
Author URI: http://www.svnlabs.com/
Version: 1.07
*/

/*
Author: Sandeep Verma
Website: http://www.svnlabs.com
Copyright 2012 SVN Labs Softwares, Jaipur, India All Rights Reserved.

*/



function red5recorder_add_admin()
{
    add_options_page('Red5Recorder', 'red5recorder', 8, 'red5recorder', 'red5recorder_options');
}


$red5recorder_sizes = array(
                        1 =>array(
                            "name"    =>"Default",
                            "w"        =>"566",
                            "h"        =>"207"
                        )
                    );
                    



 
function red5recorder_content($content) {
    global $red5recorder_sizes;
     
    $size     = intval(get_option('red5recorder_size'));
    
     
	$regex = '/\[red5recorder:(.*?)]/i';
    preg_match_all( $regex, $content, $matches );
	//echo "<pre>";
	//print_r($matches);
     
	
	$replace = '<iframe src="http://red5.svnlabs.com/flex/index.php?key='.$matches[1][0].'" frameborder="0" marginheight="0" marginwidth="0" scrolling="no" width="350" height="350"></iframe>';	
	
	
    $content = str_replace($matches[0][0], $replace, $content);
    
    
    return $content;
}




/*
 * The Options page
 */
function red5recorder_options()
{    
    global $red5recorder_sizes;
    
    $options = array("");
    
    if($_POST['action'] == 'save')
    {
        update_option('red5recorder_size', $_POST['red5recorder_size']);
         
        foreach($options as $o)
        {    
            
            $val = !empty($_POST[$o]);
            update_option($o, $val);
        }
    }
    
     
    $size     = get_option('red5recorder_size');
     
     
    
     
    
    
?>

 <div class="wrap">
     
    <h2>Red5 Redorder Player Options</h2>
    <div style="float: right; width: 300px; padding: 10px; text-align:center; background-color: #FFFFCC; border: 1px solid #000">
    <h3 style="text-align:center">Do you like this plugin? <br />I want to make it better?</h3>
    
    
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="RET8NPWS3BXQG">
<input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>
<br />

<a href="http://red5.svnlabs.com/" target="_blank">Security is not Free - Get fully customized Red5 Recorder for Website</a>     
    
    <p><a href="http://www.svnlabs.com/concentrate" title="concentrate"><strong>Concentrate</strong></a> <strong>&gt;</strong> <a href="http://www.svnlabs.com/observe" title="observe"><strong>Observe</strong></a> <strong>&gt;</strong> <a href="http://www.svnlabs.com/imagine" title="imagine"><strong>Imagine</strong></a> <strong>&gt;</strong> <a href="http://www.svnlabs.com/launch" title="launch"><strong>Launch</strong></a></p>
    </div>
     
   
   A Red5 Recorder Player can be embedded in a post using a tag of the following form: [red5recorder:key] <br />

   <iframe src="http://red5.svnlabs.com/form/index.php?host=<?php echo $_SERVER['HTTP_HOST'];?>&key=" frameborder="0" marginheight="0" marginwidth="0" width="350" height="350"></iframe> 
   
   
</div>
<?php    
}

/*
 * Install options
 */
function red5recorder_install()
{ 
     
    add_option('red5recorder_size',7, "Defines video size");
    
    
     
     
}


add_filter('the_content','red5recorder_content');
//add_filter('the_excerpt','red5recorder_content');
add_action('admin_menu', 'red5recorder_add_admin');

register_activation_hook(__FILE__,"red5recorder_install");

?>