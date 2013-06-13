<?php
date_default_timezone_set("Asia/Shanghai");
$rrdFile = dirname(__FILE__)."/check_mysql_conn.rrd";

$opts = array (
		"--start=-5w",		//	start time: 5 weekly ago,or you can use $now() - seconds
		"--end=-1m",		//	end time: 1 month ago, or m,h,d,w,m,y
		"--title=test",		//	The title of graph
		"--vertical-label=conn/s",	// The Y-axis label
		"DEF:c-average=$rrdFile:1:AVERAGE",	//Y-axis data
		"DEF:c-max=$rrdFile:1:MAX",			// Y-axis data,the data name in the rrd and CF: MAX,MIN,LAST,AVERAGE
		"DEF:c-min=$rrdFile:1:MIN",
		"CDEF:r-average=c-average,1,*",		// The data show in the graph
		"CDEF:r-max=c-max,1,*",
		"CDEF:r-min=c-min,1,*",

		"COMMENT:\\n",
		"COMMENT:Name------last------max------min------average\\n",
		"COMMENT:\\n",
		"AREA:r-average#AB0000:ave",
		"GPRINT:r-average:LAST:%8.2lf",
		"GPRINT:r-average:MAX:%8.2lf",
		"GPRINT:r-average:MIN:%8.2lf",
		"GPRINT:r-average:AVERAGE:%8.2lf",
		"COMMENT:\\n",
		"AREA:r-max#FF0000:max",
		"GPRINT:r-max:LAST:%8.2lf",
		"GPRINT:r-max:MAX:%8.2lf",
		"GPRINT:r-max:MIN:%8.2lf",
		"GPRINT:r-max:AVERAGE:%8.2lf",
		"COMMENT:\\n",
		"LINE2:r-min#050000:min",
		"GPRINT:r-min:LAST:%8.2lf",
		"GPRINT:r-min:MAX:%8.2lf",
		"GPRINT:r-min:MIN:%8.2lf",
		"GPRINT:r-min:AVERAGE:%8.2lf",
		"COMMENT:\\n",
	);

$set = rrd_graph("/var/www/html/conn.png",$opts);
if(!$set){
	echo rrd_error()."\n";
}

?>
