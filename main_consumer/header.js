//ヘッダー(PC画面)
const main_header = {
    template: `
        <div class="header-content">
            <p>enclothes</p>
            <div class="action">
                <div class="siginout" v-on:click="signout"><i class="fas fa-sign-out-alt"></i></i>ログアウト</div>
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
        'main-header': main_header
    },
});