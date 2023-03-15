<?php 
    ini_set('display_errors', 0);
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        $article_name = $_GET['art'];
        $query = '
        {
        post(id: "'.$article_name.'", idType: SLUG) {
          author {
            node {
              nickname
            }
          }
          excerpt(format: RENDERED)
          title
          content(format: RENDERED)
        }
        }
        ';
        $ch = curl_init('https://wordpress-endpoint.diegomantegazza.me/graphql');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(
            'query' => $query,
            'variables' => array(
                'postName' => $postName
            )
        )));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        /*print_r($data);*/
        $titolo = $data['data']['post']['title'];
    }else {
        header('Location: useless-blog.diegomantegazza.me');
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/article.css">
    <link rel="stylesheet" href="/assets/css/general.css">
    <link rel="shortcut icon" href="/favicon.ico">
	<link rel="icon" sizes="16x16 32x32 64x64" href="/assets/img/icon/favicon.ico">
	<link rel="icon" type="image/png" sizes="196x196" href="/assets/img/icon/favicon-192.png">
	<link rel="icon" type="image/png" sizes="160x160" href="/assets/img/icon/favicon-160.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/assets/img/icon/favicon-96.png">
	<link rel="icon" type="image/png" sizes="64x64" href="/assets/img/icon/favicon-64.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/assets/img/icon/favicon-32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/assets/img/icon/favicon-16.png">
	<link rel="apple-touch-icon" href="/assets/img/icon/favicon-57.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/assets/img/icon/favicon-114.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/assets/img/icon/favicon-72.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/assets/img/icon/favicon-144.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/assets/img/icon/favicon-60.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/assets/img/icon/favicon-120.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/assets/img/icon/favicon-76.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/assets/img/icon/favicon-152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/assets/img/icon/favicon-180.png">
	<meta name="msapplication-TileColor" content="#32322E">
	<meta name="msapplication-TileImage" content="/assets/img/icon/favicon-144.png">
	<meta name="msapplication-config" content="/assets/img/icon/browserconfig.xml">
    <title>Useless Blog - <?php echo $titolo ?></title>
</head>
<body>
    <main>
        <div class="hero-container">
            <div class="hero-block">
                <div class="hero-header"></div>
                <div class="hero-body">
                    <h1> <?php echo $titolo ?></h1>
                    <?php echo $data['data']['post']['content']; ?>
                </div>
                <div class="hero-footer">
                    <div class="footer-link">
                        <a href="/">Homepage</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>