####wp二次开发的网店

#####关于部署
我没有导出我的数据库，因为主机的域名和调试服务器的端口都不一样，所以导出了也需要去手动修改数据库才可以，这样不如直接初始化一次wp来的方便，后期我会搞一个脚本自动部署。

__部署方法__

	1.确保 你的服务器支持 mod_rewrite 和 php curl 
	
	2.克隆该项目到你的web目录
	
	3.手动修改根目录下的 wp-config.php 把里面的数据库配置改成自己的
	
	4.访问主页初始化系统
	
	5.在管理员面板的常规设置里开启 固定链接 ， 这里必须要设置固定链接，因为api系统依赖这个选项，不设置的话api接口直接404. 并且开启注册功能 （根目录下的 .htaccess 文件必须可写）。
	
	6.在插件设置里开启 Alipay For WooCommerce , JSON API, Loginzen, Remove Open Sans font from WP core , WooCommerce , 这几个插件（其实就是开启所有插件）
	
	7.在外观里设置主题为 mystile ， 因为这个将作为基本主题进行开发，前段还没开发好 。
	
	8.根据提示 安装 WooCommerce 的模版文件到当前主题目录下（其实已经存在于mystile目录下了，如果不生效请再点一次那个橘色按钮吧）.
	
	9.在主菜单中点击 WooCommerce ， 进入 settings , 然后点击 checkout ， 在菜单下面的一行小字超链接的最后面 点击 支付宝 这个链接，  在进入的选项卡里 启用支付宝， 设置基本信息， 如果主币种不是人民币的话，必须设置汇率才可以使用支付宝， 不然在结账的时候是不会出现 支付宝选项的。
	
	10.在后台的products里添加商品然后 就可以测试了.目前只有系统自带的支付模式和支付宝。
	
	
__API的设置方法__

	请耐心看完，不然你是用不上api的。
	
	1.用管理员账户进入后台， 进入用户菜单下的 我的个人资料菜单。
	
	2.拖动到页面的最底部， 勾选上 Generate API Key 这个选项。
	
	3.更新个人资料之后， 再次拖动页面到最下方， 会发现 刚刚生成的 consumer key 和consumer secret  , 在 权限 选项中选择 一个， 然后把key 和
	secert保存下来， 最后点击更新个人资料。
	
	4. 进入   根目录/wp-content/plugins/json-api/controllers 文件夹， 打开user.php 文件 根据文件中的注释信息进行修改。
	
	5.进入主菜单  设置选项卡， 进入最后一项 JSON API中， 在这个页面中 启用 倒数第二个 user api接口，如果API base 的参数被修改，那么你的api调用地址将会改变.
	
___API的调用规范__
	
	调用方法：
	传入的id是 用户的id ， 返回的json包括该用户订单的详细信息。
	http://127.0.0.1:8080/wordpress/api/user/order/?id={ 1 }
	
	返回：
	{
  		"status": "ok",
  		"0": {
    			"orders": [
      				{
        				"id": 10,
        				"order_number": "#10",
        				"created_at": "2014-10-11T18:52:29Z",
        				"updated_at": "2014-10-11T18:52:29Z",
        				"completed_at": "2014-10-11T18:52:29Z",
        				"status": "pending",
        				"currency": "GBP",
       				 	"total": "46.00",
        				"subtotal": "46.00",
      				 	 "total_line_items_quantity": 2,
        				"total_tax": "0.00",
        				"total_shipping": "0.00",
        				"cart_tax": "0.00",
        				"shipping_tax": "0.00",
        				"total_discount": "0.00",
        				"cart_discount": "0.00",
        				"order_discount": "0.00",
        				"shipping_methods": "Free Shipping",
        				"payment_details": {
         					 "method_id": "alipay",
         					 "method_title": "\u652f\u4ed8\u5b9d",
          					"paid": false
       				 },
       			 	"billing_address": {
          					"first_name": "\u6536\u8d39",
          					"last_name": "\u58eb\u5927\u592b",
          					"company": "",
          					"address_1": "\u58eb\u5927\u592b",
          					"address_2": "",
         					"city": "\u58eb\u5927\u592b",
         					"state": "CN3",
         					"postcode": "232",
          					"country": "CN",
          					"email": "sdf2@df.sm",
          					"phone": "23232"
       				},
        				"shipping_address": {
          					"first_name": "\u6536\u8d39",
          					"last_name": "\u58eb\u5927\u592b",
          					"company": "",
          					"address_1": "\u58eb\u5927\u592b",
          					"address_2": "",
          					"city": "\u58eb\u5927\u592b",
          					"state": "CN3",
          					"postcode": "232",
          					"country": "CN"
        				},
        				"note": "",
        				"customer_ip": "127.0.0.1",
        				"customer_user_agent": "Mozilla\/5.0 (Macintosh; Intel Mac OS X 10.9; rv:32.0) Gecko\/20100101 Firefox\/32.0",
       				 "customer_id": "1",
        				"view_order_url": "http:\/\/127.0.0.1:8080\/wordpress\/my-account\/view-order\/10",
        				"line_items": [
        					  {
            						"id": 1,
            						"subtotal": "46.00",
            						"total": "46.00",
            						"total_tax": "0.00",
            						"price": "23.00",
           						 	"quantity": 2,
           						 	"tax_class": null,
            						"name": "sfsf",
            						"product_id": 8,
           						 "sku": ""
         					 }
        				],
        				"shipping_lines": [
          					{
           						 "id": 2,
            						 "method_id": "free_shipping",
           						 "method_title": "Free Shipping",
            						"total": "0.00"
          					}
        				],
        				"tax_lines": [],
        				"fee_lines": [],
        				"coupon_lines": [],
        				"customer": {
          					"id": 1,
          					"created_at": "2014-10-11T17:53:52Z",
          					"email": "sdf2@df.sm",
          					"first_name": "",
          					"last_name": "",
          					"username": "younger",
          					"last_order_id": "10",
          					"last_order_date": "2014-10-11T18:52:29Z",
          					"orders_count": 0,
          					"total_spent": "0.00",
          					"avatar_url": "http:\/\/0.gravatar.com\/avatar\/ad516503a11cd5ca435acc9bb6523536?s=96",
          					"billing_address": {
            						"first_name": "\u6536\u8d39",
            						"last_name": "\u58eb\u5927\u592b",
            						"company": "",
            						"address_1": "\u58eb\u5927\u592b",
            						"address_2": "",
            						"city": "\u58eb\u5927\u592b",
           							"state": "CN3",
            						"postcode": "232",
            						"country": "CN",
           							"email": "sdf2@df.sm",
            						"phone": "23232"
          					},
          					"shipping_address": {
            						"first_name": "\u6536\u8d39",
           							"last_name": "\u58eb\u5927\u592b",
           							"company": "",
           							"address_1": "\u58eb\u5927\u592b",
            						"address_2": "",
            						"city": "\u58eb\u5927\u592b",
           							"state": "CN3",
            						"postcode": "232",
            						"country": "CN"
          					}
        				}
     				 }
    			]
 		 }
	}
	
	
	最后提供一个小技巧 ，调试的时候在url后面输入 &dev=1 将会得到人性化输出。
