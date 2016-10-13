<?php
function get_web_page($url,$options)
    {

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        return $header;
    }
$hostname = "avtovokzal.opt-fashion.com";

$options = array(

            CURLOPT_CUSTOMREQUEST  =>"GET",        //set request type post or get
            CURLOPT_POST           =>false,        //set to GET
            CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0', //set user agent
            CURLOPT_COOKIEFILE     =>"cookies/cookie.txt", //set cookie file
            CURLOPT_COOKIEJAR      =>"cookies/cookie.txt", //set cookie jar
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            //CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        );

$result = get_web_page($_POST["wurl"]."admin/",$options);



if ( $result['errno'] != 0 )
{
	echo $result['errno'];
}

if ( $result['http_code'] != 200 )
{
	echo $result['http_code'];
}

$page = $result['content'];

$sessid=substr($page,strpos($page,'hidden'));
$split= preg_split('/"/', $sessid);
$sessid = $split[6];
//echo $sessid;
?>

<form action="<?echo $_POST["wurl"]?>admin/" method="post" id="login">
    <input type="hidden" value="<?echo $_POST["admlogin"];?>" name="admlogin">
    <input type="hidden" value="<?echo $_POST["admpass"];?>" name="admpass">
    <input type="hidden" value="<?echo $sessid;?>" name="sessid">
</form>
<script src="js/jquery-3.1.0.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script>
$(document).ready(function(){
    if ($.cookie('goback')=='goin'){
        $.cookie('goback', 'back', { expires: 1 });
        $('#login').submit();
    }
    else{
        window.location.replace("http://project-manager.opt-fashion.com");
    }
});
</script>