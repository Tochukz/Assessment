<!DOCTYPE html>
<html>
<head>
    <title>Web App</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!--
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"> </script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"> </script>
    <![endif]-->
    <style>
    .table.table-striped tr:hover{
        background:grey;
        cursor:pointer;
    }
    </style>

</head>



<body>
<nav class="navbar navbar-default navbar-static-top" id="nav">
    <div class="container">
        <div class="navbar-header">
            <a href="index.php" class="navbar-brand">App</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-menu" aria-expanded="false">
                <span class="sr-only"> Toggle Navigation </span>
                <span class="icon-bar"> </span>
                <span class="icon-bar"> </span>
                <span class="icon-bar"> </span>
            </button>
        </div>
        <div class="collapse navbar-collapse navbar-right" id="nav-menu">
            <ul class="nav navbar-nav">
                <li><a href="index.php">HOME</a></li>
                <li><a href="aboutus.php">ABOUT US</a></li>
                <li><a href="services.php">SERVICES</a></li>
                <li><a href="webdesign.php">WEB DESIGN</a></li>
                <li><a href="portfolio.php">PORTFOLIO</a></li>
                <li><a href="contactus.php">CONTACT US</a></li>
            </ul>
        </div>
    </div>
</nav>
<section>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-bordered table-striped">                
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $keys = ['0' => 'awareness', '1' => 'knowledge', '2' => 'skill', '3' => 'mastery', '4' => 'develop new'];
                    $recordStr = "";
                    $x = 1;
                    foreach ($data as $record) {
                        $recordStr .= '<tr style="background:teal;color:#fff">
                                          <td>' . $record->competency . '</td>
                                          <td>Competency</td>    
                                          <td>Score</td>    
                                          <td class="competency'.$x.'" >&nbsp;</td>                                                                                                                     
                                         </tr>';

                        $assessments = json_decode($record->assessment, true);
                        for ($i = 0; $i < count($assessments); $i++) {
                            $j = $i + 1;
                            $recordStr .= '<tr  data-score="'.$j.'" >
                                              <td>' . $assessments[$i][1] . '</td>
                                              <td>' . ucfirst($keys[$i]) . '</td>     
                                              <td> ' . $j . '</td>       
                                              <td data-checked="'.$x.'">&nbsp;</td>                                     
                                           </tr>';
                        }
                        $x++;
                        echo $recordStr;
                    }
                    ?>                  
                </tbody>
                </table>
        </div>
    </div>
</div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $("tr").on('click', markCompetency);
});
function markCompetency(e)
{
   var row = $(e.currentTarget);
   var score = row.attr('data-score');   console.log(score);
   var cells = row.children('td');
   for(var i=0; i<cells.length; i++){
       cells[i].html(" ");
   }
   var cell = row.find('td[data-checked]');


   cell.html("checked");
   var x = cell.attr('data-checked');
   var resultRow = $('.competency'+x).html(score);
 
   
   
}
</script>
</body>
</html>

