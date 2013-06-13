<?php
$rrdFile = dirname(__FILE__) . "/rand.rrd";

$num = rand(0,100);
//update rrd file
$update = rrd_update($rrdFile,
 array(
  "rand:time():$num",
  )
);

if(!$update){
	echo rrd_error();
}