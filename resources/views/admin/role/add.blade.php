<!DOCTYPE html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title>角色添加页面</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        {{--表达验证 post提交token--}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('admin.public.styles')
    <!--<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"> 改成本地js</script>-->
        <script language="javascript" src="{{ asset('admin/js/jquery.min.js') }}" charset="utf-8" ></script>

        <script language="javascript" src="{{ asset('admin/lib/layui/layui.js') }}" charset="utf-8"></script>
        <!--[if lt IE 9]>
        <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
        <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
    <script language="javascript" src="{{ asset('admin/js/xadmin.js') }}" charset="utf-8" ></script>
        <div class="layui-fluid">
            <div class="layui-row">
                <form class="layui-form">
                    <div class="layui-form-item">
                        <label for="L_email" class="layui-form-label">
                            <span class="x-red">*</span>角色</label>
                        <div class="layui-input-inline">
                            <input type="text" id="L_role" name="role" required="" lay-verify="email" autocomplete="off" class="layui-input"></div>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="x-red">*</span>请填入角色名</div></div>

                    <div class="layui-form-item">
                        <label for="L_phone" class="layui-form-label">
                            <span class="x-red">*</span>角色描述</label>
                        <div class="layui-input-inline">
                            <input type="text" id="L_role_explain" name="role_explain" required="" lay-verify="phone" autocomplete="off" class="layui-input"></div>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="x-red">*</span>角色描述说明</div></div>
                    <div class="layui-form-item">
                        <label for="L_repass" class="layui-form-label"></label>
                        <button class="layui-btn" lay-filter="add" lay-submit="">增加</button></div>
                </form>
            </div>
        </div>
        <script>layui.use(['form', 'layer','jquery'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;

                // //自定义验证规则
                // form.verify({
                //     nikename: function(value) {
                //         if (value.length < 5) {
                //             return '昵称至少得5个字符啊';
                //         }
                //     },
                //     pass: [/(.+){6,12}$/, '密码必须6到12位'],
                //     repass: function(value) {
                //         if ($('#L_pass').val() != $('#L_repass').val()) {
                //             return '两次密码不一致';
                //         }
                //     }
                // });

                //监听提交
                form.on('submit(add)', function(data) {
                    console.log(data);
                    //发异步，把数据提交给php
                    //ajax提交 token 在上面的代码中meta添加
                    // $.ajaxSetup({
                    //     headers:{
                    //         'X-CSRF-TOKEN' : $('meta[name="csrf-token]').attr('content')
                    //     }
                    // })
                     $.ajax({
                         type:'POST',
                         url : '{{ url("admin/role") }}',
                         dataType: 'json',
                         headers : {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
                         data:data.field,    //获取当前的layui表单提交的数据
                         success:function (data) {  //成功后的回调函数
                              //弹层提示添加成功，并刷新父页面
                              if (data.status == 0){
                                  layer.alert(data.message,{icon:6},function () {
                                      //自动刷新父页面
                                      parent.location.reload(true);
                                  });
                              }else {
                                  layer.alert(data.message,{icon:5})
                              }
                           },
                         error:function () {
                             //错误信息
                             console.log(data);
                           }
                         });


                    // layer.alert("增加成功", {
                    //     icon: 6
                    // },
                    // function() {
                    //     //关闭当前frame
                    //     xadmin.close();
                    //
                    //     // 可以对父窗口进行刷新
                    //     xadmin.father_reload();
                    // });
                    return false;
                });

            });</script>

        <script>var _hmt = _hmt || []; (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();</script>
    </body>

</html>