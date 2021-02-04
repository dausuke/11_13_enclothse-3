<?PHP
session_start();
ini_set('display_errors', 1);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="css/index.css">
    <title>enclothse</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <header id="index-header">
        <index-header></index-header>
    </header>
    <div class="indexpage">
        <div class="introduction">
            <h1>enclothes</h1>
            <h2>
            <span class="text-1">人と物の出会いで</span>
            <span class="text-2">新たな価値を創造する</span>
            </h2>
            <section>
                <p>何を着たら良いかわからない。</p>
                <p>自分に似合う服がわからない。</p>
                <p>そんな悩みを、洋服のプロフェッショナルが解決します。</p>
                <p>enclothesでワクワクするような、服との出会いを見つけませんか。</p>
            </section>
        </div>
    </div>
    <script src="index_header.js"></script>
</body>
</html>