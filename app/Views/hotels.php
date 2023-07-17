<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .fa-star{
            color: yellow;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2>Hotels</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
        <?
        foreach($hotels as $hotel){
            $db = db_connect();
            $sq2 = "SELECT im.ImagePath FROM hotels h LEFT JOIN images im ON im.HotelId = h.Id WHERE h.Id = " .$hotel['Id']. " LIMIT 1";
            $res = $db->query($sq2);
            $imageRow = $res->getRow();
            $imagePath = '';

            if($imageRow != null){
                $imagePath = $imageRow->ImagePath;
            }
        ?>
        
            <div class="card mb-3">
                <div class="card-body">
                    <img style="object-fit: cover; height: 25vh;" src='<?= base_url("$imagePath") ?>' class="card-img-top" alt="<?php echo $hotel['HotelName']; ?>">
                    <h5 class="card-title"><?echo $hotel['HotelName']?></h5>
                    <p class="card-text"><?echo $hotel['City']?></p>
                    <p class="card-text"><?echo $hotel['Description']?></p>
                    <div class="stars">
                        <?
                            $stars = $hotel['Stars'];
                            for($i = 1; $i <= 5; $i++){
                                if ($i <= $stars) {
                                    echo '<p class="fa fa-star" id="star' . $i . '"></p>';
                                } else {
                                    echo '<p class="fa fa-star-o" id="star' . $i . '"></p>';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        
        <?
        }
        ?>
        </div>
        <a class="btn btn-outline-primary" href="/home/show_hotels">Back to search</a>
    </div>
</body>
</html>