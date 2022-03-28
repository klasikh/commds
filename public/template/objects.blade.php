
<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsVacation;



  $data=''; $var="ttest";
  //$conges=AbsVacation::find(1);
    
        $data .= '      

                    {
                    "id": "1",
                    "name": "xx11",
                    "position": "' .$var .'",
                    "salary": "$320,800",
                    "start_date": "2011/04/25",
                    "office": "Edinburgh",
                    "extn": "5421"
                    },
                
        
        ';
 
 
 ?>

 {    
        "data": [

<?php echo $data; ?>
            {
            "id": "2",
            "name":  {{ Auth::User()->name }} {{ Auth::User()->firstName }},
            "position": "System Architect",
            "salary": "$320,800",
            "start_date": "2011/04/25",
            "office": "Edinburgh",
            "extn": "5421"
            }
        ]
    }

