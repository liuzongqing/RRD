<?php
date_default_timezone_set("Asia/Shanghai");
$rrdFile = dirname(__FILE__)."/check_disk.rrd";
$first = rrd_first($rrdFile);

echo date("Y-m-d H:i:s",$first);

// $opts = array ( "AVERAGE", "--start", '-1d');
// var_dump(rrd_fetch($rrdFile,$opts));

?>


<?php
  $opts = array( "–start", "-1d", "–vertical-label=B/s",
  	"DEF:inoctets=net.rrd:input:AVERAGE",
  	"DEF:outoctets=net.rrd:output:AVERAGE",
  	"AREA:inoctets#00FF00:In traffic",
  	"LINE1:outoctets#0000FF:Out traffic\\r",
  	"CDEF:inbits=inoctets,8,*",
  	"CDEF:outbits=outoctets,8,*",
  	"COMMENT:\\n",
  	"GPRINT:inbits:AVERAGE:Avg In traffic\: %6.2lf %Sbps",
  	"COMMENT:  ",
  	"GPRINT:inbits:MAX:Max In traffic\: %6.2lf %Sbps\\r",
  	"GPRINT:outbits:AVERAGE:Avg Out traffic\: %6.2lf %Sbps",
  	"COMMENT: ",
  	"GPRINT:outbits:MAX:Max Out traffic\: %6.2lf %Sbps\\r"
  	);

  $ret = rrd_graph("net_1d.gif", $opts, count($opts));

  if( !is_array($ret) )
  {
    $err = rrd_error();
    echo "rrd_graph() ERROR: $err\n";
  }
?>
