<?php
    include "functions.php";
    if (!access_token_exist()) {
        $token_id = token_data_create();
        header('Location: /?tkid='.$token_id, true, 307);
    }
?>
<html>
    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.bundle.min.js" integrity="sha384-VspmFJ2uqRrKr3en+IG0cIq1Cl/v/PHneDw6SQZYgrcr8ZZmZoQ3zhuGfMnSR/F2" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0-beta.2/journal/bootstrap.min.css" rel="stylesheet" integrity="sha384-yFdRSqOUsIuNXAuTjcNpqulUmbDTPw39dNNtFnKPvCZAQ8iQApD6VWRs/I3MRmJf" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script>
            var tkid = "<?php echo $_GET['tkid']; ?>";
        </script>
        <script src="process.js"></script>

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-success mb-3">
                                <div class="card-header">
                                    <button onclick="addUser()" id="add_user" type="button" class="btn btn-success">Add user</button>
                                    <input style="display: none" type="file" id="user_file" />
                                </div>
                                <div class="card-body text-success" id="add_user_body" style="display: none">
                                    <div class="form-group">
                                        <form method="post" class="add_stuff" data-type="user">
                                            <label class="col-form-label" for="inputDefault">Input name</label>
                                            <input name="name" type="text" class="form-control" placeholder="Name" id="user_name" required>
                                            <label for="exampleTextarea">Input food he won't eat</label>
                                            <input name="foods" class="form-control" id="user_foods" rows="2" placeholder="Foods he won't eat" required></input>
                                            <label for="exampleTextarea">Input Drinks</label>
                                            <input name="drinks" class="form-control" id="user_drinks" rows="2" placeholder="Drinks he likes" required></input>
                                            <button style="margin-top: 10px" type="submit" class="btn btn-success">Submit user</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-secondary mb-3">
                                <div class="card-header">
                                    <span>Users</span>
                                </div>
                                <div class="card-body text-secondary">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Won't eat</th>
                                            <th scope="col">Drinks</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $users = get_users($_GET['tkid']);
                                                foreach ($users as $user) {
                                                    echo "
                                                        <tr>
                                                            <td>".$user['name']."</td>
                                                            <td>".$user['foods']."</td>
                                                            <td>".$user['drinks']."</td>
                                                        </tr>
                                                    ";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-success mb-3">
                                <div class="card-header">
                                    <button onclick="addVenue()" id="add_venue" type="button" class="btn btn-success">Add venue</button>
                                    <input style="display: none" type="file" id="venue_file" />
                                </div>
                                <div class="card-body text-success" id="add_venue_body" style="display: none">
                                    <div class="form-group">
                                        <form method="post" class="add_stuff" data-type="venue">
                                            <label class="col-form-label" for="inputDefault">Input name</label>
                                            <input name="name" type="text" class="form-control" placeholder="Name" id="venue_name" required>
                                            <label for="exampleTextarea">Input food</label>
                                            <input name="foods" class="form-control" id="venue_foods" rows="2" placeholder="Food they serve" required>
                                            <label for="exampleTextarea">Input Drinks</label>
                                            <input name="drinks" class="form-control" id="venue_drinks" rows="2" placeholder="Drinks they serve" required>
                                            <input style="margin-top: 10px" type="submit" class="btn btn-success" value="Submit venue">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-secondary mb-3">
                                <div class="card-header">
                                    <span>Venues</span>
                                </div>
                                <div class="card-body text-secondary">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Foods</th>
                                            <th scope="col">Drinks</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $venues = get_venues($_GET['tkid']);
                                                foreach ($venues as $venue) {
                                                    echo "
                                                        <tr>
                                                            <td>".$venue['name']."</td>
                                                            <td>".$venue['foods']."</td>
                                                            <td>".$venue['drinks']."</td>
                                                        </tr>
                                                    ";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-secondary mb-3">
                        <div class="card-header">
                            <span>Result</span>
<!--                            <button type="button" style="float: right" class="btn btn-success">Get results</button>-->
                        </div>
                        <div class="card-body text-secondary">
                            <table class="table table-hover" style="white-space:pre-wrap; word-wrap:break-word">
                                <thead>
                                <tr>
                                    <th scope="col">Venue name</th>
                                    <th scope="col">Resons</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $data = json_decode(get_file_data($_GET['tkid']),true);
                                        foreach ($data['venues'] as $venue){
                                            $ok_flag = 1;
                                            echo "
                                                <tr>
                                                    <td>".$venue['venue_name']."</td>
                                            ";
                                            echo "<td>";
                                            foreach ($data['users'] as $user){
                                                $foods = array_intersect(explode(",", $venue['venue_foods']), explode(",", $user['foods']));
                                                $drinks = array_intersect(explode(",", $venue['venue_drinks']), explode(",", $user['drinks']));
                                                if (count($drinks) == 0){
                                                    echo " ".$user['name']."  dosen't have anything to drink here. \r\n";
                                                    $ok_flag = 0;
                                                }
                                                if (count($foods) == count(explode(",", $user['foods']))){
                                                    echo " ".$user['name']." dosen't have anything to eat here. \r\n";
                                                    $ok_flag = 0;
                                                }
                                            }
                                            echo "</td>";
                                            if ($ok_flag == 0){
                                                echo "<td>Not recommended</td>";
                                            }
                                            else {
                                                echo "<td>Recommended</td>";
                                            }
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script>
            function addUser() {
                var x = document.getElementById("add_user_body");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
            
            function loadUser() {

            }

            function addVenue() {
                var x = document.getElementById("add_venue_body");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
            
            function loadVenue() {
                
            }
        </script>
    </body>
</html>