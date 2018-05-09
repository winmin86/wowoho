<?php
namespace app\index\controller;

class Test
{
	public function show() {
		echo "99999999999999";
		
		///$t = new \my\Test1();
		//$t->sayHello();
		
		//如果你需要调用PHP内置的类库，或者第三方没有使用命名空间的类库，记得在实例化类库的时候加上 \
		//$class = new \stdClass();
		//$xml  =  new \SimpleXmlElement($xmlstr);


		/*
		\think\cache\driver\File类的定义为
		namespace think\cache\driver;

		class File 
		{
		}
		
		如果我们实例化该类的话，应该是：

		$class = new \think\cache\driver\File();
		
		系统会自动加载该类对应路径的类文件，其所在的路径是 thinkphp/library/think/cache/driver/File.php
		
		*/
	}
	
}
