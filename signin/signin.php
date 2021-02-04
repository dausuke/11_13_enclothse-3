<?php

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signin.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>enclothes</title>
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- <script src="../action.js"></script> -->
    <div id="signin">
    <header>
        <div class="header-content">
            <a href="../index.php" class="top">enclothes</a>
            <ul class="selectnav" id="selectnav">
                <li class="selectuser" v-on:click="change('1')" v-bind:class="{'none': isActive === '1'}">
                    販売員の方はこちら
                </li>
                <li class="selectuser" v-on:click="change('0')" v-bind:class="{'none': isActive === '0'}">
                    ユーザーの方はこちら
                </li>
            </ul>
        </div>
    </header>
    <main>
    <div class="content" id="user" v-if="isActive === '0'">
        <div class="login-introducton">
            <h2><i class="fas fa-sign-in-alt"></i>ユーザーサインイン</h2>
            <h2>enclothes</h2>
            <h3>人と物の出会いで、新たな価値を創造する</h3>
        </div>
        <div class="signinform">
            <form action="signin_act.php" method="POST" id="signinForm">
                <fieldset class="signin-content" >
                    <div class="signinarea form-group">
                        <input type="text" name="email" class="form-control" placeholder="メールアドレス" autocomplete="off" v-model="userInfo.email">
                        <span class="textwarning" v-show="checkMail">OK</span>
                        <span class="textwarning" v-show="!checkMail">メールアドレスの形式が正しくありません</span>
                    </div>
                    <div class="signinarea form-group">
                        <input type="password" class="form-control" name="pass" placeholder="パスワード" v-model="userInfo.password">
                        <input type="hidden" class="form-control" name="attribute" value="0">
                    </div>
                    <div class="form-group">
                        <button class="signinbtn form-control">ログイン</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <div class="content" id="salesperson" v-if="isActive === '1'">
        <div class="login-introducton">
            <h2><i class="fas fa-sign-in-alt"></i>販売員サインイン</h2>
            <h2>enclothes</h2>
            <h3>人と物の出会いで、新たな価値を創造する</h3>
        </div>
        <div class="signinform">
            <form action="signin_act.php" method="POST" >
                <fieldset class="signin-content">
                    <div class="signinarea form-group">
                        <input type="text" name="email" class="form-control" placeholder="メールアドレス" autocomplete="off" v-model="userInfo.email">
                        <span class="textwarning" v-show="checkMail">OK</span>
                        <span class="textwarning" v-show="!checkMail">メールアドレスの形式が正しくありません</span>
                    </div>
                    <div class="signinarea form-group">
                        <input type="password" class="form-control" name="pass" placeholder="パスワード" v-model="userInfo.password">
                        <input type="hidden" class="form-control" name="attribute" value="1">
                    </div>
                    <div class="form-group">
                        <button class="signinbtn form-control">ログイン</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    </main>
    </div>

    <script>
    //画面の切り替えとバリデーション
    const selectnav = new Vue({
        el: '#selectnav',
        data: {
            isActive: '0'
        },
        methods: {
            change: function(num){
            this.isActive = num
            user.isActive = num
            salesperson.isActive = num
            }
        }
    })
    const user = new Vue({
        el:'#user',
        data: {
            isActive: '0',
            userInfo:{
                email: "",
                password: ""
            }
        },
        computed: {
            checkMail:function(){
                const regexp = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}\.[A-Za-z0-9]{1,}$/;
                return regexp.test(this.userInfo.email)
            },
        }
    })
    const salesperson = new Vue({
        el:'#salesperson',
        data: {
            isActive: '0',
            userInfo:{
                email: "",
                password: ""
            }
        },
        computed: {
            checkMail:function(){
                const regexp = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}\.[A-Za-z0-9]{1,}$/;
                return regexp.test(this.userInfo.email)
            },
        }
    })

    </script>
</body>
</html>