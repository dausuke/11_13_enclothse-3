<?php
session_start();
include('../functions.php');
check_session_id();
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8" />
        <meta
            name="viewport"
            content="width=device-width,initial-scale=1.0,minimum-scale=1.0"
        />
        <script src="https://kit.fontawesome.com/ae83ec2059.js" crossorigin="anonymous"></script>
        <!-- <link
            rel="stylesheet"
            href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        /> -->
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="../css/comsumer.css" />
        <title>consumerpage</title>
    </head>
    <body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"
        ></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"
        ></script>
        <script src="https://cdn.jsdelivr.net/npm/axios@0.18.0/dist/axios.min.js"></script>
        <div id="main-content">
            <component :is="currentPage"　class="display-content"></component>
            <nav class="navbar navbar-expand-sm navbar-light" style="background-color:white;" >
                <div class="navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item" v-on:click="changePage('home')">
                            <i class="fas fa-home fa-2x"></i><span class="navi" >ホーム</span>
                        </li>
                        <li class="nav-item" v-on:click="changePage('search')">
                            <i class="fas fa-search fa-2x"></i><span class="navi" >検索</span>
                        </li>
                        <li class="nav-item" v-on:click="changePage('stylest')">
                            <i class="fas fa-people-arrows fa-2x"></i><span class="navi" >マイスタイリスト</span>
                        </li>
                        <li class="nav-item" v-on:click="changePage('mypage')">
                            <i class="fas fa-user fa-2x"></i><span class="navi" >マイページ</span>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <script src="consumer_js/main_consumer.js"></script>
    </body>
</html>
