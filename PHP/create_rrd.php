<?php
$rrdFile = dirname(__FILE__) . "/rand.rrd";

// A）COUNTER ：必须是递增的，除非是计数器溢出（overflows）。在这种情况下，RRDtool 会自动修改收到的值。例如网络接口流量、收到的
   
//         packets 数量都属于这一类型。

//    B）DERIVE：和 COUNTER 类似。但可以是递增，也可以递减，或者一会增加一会儿减少。

//    C）ABSOLUTE ：ABSOLUTE 比较特殊，它每次都假定前一个interval的值是0，再计算平均值。

//    D）GAUGE ：GAGUE 和上面三种不同，它没有“平均”的概念，RRDtool 收到值之后字节存入 RRA 中

//    E）COMPUTE ：COMPUTE 比较特殊，它并不接受输入，它的定义是一个表达式，能够引用其他DS并自动计算出某个值


//create rrd file
rrd_create($rrdFile,			// File
 array(
  "--step=10",					// Default 300s
  "--start=0",					// If the time < start,system refuse it
  "DS:rand:GAUGE:600:0:100",	// DS:DS-name:DST(data source type: COUNTER,GAUGE,DERIVE,ABSOLUTE,COMPUTE):dst-arguments,
  								// 600 是 heartbeat,then min:max;如果没有最小值/最大值，可以用 U 代替
  "RRA:AVERAGE:0.5:1:600",		// RRA(like a table,save the different interval data):CF:cf-arguments
  "RRA:AVERAGE:0.5:3:300"
  )
);