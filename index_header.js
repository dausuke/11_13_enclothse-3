//インデックスページヘッダー
const index_header = {
    template: `
        <div class="header-content">
            <p>enclothes</p>
            <div class="action">
                <div class="siginin" v-on:click="signin"><i class="fas fa-sign-in-alt"></i>ログイン</div>
                <div class="usercreat" v-on:click='signup'><i class="fas fa-user-plus"></i>新規登録</div>
            </div>
        </div>
    `,
    methods: {
        signin: function () {
            window.location.href = 'signin/signin.php';
        },
        signup: function () {
            window.location.href = 'signup/signup.php';
        },
    },
};
const header = new Vue({
    el: '#index-header',
    components: {
        'index-header': index_header
    },
});
