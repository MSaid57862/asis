<?php
    function getAccessLevel($accessCode){
        $results = DB::queryFirstRow("SELECT access_name FROM access_level WHERE access_level=%i", $accessCode );
        $array=[];
        if($results==true){
            $array['access_name'] = $results['access_name'];
        }
    return $array;
    }

    function getFormation($formationId){
        $results = DB::queryFirstRow("SELECT * FROM formation WHERE formation_id=%i", $formationId);
        $array=[];
        if($results==true){
            $array['formation_name'] = $results['formation_name'];
            $array['zone_id'] = $results['zone_id'];
            $array['formation_code'] = $results['formation_code'];
        }
    return $array;
    }

function getHeadquarterUnits($commId){
        $query = DB::query("SELECT * FROM unit WHERE command_id=%i", $commId);
        
        if($query==true){
            $unit = ' <option value="">Select Unit</option>';
                foreach($query as $results){
                    $unit .="<option value='".$results['unit_id']."'>".$results['unit_name']."</option>";
                }
        }else{
            $unit = '<option>No Unit</option>';
        }
        return $unit;
    }

    function getArmsCategory($armCategoryId){
        $results = DB::queryFirstRow("SELECT * FROM arm_category WHERE category_id=%i", $armCategoryId);
        $array=[];
        if($results==true){
            $array['category_name'] = $results['category_name'];
            $array['category_id'] = $results['category_id'];
        }
    return $array;
    }
    
    // function getRank($rankId){
    //     $results = DB::queryFirstRow("SELECT * FROM ranks WHERE rank_id=%i", $rankId);
    //     $array=[];
    //     if($results==true){
    //         $array['rank_name'] = $results['rank_name'];
    //         $array['rank_code'] = $results['rank_code'];
    //     }else{
    //          $array['rank_name'] = '';
    //         $array['rank_code'] = '';
    //     }
    // return $array;
    // }

    function getUserDetails($userId){
        $results = DB::queryFirstRow("SELECT * FROM users WHERE user_id=%i", $userId);
        $array=[];
        if($results==true){
            $array['user_id'] = $results['user_id'];
            $array['fullname'] = $results['fullname'];
            $array['phone'] = $results['phone'];
            // $array['address'] = $results['address'];
            $array['username'] = $results['username'];
            $array['command_id'] = $results['command_id'];
            $array['access_level'] = $results['access_level'];
            $array['status'] = $results['status'];
            $array['date_created'] = $results['date_created'];
            $array['svn'] = $results['svn']; 
            $array['rank'] = $results['rank']; 
             $array['check'] = true;
            return $array;
        }else{
            $array['check'] = false;
            return $array;
        }
    
    }

    function getCountry($countryId){
        $results = DB::queryFirstRow("SELECT * FROM country WHERE country_id=%i", $countryId);
        $countryDetails=[];
        if($results==true){
            $countryDetails['country_name'] = $results['country_name'];
            $countryDetails['country_id'] = $results['country_id'];
            $countryDetails['date_created'] = $results['date_created'];
        }
        return $countryDetails;
    }

    function getZone($zoneId){
        $results = DB::queryFirstRow("SELECT * FROM zone WHERE zone_id=%i", $zoneId);
        $zoneDetails=[];
        if($results==true){
            $zoneDetails['zone_name'] = $results['zone_name'];
            $zoneDetails['zone_location'] = $results['zone_location'];
            
        }
        return $zoneDetails;
    }

function getDepartment($deptId){
        $results = DB::queryFirstRow("SELECT * FROM department WHERE department_id=%i", $deptId);
        $deptDetails=[];
        if($results==true){
            $deptDetails['department_name'] = $results['department_name'];
            $deptDetails['department_code'] = $results['department_code'];
            $deptDetails['department_head'] = $results['department_head'];
        }
        return $deptDetails;
    }
    
 function getRank($rankId){
        $results = DB::queryFirstRow("SELECT * FROM ranks WHERE rank_id=%i", $rankId);
        $rankDetails=[];
        if($results==true){
            $rankDetails['rank_name'] = $results['rank_name'];
            $rankDetails['rank_code'] = $results['rank_code'];
            
        }
        return $rankDetails;
    }
    
function getUnit($unitId){
        $results = DB::queryFirstRow("SELECT * FROM units WHERE unit_id=%i", $unitId);
        $unitDetails=[];
        if($results==true){
            $unitDetails['unit_name'] = $results['unit_name'];
            $unitDetails['unit_code'] = $results['unit_code'];
            
        }
        return $unitDetails;
    }
    
    function getUnitDropDown($unitId){
        $query = DB::query("SELECT * FROM units WHERE unit_id=%i", $unitId);
        
        if($query==true){
            $unit = ' <option value="">Select Unit</option>';
                foreach($query as $results){
                    $unit .="<option value='".$results['unit_id']."'>".$results['unit_name']."</option>";
                }
        }else{
            $unit = '<option>No Unit</option>';
        }
        return $unit;
    }
?>