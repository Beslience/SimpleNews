使用mvc实战一个简单的新闻管理

后台新闻管理
	admin.php唯一入口调用pc.php下run()

简单mvc框架
/framework/
	function/function.php	M()	V()	C()	负责实例化libs/下对应的对象
	core/DB.class.php	对db下的连接数据库对象进一步抽象，上升到多个数据库，同时根据配置实例化对象
	core/VIEW.class.php	对view下的模板引擎对象进一步抽象，上升到多个模板引擎,同时根据配置实例化对象 
	db/mysql.class.php	mysqli类，封装增、删、查、该
	view/smarty/-----模板

pc.php run():初始化db具体数据库、view具体模板引擎，接收参数controller、method,并根据C(controller,method)
调用控制层下的方法。控制层下的方法会调用M()实例化模型，处理业务，返回数据，由于使用并实例化了模板引擎，使
用模板引擎封装数据，并展示视图。

	



