<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Movies</title>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <style>
			ul.red h1 a { color:#F00; }
			ul.green h1 a { color:#0C0; }
			ul.blue h1 a { color:#06C; }
			ul.yellow h1 a { color:#FC3; }
		</style>
	</head>
	<body>
    	<div class="container">
        <?php
		function display_movies($color){
			$apikey = 'htvxvzz4bzvzkh5582cb6djz';
			$q = urlencode($color); // make sure to url encode an query parameters
			
			// construct the query with our apikey and the query we want to make
			$endpoint = 'http://api.rottentomatoes.com/api/public/v1.0/movies.json?apikey=' . $apikey . '&q=' . $q.'&page_limit=7';
			
			// setup curl to make a call to the endpoint
			$session = curl_init($endpoint);
			
			// indicates that we want the response back
			curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
			
			// exec curl and get the data back
			$data = curl_exec($session);
			
			// remember to close the curl session once we are finished retrieveing the data
			curl_close($session);
			
			// decode the json data to make it easier to parse the php
			$search_results = json_decode($data);
			if ($search_results === NULL) die('Error parsing json');
			
			// return data
			$movies = $search_results->movies;
			return($movies);
		}
		?>
        
        	<ul class="list-group red">
			<?php
            //RED
            $movies = display_movies('red');
            foreach ($movies as $movie) {
            ?>
                
                <li class="list-group-item">
                    <h1><?php echo '<a href="' . $movie->links->alternate . '" target="_blank">' . $movie->title.'</a>'; ?></h1>
                    <p>Year: <?php echo $movie->year ?><br>Runtime: <?php echo $movie->runtime ?> minutes</p>
                </li>
            <?php } ?>
        	</ul>
        
        	<ul class="list-group green">
			<?php
            //GREEN
            $movies = display_movies('green');
            foreach ($movies as $movie) {
            ?>
                <li class="list-group-item">
                    <h1><?php echo '<a href="' . $movie->links->alternate . '" target="_blank">' . $movie->title.'</a>'; ?></h1>
                    <p>Year: <?php echo $movie->year ?><br>Runtime: <?php echo $movie->runtime ?> minutes</p>
                </li>
			<?php } ?>
        	</ul>
         	
            <ul class="list-group blue">
			<?php
            //BLUE
            $movies = display_movies('blue');
            foreach ($movies as $movie) {
            ?>
        	    <li class="list-group-item">
                    <h1><?php echo '<a href="' . $movie->links->alternate . '" target="_blank">' . $movie->title.'</a>'; ?></h1>
                    <p>Year: <?php echo $movie->year ?><br>Runtime: <?php echo $movie->runtime ?> minutes</p>
                </li>
			<?php } ?>
        	</ul>
            
            <ul class="list-group yellow">
			<?php
            //YELLOW
            $movies = display_movies('yellow');
            foreach ($movies as $movie) {
            ?>
        	    <li class="list-group-item">
                    <h1><?php echo '<a href="' . $movie->links->alternate . '" target="_blank">' . $movie->title.'</a>'; ?></h1>
                    <p>Year: <?php echo $movie->year ?><br>Runtime: <?php echo $movie->runtime ?> minutes</p>
                </li>
			<?php } ?>
        	</ul>      
        </div>
    </body>
</html>