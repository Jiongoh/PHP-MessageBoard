# PHP-MessageBoard
基于PHP和Javascript的留言板小项目/Message board mini project based on PHP and Javascript

# 在线链接
http://123.249.18.208/homework/login.html

## 用户注册
用form表达记录用户的输出，post方法提交到register.php。register.php脚本则负责连接到数据库，首先检测账号是否已经存在，如果账号重名则将数据无法写入数据库，并跳转回register.html，如果账号没有重名，则将数据插入数据表中，显示“成功注册”，并跳转至login.html


## 找回密码
用户需要在页面输入账号名，并且重复输出两次新密码，使用javascript阻止表单内的按钮的默认提交行为，检测两次密码输入是否一致，必须一直才能向retrieve.php发送post请求，retrieve.php脚本负责连接到usermsg数据表，由SQL语句根据账户名更新密码，如果成功更新则清除域名下的cookie并且跳转login.html，如果更新失败则输出“用户不存在”，并将页面跳转至retrieve.html

## 读取数据库信息放到页面中
通过javascript向readmsg.php发送GET类型的AJAX请求，readmsg.php连接数据库并读取内容，用echo输出。AJAX请求成功将获取到的数据插入到页面的table标签中


## 管理员页面实现
在admin.html中，留言展示区的数据已经通过adminRead.php读取并放入到tbody标签中，其中增加了Delete和Modify两个a标签，其href属性携带了唯一标识此留言信息的t_id的query参数，分别指向deleteMsg.php和modifyMsg.php。
管理员点击Delete链接，则会携带t_id的query参数跳转至deleteMsg.php，deleteMsg.php脚本需要先用GET方法获取t_id参数。deleteMsg.php负责连接msgdata数据表，由SQL语句根据获得t_id参数删除数据，如果成功则直接刷新admin.html，失败则返回错误。
管理员点击Modify链接，则会携带t_id的query参数跳转至ModifyMsg.php，ModifyMsg.php脚本需要先用GET方法获取t_id参数。ModifyMsg.php负责连接msgdata数据表，由SQL语句根据获得t_id参数筛选数据，根据筛选出的数据，转化成json格式并输出。在admin.html中，发送GET方法的AJAX请求到modifyMsg.php，获取到a标签，根据innerHTML筛选Modify的链接。遍历Modify链接，阻止其默认事件，根据其href携带了query参数的路径继续发送GET方法的AJAX请求，获取到的响应数据即为modifyMsg.php输出的JSON格式的数据。在页面中准备一个display为none的隐藏input标签，通过javascript获取到，用于写入留言的唯一标识id。将响应数据全部填入表单中的input输入框内。如果没有正确获取到响应数据则在另一个div容器内显示“Error”。

## 关于Cookie
用户登陆时，根据用户性质发送名为"user"的cookie，管理员的值为"admin"，普通用户的值为"normal"，时间设置为7天。用户找回密码和用户在主页点击退出按钮回清空cookie


