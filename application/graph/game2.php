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
$table = '<table border=0  style="text-align:center;background-image: url(\'https://account.test.com:8899/graph/image?width=300\');" width="500px" height="500px">';
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
<body style="text-align: center;"  >  
<span id="tip" style="color:red;">●</span>走棋&nbsp;&nbsp;<span id="step">0</span>步数
<div align="center">
	<?php  echo $table;?>
</div>

</body>
<script type="text/javascript">
localStorage.count = 0;
var btns = $("button");
var len = btns.length;
var rows_arr = new Array();
var cols_arr = new Array();
function mark( _this ){
	rows_arr = new Array();
	cols_arr = new Array();
	var i =  Number(localStorage.count)%2;
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
		if(!rout(_this)){return;}
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
		rule(_this);
		localStorage.count=Number(localStorage.count)+1;
		$("#step").html(localStorage.count);
	}
	
}

function exit(){
	
}

function rout(_this){
	var index = _this.title;
	for( var i = 0 ; i<len ;i++){
		if( btns[i].value == 'mark' ){
			break;
		}
	}
	//alert(i+" "+index);
	if( (i==3 || i==7||i==11) && index-i==1 ){return false;}
	if( (i==4 || i==8||i==12) && index-i==-1){return false;}
	if( Math.floor(i/4) == 0 && (index==i+1 || index==i-1 || index== i+4) ) {return true;}
	if( Math.floor(i/4) == 3 && (index==i+1 || index==i-1 || index== i-4) ) {return true;}
	if( i%4==0 && (index==i+1 || index==i+4 || index==i-4) ){return true;}
	if( i%4==3 && (index==i-1 || index==i+4 || index==i-4) ){return true;}
	if( (i==5 || i==6 || i==9 || i==10) && (index==i+4||index==i-4||index==i+1||index==i-1)  ){return true;}
	return false;
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
	kill(rows_arr,index,0);
	kill(cols_arr,index,1);
}

function kill( arr ,index,type){
	var temp = new Array();
	var first = btns[arr[0]].style.color;
	var second = btns[arr[1]].style.color;
	var third = btns[arr[2]].style.color;
	var last = btns[arr[3]].style.color;
	
	if( index%4==2 || index%4==1 || Math.floor(index/4)==2 || Math.floor(index/4==1) ){
// 		//alert( first +" "+second+" "+third+" "+last);
		if( third!='' && third==second && first==last && first !='' && first != third ){
			//alert("rule1");
			temp.push(arr[0]);
			temp.push(arr[3]);
		}else if( third!='' && third==second && first!=last && first!=second){
			//alert("rule1.1");
			if( (Math.floor(index/4)==0||Math.floor(index/4)==3) && type==1){return;}
			if( index%4==0 || index%4==3 && type==0){return;}
			temp.push(arr[0]);
			temp.push(arr[3]);
		}else if( third!='' && third==last && second!=third && second !='' &&  first !=second ){
			//alert("rule2");
			if( index%4==1 && type == 0){return;}
			if( Math.floor(index/4)==1  && type ==1){return;} 
			temp.push(arr[1]);
		}else if( first!='' && first==second && third!=second &&  third!='' && last=='' ){
			//alert("rule3");
			if( index%4==2 && type==0){return;}
			if( Math.floor(index/4)==2  && type ==1){return;} 
			temp.push(arr[2]);
		}
	}
	if( index%4==0 || index%4==3 || Math.floor(index/4)==0 || Math.floor(index/4)==3){
		if( first!='' && first==second && third!='' && third!=second && last=='' ){
			//alert("rule4");
			if( Math.floor(index/4)==2 && type==1){return;}
			temp.push(arr[2]);
		}else if( last!='' && last==third && second!='' && second!=third && first==''){
			//alert("rule5");
			if( Math.floor(index/4)==1 && type==1){return;}
			temp.push(arr[1]);
		}
	}
	deleteCore(temp);
}

function deleteCore( arr ){
	var len2 =  arr.length;
	for( var i = 0 ; i<len2 ;i++){
		var index = arr[i];
			btns[index].innerHTML='&nbsp;';
			btns[index].style.color='';
			btns[index].value='';
	}
}


function get_rows_cols(index ){
	//判断第几行第几列
	var rows = Math.floor(index/4);
	var cols = index%4;
	var row_start = (rows)*4;
	var col_start = cols;
	for( var i = 0 ;i<4;i++){
		var row_index = row_start + i;
// 		rows_arr.push( btns[row_index].style.color );
		rows_arr.push( row_index );
	}
	for( var i = 0 ;i<4;i++){
		var col_index = col_start + i*4;
// 		cols_arr.push( btns[col_index].style.color );
		cols_arr.push( col_index );
	}
// 	//alert(rows+"  "+rows_arr+"---"+cols_arr);
}

$( function(){
	for( var i = 0 ; i<len ;i++){
		btns[i].title=i;
	}
})



</script>
</html>