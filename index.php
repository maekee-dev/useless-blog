<?php 
    $query = '
    query {
        posts {
          edges {
            node {
              title
              excerpt
              slug
            }
          }
        }
      }
    ';

    $ch = curl_init('https://wordpress-endpoint.diegomantegazza.me/graphql');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array('query' => $query)));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    /*print_r($data);*/
    $titolo = [];
    $paragraph = [];
    $url = [];
    for ($i=0; $i < 3; $i++) { 
        $titolo[$i] = $data['data']['posts']['edges'][$i]['node']['title'];
        $paragraph[$i] = $data['data']['posts']['edges'][$i]['node']['excerpt'];
        if (strlen($paragraph[$i]) > 80) {
            $paragraph[$i] = substr($paragraph[$i], 0, 70) . "...";
        }
        $url[$i] = $data['data']['posts']['edges'][$i]['node']['slug'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/index.css">
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
    <title>Home - Useless Blog</title>
</head>
<body>
    <main>
        <div class="hero-container">
            <div class="hero-block">
                <div class="hero-header"></div>
                <div class="hero-body">
                    <div class="hero-image"></div>
                    <div class="text-container">
                        <h1>This is a Test Page for 'REST API WordPress Headless w/GraphQL'</h1>
                        <p>Mini useless blog created with Wordpress (as headless CMS) and GraphQL. The three posts you see here are the latest posts published. Click on one of them to open the related page.</p>
                        <p>I don't have anything else to say so sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                </div>
                <div class="hero-footer">
                    <div class="footer-link">
                        <a href="/all">See articles</a>
                    </div>
                    <div class="footer-link">
                        <a href="https://diegomantegazza.me">My website <img src="/assets/img/arrow-icon.png" style="width: 19px; height: 19px;" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="blog-container">
            <div class="blog-item">
                <h2><?php echo $titolo[0] ?></h2>
                <p><?php echo $paragraph[0] ?></p>
                <a href="/articles?art=<?php echo $url[0] ?>">Read more</a>
            </div>
            <div class="blog-item">
                <h2><?php echo $titolo[1] ?></h2>
                <p><?php echo $paragraph[1] ?></p>
                <a href="/articles?art=<?php echo $url[1] ?>">Read more</a>
            </div>
            <div class="blog-item">
                <h2><?php echo $titolo[2] ?></h2>
                <p><?php echo $paragraph[2] ?></p>
                <a href="/articles?art=<?php echo $url[2] ?>">Read more</a>
            </div>
        </div>
        </div>
    </main>
</body>
</html>