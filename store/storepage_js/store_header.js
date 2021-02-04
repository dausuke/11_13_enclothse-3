//ストアページヘッダー
var main_header = {
    template: `
        <div class="header-content">
            <p>enclothes for Busseness</p>
            <div class="action">
                <div class="signout" v-on:click="signout"><i class="fas fa-sign-out-alt"></i>ログアウト</div>
            </div>
        </div>
    `,

    methods: {
        signout: function () {
            window.location.href = '../signout.php';
        },
    },
};
const header = new Vue({
    el: '#main-header',
    components: {
        'headre-content': main_header,
    },
});
