<?php

$tr2 = $tr = $tr1 = '<tr>';
$td1 = '<td><button onclick="mark(this)" style="color:red;">●</button></td>';
$td2 = '<td><button onclick="mark(this)" style="color:black;">●</button></td>';
$td = '<td><button onclick="mark(this)" >&nbsp;</button></td>';
for($i=0;$i<4;$i++){
	$tr .= $td;
	$tr1 .= $td1;
	$tr2 .= $td2;
}
$tr .= '</tr>';
$tr1 .= '</tr>';
$tr2 .= '</tr>';
$table = '<table background:url("account.test.com:8899/graph/image");  height="300px" width="300px">';
for($i=0;$i<4;$i++){
	if( $i == 0  ){
		$table .= $tr1;
		continue;
	}
	if( $i == 3  ){
		$table .= $tr2;
		continue;
	}
	$table .= $tr;
}
$table .= '</table>';

?>

<html>  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />  
<title>横扫千军 php100.com</title>  
<script type="text/javascript"  src="<?php echo __PATH_JS__.'jquery-1.4.4.min.js' ;?>" ></script>
</head>  
<body style=""  >  
<span id="tip" style="color:red;">●</span>走棋
<?php  echo $table;?>
<table style="background-image: url(''http://account.test.com:8899/graph/image);"></table>
</body>

<script type="text/javascript">
localStorage.count = 0;
var btns = $("button");
var len = btns.length;
function mark( _this ){
	rows_arr = new Array();
	cols_arr = new Array();
	var i =  Number(localStorage.count)%2;
	rule(_this);
	var color =  _this.style.color;
	if( i==0 && color == 'red' ){
		changeMark(i);
		_this.style.color = 'yellow';
		_this.value = 'mark';
	}else if(i==1 && color == 'black' ){
		changeMark(i);
		_this.style.color = 'yellow';
		_this.value = 'mark';
	}else if( color == '' ){
		var mark = removeMark();
		if( mark == 0 ){
			i==0?alert( '红方下棋' ):alert('黑方下棋');
			return;
		}
		_this.innerHTML = '●';
		if( i ){
			_this.style.color = 'black';
			$('#tip').css("color","red");
		}else{
			_this.style.color = 'red';
			$('#tip').css("color","black");
		}
		localStorage.count=Number(localStorage.count)+1;
	}
	
}

function removeMark(){
	for( var i = 0 ; i<len ;i++){
		if( btns[i].value == 'mark' ){
			btns[i].innerHTML='&nbsp;';
			btns[i].style.color='';
			btns[i].value='';
			return 1;
		}
	}
	return 0;
}

function changeMark( count ){
	for( var i = 0 ; i<len ;i++){
		if( btns[i].style.color == 'yellow' ){
			var color = count==0?'red':'black';
			btns[i].value='';
			btns[i].style.color= color;
		}
	}
}

function rule( _this  ){
	var index = _this.title;
	get_rows_cols(index);
}

var rows_arr = new Array();
var cols_arr = new Array();
function get_rows_cols(index ){
	//判断第几行第几列
	var rows = index/4+1;
	var cols = index%4+1;
	var row_start = (rows-1)*4;
	var col_start = cols-1;
	for( var i = 0 ;i<4;i++){
		var row_index = row_start + i;
		rows_arr.push( btns[row_index].style.color );
	}
	for( var i = 0 ;i<4;i++){
		var col_index = col_start + i*4;
		cols_arr.push( btns[col_index].style.color );
	}
	alert(rows_arr+"---"+cols_arr);
}

$( function(){
	for( var i = 0 ; i<len ;i++){
		btns[i].title=i;
	}
})



</script>
</html>