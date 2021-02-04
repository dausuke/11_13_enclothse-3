const dashboard_page = {
    template: `
        <div class="dashboard-page">
            <span>１日のデータ</span>
            <div class="dashboard-content">
                <div class="dashboard-item">
                    <div class="dashboard-frequency"></div>
                    <div class="dashboard-title">代行回数</div>
                    <div class="dashboard-data">3</div>
                </div>
                <div class="dashboard-item">
                    <div class="dashboard-amount"></div>
                    <div class="dashboard-title">売上金額</div>
                    <div class="dashboard-data">110,100</div>
                </div>
                <div class="dashboard-item">
                    <div class="dashboard-unitprice"></div>
                    <div class="dashboard-title">平均単価</div>
                    <div class="dashboard-data">36,700</div>
                </div>
            </div>
            <div class="recent-transaction">
                <span>直近の取引５件</span>
                <div class="transaction">
                    <div class="transaction-date"></div>
                    <div class="transaction-shop"></div>
                    <div class="transaction-amount"></div>
                </div>
            </div>
        </div>
    `,
};
//画面の切り替え実行（トグルメニューのクリックに応じてメソッド発火）
const cotent = new Vue({
    data: {
        currentPage: 'dashboard',
    },
    el: '#main-content',
    components: {
        "dashboard": dashboard_page, //ダッシュボード（ホーム画面）
        // article: article_page, //記事投稿
        // entry: entry_page, //販売員登録
        // config: salesperson_detail_page, //設定
    },
    methods: {
        changePage: function (page) {
            this.currentPage = page;
        },
    },
});
