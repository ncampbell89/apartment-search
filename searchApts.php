<?php
    require_once("conn/connApts.php");
    // load the buildings for the select menu
    $query = "SELECT IDbldg, bldgName FROM buildings ORDER BY bldgName ASC";
    $result = mysqli_query($conn, $query);
    echo mysqli_error($conn); // check to see if we have any errors yet
?>
<!DOCTYPE html>
<html lang="en-us">
    
<head>
    <title>Apartment Search</title>
    <link href="css/apts.css" rel="stylesheet">
</head>

<body>
    
    <div id="container">
    
        <h1>Apartment Search </h1>

        <!-- We use "get" here because we are only GETting information -->

        <form method="get" action="searchAptsProc.php" onsubmit="return validateMinMaxRent()">
            
            <p>Search: <input type="search" name="search" id="search"></p>
            
            <p>Building: 
                <select name="bldgID" id="bldgID">
                    <option value="-1">Any</option>
                    <?php
                        while($row=mysqli_fetch_array($result)) {
                            echo '<option value="' . $row['IDbldg'] . '">'  . $row['bldgName'] . '</option>';  
                        }
                    ?>
                </select>
            </p>

            <p>Min Rent: 

              <select name="minRent" id="minRent">
                <option value="0">Any</option>

                <?php 

                  $i = 1000;

                  while($i <= 5000) {
                    echo '<option value="' . $i . '">$' . number_format($i) . '</option>';
                    $i += 250;
                  }

                ?>

              </select>

            </p>

            <p>Max Rent: 
                <select name="maxRent" id="maxRent">
                  <option value="99999">Any</option>
                  <?php 
                    $i = 2000;
                    while($i <= 7500){
                      echo '<option value="' . $i . '">$' . number_format($i) . '</option>';
                      $i += 500;
                    }
                  ?>
                </select>
            </p>

            <p>Bedrooms: 
                <select name="bdrms" id="bdrms">
                    <option value="-1">Any</option>
                    <option value="0">Studio</option>
                    <option value="1">1 bedroom</option>
                    <option value="1.1">1+ bedroom</option>
                    <option value="2">2 bedrooms</option>
                    <option value="2.1">2+ bedrooms</option>
                    <option value="3">3 bedrooms</option>
                </select>
            </p>
            
            <p>Baths: 
              <select name="baths" id="baths">
                <option value="-1">Any</option>  
                <option value="1">1 Bath</option>
                <option value="1.5">1 1/2 Baths</option>
                <option value="1.6">1 1/2+ Baths</option>
                <option value="2">2 Baths</option>
                <option value="2.1">2+ Baths</option>
                <option value="2.5">2 1/2 Baths</option>
              </select>
            </p>

            <h2>Building Amenities</h2>

            <input type="checkbox" name="doorman" value="doorman" id="doorman" class="cbW">
            <label for="doorman">Doorman</label>
            
            <input type="checkbox" name="pets" value="pets" id="pets" class="cbW"> 
            <label for="pets">Pet-friendly</label>
            <br/><br/>
            <input type="checkbox" name="parking" value="parking" id="parking" class="cbW"> <label for="parking">Parking</label>
            
            <input type="checkbox" name="gym" id="gym" value="gym" class="cbW">
            <label for="gym">Gym</label>
            
            <!--let user choose how results are ordered-->
            <p>Order By:

                <select name="orderBy" id="orderBy" style="width:100px">
                    <option value="bdrms">Bedrooms</option>
                    <option value="bldgName">Building</option>
                    <option value="rent" selected>Rent</option>
                    <option value="sqft">Square Feet</option>
                </select>
                &ensp;
                <!--let user specify num results per page-->
                Results per page:
                <select name="rowsPerPg" id="rowsPerPg" style="width:75px;">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="30">30</option>
                </select>
                
                <!--let user choose ASC or DESC order of results-->
                <br><br>
                <input type="radio" id="asc" name="ascDesc" value="ASC" class="cbW" checked>
                <label for="asc">Ascending</label>
                <input type="radio" id="desc" name="ascDesc" value="DESC" class="cbW">
                <label for="desc">Descending</label>
            </p>

            <p><button style="width: 100%; padding: 5px; font-size: 1rem; background-color: #8C8; color: #363; text-transform: uppercase; letter-spacing: 5px">Submit</button></p>

        </form>
        
    </div><!-- close #container -->
    
    <script>
        
      function validateMinMaxRent(){
        let minRent = Number(document.querySelector('#minRent').value);
        let maxRent = Number(document.querySelector('#maxRent').value);
        
        if(minRent >= maxRent){
          alert('Please choose a min rent value that is less than the max rent value');
          return false;
        }  
      
      }
    
    </script>

</body>
</html>