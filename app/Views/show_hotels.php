<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        .button{
            display: flex;
            align-items:flex-end;
        }
        h2{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2>SEARCH HOTELS</h2>

        <div class="mb-3">
            <form action="/home/hotels" method="GET">
                <div class="row">
                    <div class="col-md-4">
                        <label for="city">City:</label>
                        <select class="form-select" aria-label="Default select example" name='cityId'>
                            <option value=0 selected>Choose city</option>
                            <?
                            $db = db_connect();
                            $sq = "SELECT * FROM cities";
                            $res = $db->query($sq);
                            foreach($res -> getResult("array") as $city){
                                echo "<option value='" . $city['Id'] . "'>" . $city['City'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="stars">Stars:</label>
                        <select class="form-select" aria-label="Default select example" name='stars' id="stars">
                            <option value=0 selected>Choose count of stars</option>
                            <option value=1>1</option>
                            <option value=2>2</option>
                            <option value=3>3</option>
                            <option value=4>4</option>
                            <option value=5>5</option>
                        </select>
                    </div>
                    <div class="col-md-4 button">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>