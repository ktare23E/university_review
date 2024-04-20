<?php
    include_once '../includes/autoloader.php';
    $init = new UniversityView();
    $data = $init->displayCertainUniversityView(9);
    
    $region = $data['region'];
    $province = $data['province'];
    $city = $data['city'];
    $barangay = $data['barangay'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Address Selector - Philippines</title>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
 <body class="p-5">
   
</body>
</html>

<!-- <script src="ph-address-selector.js"></script> -->
<script  type="module">
    import {region} from './ph-json/region_copy.js';
    import {province} from './ph-json/province_copy.js';
    import {city} from './ph-json/city_copy.js';
    import {barangay} from './ph-json/barangay_copy.js';
  
// Use the PHP variable and ensure it's a valid JavaScript string
const regionName = <?php echo json_encode($region); ?>;

// Retrieve region code using the region name. Make sure to use the correct property names.
const regionEntry = region.find(r => r.region_name === regionName);

// Accessing the region code from the found entry
const regionCode = regionEntry ? regionEntry.region_code : null;



const retrieveProvince = province.filter(p => p.region_code === regionCode);

const provinceCode = retrieveProvince.map(p => p.province_code);

//retrieve certain province code using province name
const provinceEntry = retrieveProvince.find(p => p.province_name === <?php echo json_encode($province); ?>);
const provinceCertainCode = provinceEntry ? provinceEntry.province_code : null;

// const provinceName = retrieveProvince.map(p => p.province_name);

//retrieve all city name using province code
const retrieveCity = city.filter(c => c.province_code === provinceCertainCode);
const cityName = retrieveCity.map(c => c.city_name);
//display all cityname using loop
// cityName.forEach(c => {
//     console.log(c);
// });

//retrieve certain city code using city name
const cityEntry = retrieveCity.find(c => c.city_name === <?php echo json_encode($city); ?>);
const cityCertainCode = cityEntry ? cityEntry.city_code : null;
console.log(cityCertainCode);
//retrieve certain barangay name using city code
const retrieveBarangay = barangay.filter(b => b.city_code === cityCertainCode);
const barangayName = retrieveBarangay.map(b => b.brgy_name);
console.log(barangayName);
</script>