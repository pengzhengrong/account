<?php

class userPo{
	
	private $id;
	private $name;
	private $age;
	
	public function __construct( $name , $age){
		$this->name = $name;
		$this->age = $age;
	}
	
	public function __set( $key , $value ){
		$this->$key = $value;
	}
	
	public function __get( $key ){
		return $this->$key;
	}
	
	public function my_print( ){
		echo $this->name."  this year age is:".$this->age."\n";
	}
	
	public function __toString(){
		return $this->name." this year age is(__toString) :".$this->age."\n";
	}
	
	public function __clone(){
		$this->name = 'pzr&zy';
		$this->age = 20;
	}
	
}

$user = new userPo('pzr',24);
// $user->name = 'pzr';
// echo $user->name."  this year age is:".$user->age;
$user->my_print();
$user2 = $user;
$user2->name = 'zy';
$user2->my_print();
$user->my_print();

if( $user == $user2 ){
	echo "user 和 user2 的内容一致\n";
}
if( $user === $user2 ){
	echo "user 和 user2 的引用一致\n";
}
/*
 * 解析：在内存中创建了一个对象$user,$user2 引用对象$user。
 * 修改$user2的name属性，其实$user已经产生了变化。
 * 
 */
echo "------------------------------------------------------\n";
$user3 = clone $user;
$user3->age = 22;
$user3->my_print();
$user->my_print();
if( $user == $user3 ){
	echo "user 和 user3 的内容一致\n";
}
if( $user === $user3 ){
	echo "user 和 user3 的引用一致\n";
}

echo $user3;
/*
 * 解析：$user3 是 $user的备份，但是不是引用的$user,可以理解成为新的对象，但是包含有$user的属性和值。
 * 
 */
?>