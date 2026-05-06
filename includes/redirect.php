
<?php
$protocol=$_SERVER['SERVER_PROTOCOL'];

if(strpos($protocol, "HTTPS"))
{
    $protocol="HTTPS://";
}
else
{
    $protocol="HTTP://";   
}
$redirect_link_var=$protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$_SESSION['page_url'] = $redirect_link_var;
?>
