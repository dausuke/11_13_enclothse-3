//トップページの店舗情報
let shop_data = [];
const top_page = {
    data: function () {
        return {
            data: shop_data,
        };
    },
    template: `
        <ul>
            <li v-for="shopcontent in data[0]">
            <article class="article-content" v-on:click="multipleMethods('shop_detail',shopcontent.shop_id)">
                <div class="photo-area">
                    <img class="photo" :src="shopcontent.photo">
                </div>
                <div class="shop-introduction-content">
                    <div class="shopname">{{shopcontent.shopname}}</div>
                    <div class="shopbrand">
                        <p>ブランド</p>
                        <span>{{shopcontent.brand1}}、{{shopcontent.brand2}}、{{shopcontent.brand3}}、{{shopcontent.brand4}}、{{shopcontent.brand5}}</span>
                        <p>エリア</p>
                        <span>{{shopcontent.area}}</span>
                        <p class="introduction">{{shopcontent.Introduction}}</p>
                    </div>
                </div>
            </article>
            </li>
        </ul>
    `,
    created: function () {
        axios
            .post('consumer_php/shop_data.php')
            .then(function (res) {
                shop_data.push(res.data);
                console.log(shop_data[0]);
                shop_data = []; //配列の初期化
            })
            .catch(function () {
                // alert('通信エラー');
                // location.reload;
            });
    },
    methods: {
        //2つの関数を実行する関数
        multipleMethods: function (page, id) {
            this.changeDetialPage(page);
            this.postShopId(id);
        },
        //ページ切り替えの関数
        changeDetialPage: function (page) {
            cotent.currentPage = page;
        },
        //shop_idを受け渡す関数
        postShopId: function (id) {
            publicData.shop_id = id;
        },
    },
};
//店舗情報詳細
let shop_detail_data = [];
let key_data = [];
const shop_detail_page = {
    data: function () {
        return {
            data: shop_detail_data,
            shop_id: publicData.shop_id,
            judg_key: key_data,
        };
    },
    template: `
        <div class="shop-content">
            <div class="photo-area">
                <img class="photo" :src="data[0][0].photo">
            </div>
            <div class="shop-introduction-content">
                <div class="shopname">
                    <span>{{data[0][0].shopname}}</span>
                    <span v-on:click="creatFavorite">
                        <i v-if="this.judg_key[0]==0" class="fas fa-heart fa-1x favorite" id="heart_icon"></i>
                        <i v-else class="fas fa-heart fa-1x" id="heart_icon"></i>
                    </span>
                </div>
                <div>{{data[0][0].Introduction}}</div>
                <div class="shopbrand">
                    <p>ブランド</p>
                    <span>{{data[0][0].brand1}}、{{data[0][0].brand2}}、{{data[0][0].brand3}}、{{data[0][0].brand4}}、{{data[0][0].brand5}}、{{data[0][0].brand6}}、{{data[0][0].brand7}}、{{data[0][0].brand8}}、{{data[0][0].brand9}}、{{data[0][0].brand10}}</span>
                    <p>エリア</p>
                    <span>{{data[0][0].area}}</span>
                </div>
            </div>
            <div class="salesperson-area">
                <p>所属販売員</p>
                <ul>
                    <li v-for="salespersonData in data[0]">
                        <img :src="salespersonData.image"　class="salesperson-img">
                        <span>{{salespersonData.name}}</span><br>
                        <span>{{salespersonData.age}}歳　</span>
                        <span>経験ショップ：{{salespersonData.experience}}</span>
                    </li>
                </ul>
            </div>
        </div>
    `,
    created: function () {
        //店舗のデータ受信
        axios
            .get(`consumer_php/shop_detail_data.php?shop_id=${this.shop_id}`)
            .then(function (res) {
                shop_detail_data.push(res.data);
                console.log(shop_detail_data[0]);
                shop_detail_data = []; //配列の初期化
            })
            .catch(function () {
                // alert('通信エラー');
                // location.reload;
            });
        //いいねの色判定用
        axios
            .get(`consumer_php/judg_favorite.php?shop_id=${this.shop_id}`)
            .then(function (res) {
                key_data.push(res.data);
                console.log(res.data);
                key_data = [];
            })
            .catch(function () {
                // alert('通信エラー');
                // location.reload;
            });
    },
    methods: {
        //いいね処理
        creatFavorite: function () {
            //アイコンのクラスの存在を判定して色のつけ外し
            const icon = document.getElementById('heart_icon');
            if (icon.classList.contains('favorite')) {
                icon.classList.remove('favorite');
            } else {
                icon.classList.add('favorite');
            }
            //いいね処理
            axios
                .get(`consumer_php/favorite.php?shop_id=${this.shop_id}`)
                .then(function (res) {
                    console.log(res);
                })
                .catch(function () {
                    // alert('通信エラー');
                    console.log(res);
                });
        },
        // //2つの関数を実行する関数
        // multipleMethods: function (page, id) {
        //     this.changeDetialPage(page);
        //     this.postShopId(id);
        // },
        // //ページ切り替えの関数
        // changeDetialPage: function (page) {
        //     cotent.currentPage = page;
        // },
        // //shop_idを受け渡す関数
        // postShopId: function (id) {
        //     publicData.stylest_id = id;
        // },
    },
};
//検索結果表示エリア
const searchdate_area = {
    props: ['data'],
    template: `
        <div class="searchdata-area">
            <ul>
                <li v-for="shopcontent in data[0]">
                    <article class="article-content" v-on:click="multipleMethods('shop_detail',shopcontent.shop_id)">
                        <div class="photo-area">
                            <img class="photo" :src="shopcontent.photo">
                        </div>
                        <div class="shop-introduction-content">
                            <div class="shopname">{{shopcontent.shopname}}</div>
                            <div class="shopbrand">
                                <p>ブランド</p>
                                <span>{{shopcontent.brand1}}、{{shopcontent.brand2}}、{{shopcontent.brand3}}、{{shopcontent.brand4}}、{{shopcontent.brand5}}</span>
                                <p>エリア</p>
                                <span>{{shopcontent.area}}</span>
                                <p class="introduction">{{shopcontent.Introduction}}</p>
                            </div>
                        </div>
                    </article>
                </li>
            </ul>
        </div>
    `,
    methods: {
        //2つの関数を実行する関数
        multipleMethods: function (page, id) {
            this.changeDetialPage(page);
            this.postShopId(id);
        },
        //ページ切り替えの関数
        changeDetialPage: function (page) {
            cotent.currentPage = page;
        },
        //shop_idを受け渡す関数
        postShopId: function (id) {
            publicData.shop_id = id;
        },
    },
};
//検索ページ
let search_shop_data = [];
const search_page = {
    data: function () {
        return {
            data: search_shop_data,
            search_word: '',
        };
    },
    template: `
        <form>
            <div class="form-group shop-search">
                <input type="text" class="form-control search-shop" placeholder="お店を検索" v-model="search_word" >
                <button type="button" class="form-control search-button" v-on:click="search_methods">検索</button>
            </div>
            <searchdata-area　:data="data"></searchdata-area>
        </form>
    `,
    methods: {
        search_methods: function () {
            axios
                .get(
                    `consumer_php/search_shop.php?searchWord=${this.search_word}`
                )
                .then(function (res) {
                    search_shop_data.push(res.data);
                    console.log(search_shop_data);
                    search_shop_data = []; //配列の初期化
                })
                .catch(function () {
                    // alert('通信エラー');
                    // location.reload;
                });
        },
    },
    components: {
        'searchdata-area': searchdate_area,
    },
};
//スタイリスト画面
let stylest_data = [];
const mystylest_page = {
    data: function () {
        return {
            data: stylest_data,
        };
    },
    template: `
        <div class="salesperson-detail-content">
            <p　class="stylest-title">スタイリスト一覧</p>
            <ul>
                <li v-for="stylestData in data[0]" >
                    <div class="profile">
                        <img :src=stylestData.image class="stylest-img">
                        <dl>
                            <div>
                                <dt>氏名</dt>
                                <dd>{{stylestData.name}}</dd>
                            </div>
                            <div>
                                <dt>所属ショップ</dt>
                                <dd>{{stylestData.shop}}</dd>
                            </div>
                        </dl>
                    </div>
                </li>
            </ul>
        </div>
    `,
    created: function () {
        axios
            .post('consumer_php/stylest.php')
            .then(function (res) {
                stylest_data.push(res.data);
                console.log(res.data);
                stylest_data = []; //配列の初期化
            })
            .catch(function (res) {
                // alert('通信エラー');
                console.log(res);
                // location.reload;
            });
    },
    // methods: {
    //     //2つの関数を実行する関数
    //     multipleMethods: function (page, id) {
    //         this.changeDetialPage(page);
    //         this.postShopId(id);
    //     },
    //     //ページ切り替えの関数
    //     changeDetialPage: function (page) {
    //         cotent.currentPage = page;
    //     },
    //     //shop_idを受け渡す関数
    //     postShopId: function (id) {
    //         publicData.stylest_id = id;
    //     },
    // },
};
// //スタイリスト（販売員）詳細画面
// let stylest_detail_data;
// const stylest_detail_page = {
//     data: function () {
//         return {
//             data: stylest_detail_data,
//             stylest_id:publicData.stylest_id
//         };
//     },
//     template: `
//         <div class="profile">
//             <img :src=stylestData.image class="stylest-img">
//                 <dl>
//                     <div>
//                         <dt>氏名</dt>
//                         <dd>{{stylestData.name}}</dd>
//                     </div>
//                     <div>
//                         <dt>所属ショップ</dt>
//                         <dd>{{stylestData.shop}}</dd>
//                     </div>
//                 </dl>
//         </div>
//     `,
//     created: function () {
//         axios
//             .post(`consumer_php/stylest_ditail_data.php?stylest_id=${this.stylest_id}`)
//             .then(function (res) {
//                 stylest_detail_data=res.data;
//                 console.log(res.data);
//             })
//             .catch(function (res) {
//                 // alert('通信エラー');
//                 console.log(res);
//                 // location.reload;
//             });
//     },
// };
//マイページ
let consumer_data = [];
let img_data = []; //画像表示用
const my_page = {
    data: function () {
        return {
            data: consumer_data,
            img_data: img_data,
        };
    },
    template: `
        <div>
            <div class="account">
                <img :src=img_data[0] class="consumer-img">
                <span>{{data[0].name}}</span>
            </div>
            <div class="account-item">
                <div class="icon">
                    <i class="fas fa-heart fa-2x"></i>
                </div>
                <div class="account-item-title">
                    <span v-on:click="changeMypage('mypage_favorite')">お気に入り</span>
                </div>
            </div>
            <div class="account-item">
                <div class="icon">
                    <i class="fas fa-exchange-alt fa-2x"></i>
                </div>
                <div class="account-item-title">
                    <span v-on:click=changeMypage()>取引</span>
                </div>
            </div>
            <div class="account-item">
                <div class="icon">
                    <i class="fas fa-tshirt fa-2x"></i>
                </div>
                <div class="account-item-title">
                    <span v-on:click="changeMypage('mypage_coordinate')">コーディネート</span>
                </div>
            </div>
            <div class="account-item">
                <div class="icon">
                    <i class="fas fa-check-circle fa-2x"></i>
                </div>
                <div class="account-item-title">
                    <span v-on:click="changeMypage('mypage_config')">設定</span>
                </div>
            </div>
        </div>
    `,
    created: function () {
        axios
            .post('consumer_php/consumer.php')
            .then(function (res) {
                consumer_data.push(res.data);
                const image = res.data.img.slice(3);
                img_data.push(image);
                // console.log(image);
                consumer_data = []; //配列の初期化
            })
            .catch(function (res) {
                // alert('通信エラー');
                console.log(res);
                // location.reload;
            });
    },
    methods: {
        changeMypage: function (page) {
            cotent.currentPage = page;
        },
    },
};
//マイページの詳細
//お気に入りショップ
let favorite_shop_data = [];
const my_favorite_page = {
    data: function () {
        return {
            data: favorite_shop_data,
        };
    },
    template: `
        <ul>
            <li v-for="shopcontent in data[0]">
            <article class="article-content" v-on:click="multipleMethods('shop_detail',shopcontent.shop_id)">
                <div class="photo-area">
                    <img class="photo" :src="shopcontent.photo">
                </div>
                <div class="shop-introduction-content">
                    <div class="shopname">{{shopcontent.shopname}}</div>
                    <div class="shopbrand">
                        <p>エリア</p>
                        <span>{{shopcontent.area}}</span>
                        <p class="favorite-introduction">{{shopcontent.Introduction}}</p>
                </div>
            </article>
            </li>
        </ul>
    `,
    created: function () {
        axios
            .post('consumer_php/favorite_shop_data.php')
            .then(function (res) {
                console.log(res);
                favorite_shop_data.push(res.data);
                favorite_shop_data = []; //配列の初期化
            })
            .catch(function (res) {
                console.log(res);
            });
    },
    methods: {
        //2つの関数を実行する関数
        multipleMethods: function (page, id) {
            this.changeDetialPage(page);
            this.postShopId(id);
        },
        //ページ切り替えの関数
        changeDetialPage: function (page) {
            cotent.currentPage = page;
        },
        //shop_idを受け渡す関数
        postShopId: function (id) {
            publicData.shop_id = id;
        },
    },
};
//コーディネート
let coordinate_img_data = [];
const my_coordinate_page = {
    data: function () {
        return {
            data: coordinate_img_data,
            creat_coordinate_data: null,
            preview_url: null,
            post_coordinate_data: null,
            confirm: false,
            modal: false,
        };
    },
    template: `
        <div>
            <p　class="coordinate-title">コーディネート一覧</p>
            <ul　class="coordinate-area">
                <li v-for="coordinate_img in data" class="coordinate-item">
                    <img v-if="typeof coordinate_img != 'undefined'" :src=coordinate_img class="coordinate-content">
                </li>
                <li class="add-coordinate">
                    <label for="file_upload">
                        <i class="fas fa-plus fa-4x"></i>
                        <input v-on:change="selectCoordinate" type="file" id="file_upload" class="file-upload">
                    </label>
                </li>
            </ul>
            <div v-if="modal" class="coordinate-modal">
                <img :src=preview_url class="modal-coordinate-content">
                <div class="form-group submit-btn">
                    <button v-show="this.confirm" v-on:click="creatCoordinate" class="form-control coordinate-edit-submit">投稿する</button>
                </div>
            </div>
        </div>
    `,
    created: function () {
        axios
            .post('consumer_php/read_coordinate_data.php')
            .then(function (res) {
                console.log(res.data);
                const respos_data = res.data;
                respos_data.forEach(function (val) {
                    const tag = val.coordinat_img.slice(3);
                    coordinate_img_data.push(tag);
                });
                coordinat_img_data = []; //配列の初期化
            })
            .catch(function (res) {
                console.log(res);
            });
    },
    methods: {
        openModal: function () {},
        //選択された画像の情報を取得
        selectCoordinate: function (e) {
            this.modal = true;
            e.preventDefault();
            console.log(e.target.files);
            const files = e.target.files || e.dataTransfer.files;
            this.creat_coordinat_data = files[0];
            this.createImage(files[0]);
            this.confirm = true;
        },
        // アップロードした画像を表示
        createImage(file) {
            this.preview_url = URL.createObjectURL(file);
        },
        //画像投稿
        creatCoordinate: function (e) {
            //FormData を利用して File を POST する
            const file_data = this.creat_coordinat_data;
            const post_file_data = new FormData();
            post_file_data.append('image', file_data);
            let config = {
                headers: {
                    'content-type': 'multipart/form-data',
                },
            };
            axios
                .post(
                    'consumer_php/creat_coordinate_data.php',
                    post_file_data,
                    config
                )
                .then(function (res) {
                    console.log(res);
                    location.reload;
                })
                .catch(function (res) {
                    console.log(res);
                });
        },
    },
};
//設定
//画像編集時のモーダル
const modal = {
    props: {
        img_data: String,
        modal: Boolean,
    },
    data: function () {
        return {
            upload_image: true,
            preview_url: null,
            post_image_data: null,
            confirm: false,
        };
    },
    template: `
        <div v-if="modal" class="config-img-window">
            <div class="modal-icon">
                <span v-on:click="closeEvent"><i class="fas fa-times fa-2x"></i></span>
                <label for="file_upload" class="upload-label">
                    <i class="fas fa-camera fa-1x"></i>編集
                    <input v-on:change="changeImg" type="file" id="file_upload" class="file-upload">
                </label>
            </div>
            <img v-if="upload_image" :src=img_data class="consumer-config-img">
            <img v-else :src=preview_url class="consumer-config-img">
            <div class="form-group submit-btn">
                <button v-show="this.confirm" v-on:click="postImage" class="form-control profile-edit-submit">OK</button>
            </div>
        </div>
    `,

    methods: {
        //閉じる
        closeEvent: function () {
            this.$emit('closeModal');
        },
        //選択された画像の情報を取得

        changeImg: function (e) {
            e.preventDefault();
            console.log(e.target.files);
            const files = e.target.files || e.dataTransfer.files;
            this.post_image_data = files[0];
            this.createImage(files[0]);
            this.confirm = true;
            this.upload_image = false;
        },
        // アップロードした画像を表示
        createImage(file) {
            this.preview_url = URL.createObjectURL(file);
        },
        //画像をPOST
        postImage: function () {
            //FormData を利用して File を POST する
            const file_data = this.post_image_data;
            const post_file_data = new FormData();
            post_file_data.append('image', file_data);
            let config = {
                headers: {
                    'content-type': 'multipart/form-data',
                },
            };
            axios
                .post(
                    'consumer_php/edit_consumer_img.php',
                    post_file_data,
                    config
                )
                .then(function (res) {
                    console.log(res);
                })
                .catch(function (res) {
                    console.log(res);
                });
        },
    },
};
//登録情報変更
let consumer_config_data = []; //ユーザーデータ取得用
let consumerdata; //ユーザーデータ編集用
let config_img_data = []; //プロフィール画像表示用
const my_config_page = {
    data: function () {
        return {
            data: consumer_config_data,
            img_data: config_img_data,
            modal: false,
            config_data: {},
            consumer_data: consumer_config_data,
        };
    },
    template: `
        <div>
            <div class="config-title">
                <span>アカウントの編集</span>
            </div>
            <div v-on:click="openModal" class="config-img">
                <img :src=img_data[0] class="consumer-img">
                <p>{{data[0].name}}</p>
            </div>
            <open-modal :img_data=img_data[0] :modal=modal v-on:closeModal="closeModal"></open-modal>
            <form>
                <div class="form-group">
                    <label>エリア</label>
                    <input type="text" class="form-control" autocomplete="off" v-model="consumer_data[0].city">
                </div>
                <div class="form-group">
                    <label>メールアドレス</label>
                    <input type="text" class="form-control" autocomplete="off" v-model="consumer_data[0].email">
                </div>
                <div class="form-group">
                    <label>身長</label>
                    <input type="text" class="form-control" autocomplete="off" v-model="consumer_data[0].height">
                </div>
                <div class="form-group">
                    <label>体重</label>
                    <input type="text" class="form-control" autocomplete="off" v-model="consumer_data[0].weight">
                </div>
                <div class="form-group">
                    <label>よく買い物するお店</label>
                    <input type="text" class="form-control" autocomplete="off" v-model="consumer_data[0].shop">
                </div>
                <div class=" form-group submit-btn">
                    <button class="form-control profile-edit-submit" type="button" v-on:click="editProfile">送信</button>
                </div>
            </form>
        </div>
    `,
    created: function () {
        axios
            .post('consumer_php/consumer.php')
            .then(function (res) {
                consumer_config_data.push(res.data);
                console.log(res.data);
                const image = res.data.img.slice(3);
                config_img_data.push(image);
                consumer_config_data = []; //配列の初期化
            })
            .catch(function (res) {
                // alert('通信エラー');
                console.log(res);
                // location.reload;
            });
    },
    components: {
        'open-modal': modal,
    },
    methods: {
        editProfile: function () {
            axios
                .post('consumer_php/edit_consumer.php', {
                    data: this.consumer_data[0],
                })
                .then(function (res) {
                    // consumer_config_data.push(res.data);

                    console.log(res.data);
                    // consumer_config_data = []; //配列の初期化
                })
                .catch(function (res) {
                    // alert('通信エラー');
                    console.log(res);
                    // location.reload;
                });
        },
        openModal: function () {
            this.modal = true;
        },
        closeModal: function () {
            this.modal = false;
        },
    },
};
//非親子のコンポーネント間のデータ受け渡し
const publicData = new Vue({
    data: {
        shop_id: null,
        stylest_id: null,
    },
});
//画面の切り替え実行（メニューのクリックに応じてメソッド発火）
const cotent = new Vue({
    data: {
        currentPage: 'home',
    },
    el: '#main-content',
    components: {
        home: top_page, //トップ画面
        search: search_page, //検索画面
        stylest: mystylest_page, //スタイリスト（販売員）画面
        shop_detail: shop_detail_page, //店舗詳細
        // stylest_detail: stylest_detail_page, //スタイリスト（販売員）詳細画面
        mypage: my_page, //マイページ
        //マイページ内の切り替え先
        mypage_favorite: my_favorite_page, //お気に入りショップ
        // mypage_transaction: my_config_page, //取引
        mypage_coordinate: my_coordinate_page, //コーディネート
        mypage_config: my_config_page, //設定
    },
    methods: {
        changePage: function (page) {
            this.currentPage = page;
        },
    },
});
