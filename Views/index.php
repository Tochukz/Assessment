<?php require_once('Partials/navigation.php'); ?>
<section>
<div class="container">    
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-danger" style="display:none">
                <button type="button" class="close" data-hide="alert">&times;</button>
                <span id="message"></span>
            </div>
        </div>
        <div class="col-sm-12" id="shopAssessment">
            <table class="table table-bordered table-striped">                
                <!--<thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>-->
                <tfoot>
                    <tr style="font-weight:bold">
                        <td style="text-align:right">Total</td>
                        <td class="total" colspan="3"></td>
                    <tr>
                </tfoot>
                <tbody>
                    <?php
                    $keys = ['0' => 'awareness', '1' => 'knowledge', '2' => 'skill', '3' => 'mastery', '4' => 'develop new'];
                    $recordStr = "";
                    $x = 1;
                    foreach ($data as $record) {
                        $recordStr .= '<tr style="background:#22c75a;color:#fff;font-weight:bold" data-assess="score-group'.$x.'" >
                                          <td> ' . $x.'. '. $record->competency . '</td>
                                          <td>Competency</td>    
                                          <td>Score</td>    
                                          <td class="group'.$x.'" ></td>                                                                                                                     
                                         </tr>';

                        $assessments = json_decode($record->assessment, true);
                        for ($i = 0; $i < count($assessments); $i++) {
                            $j = $i + 1;
                            $recordStr .= '<tr  data-score="'.$j.'" data-group="group'.$x.'" class="clickable" >
                                              <td>' . $assessments[$i][1] . '</td>
                                              <td>' . ucfirst($keys[$i]) . '</td>     
                                              <td> ' . $j . '</td>       
                                              <td data-checked="group'.$x.'"></td>                                     
                                           </tr>';
                        }                        
                        
                        $x++;
                    }
                    echo $recordStr;
                    ?>                  
                </tbody>
            </table>
            <p style="text-align:right"> <button class="btn btn-primary" id="next">Next</button></p>            
        </div>
        <div class="col-sm-12"  id="shopSummary" style="display:none">
            <table class="table table-bordered table-striped"> 
                <thead>
                    <tr style="background:#22c75a;color:#fff">
                        <th>S/N</th>
                        <th>Competency</th>
                        <th>Min Required Standard Score</th>
                        <th>Actual Score</th>
                        <th style="width:40%">Comment</th>
                    </tr>
                </thead>
                <tbody style="text-align:center">
                    <?php
                    $keys = ['0' => 'awareness', '1' => 'knowledge', '2' => 'skill', '3' => 'mastery', '4' => 'develop new'];
                    $tBodyStr = "";
                    $total = 0;
                    $x = 1;
                    foreach ($data as $record) {
                        $tBodyStr .= '<tr data-assess="comment-group'.$x.'">
                                          <td>'.$x.'</td>
                                          <td style="text-align:left">' . $record->competency . '</td>
                                          <td data-minreq="'.$x.'">'.$record->min_requirement.'</td>    
                                          <td class="group'.$x.'" data-actual="'.$x.'"></td>    
                                          <td style="text-align:left" contenteditable="true" data-comment="group'.$x.'"></td>                                                                                                                     
                                    </tr>';   
                        $total +=  (int) $record->min_requirement;                                                          
                        $x++;
                    }
                    echo $tBodyStr;
                    ?>     
                    <tr>
                        <td></td>
                        <td style="text-align:left">Total</td>
                        <td><?= $total ?></td>
                        <td class="total">&nbsp;</td>
                        <td style="text-align:left" contenteditable="true">&nbsp;</td>
                    </tr>       
                </tbody>
            </table>
                     
            <form action="/assessment/process" method="post" style="text-align:right" id="resultForm">
                <button class="btn btn-primary" id="back" type="button">Back</button>

                <input type="hidden" name="result" />
                <button class="btn btn-primary" id="submit" type="button">Submit</button>
            </form>                
            
        </div>
    </div>
</div>
</section>

<script>
$(document).ready(function(){
    $("tr.clickable").on('click', markCompetency);
    $('#next').on('click', makeSummary);
    $('#back').on('click', backToAssessment);
    $('[data-comment]').on('blur', recordComment);
    $('#submit').on('click', submitAssessment);
    $('[data-hide]').on('click', function(e){
        $(e.currentTarget).parent("div").slideUp();
    })
});

var totalAssesssment = <?= $x-1 ?>;
var assessSummary = {};

/**
 * Checks the selected score/perormance for each question. 
 * @param object 2
 * @returns undefined
 */
function markCompetency(e)
{
   var row = $(e.currentTarget);  
   var rowGroup = row.attr('data-group');
   var groupMembers = row.siblings('tr[data-group="'+rowGroup+'"]');  
   for(var i=0; i<groupMembers.length; i++){
      groupMembers[i].style = " ";     
   }
   row.css({"background":"silver"});
   var score = row.attr('data-score'); 
   $('td.'+rowGroup).html(score);
   
   $('td[data-checked="'+rowGroup+'"]').html('');
   row.find('td[data-checked="'+rowGroup+'"]').html('<span class="glyphicon glyphicon-ok"></span>'); 
   $('[data-assess="score-'+rowGroup+'"]').css({'background':'#22c75a'})
   var groupNumber = rowGroup.replace("group","");
   assessSummary[groupNumber] = {'score':score};  
   calculateTotal();
}

/**
 * Calculates the total score for the retailer.
 * @retuns undefined
 */
function calculateTotal(){   
    var totalScore = 0;
    for(var elem in  assessSummary){
        totalScore += parseInt(assessSummary[elem].score);
    }
    $('.total').html(totalScore);
}

/**
 * Takes the user to the assessment summary table after successful validation
 * @retuns undefined
 */
function makeSummary(){
    if(validate('score') == false){
       return false;   
    }
    $('#shopAssessment').slideUp('fast', function(){
        $('#shopSummary').slideDown('fast');
    });    
}

/**
 * Take the user back to the first assessment table.
 * @returns undefined
 */
function backToAssessment(){
    $('#shopSummary').slideUp('fast', function(){
       $('#shopAssessment').slideDown('fast');
    });
}

/**
 * Add the examiner's comment to the assessSummary object.
 * @param object e
 * @reurns undefined
 */
function recordComment(e){  
    var cell = $(e.currentTarget);
    var comment = cell.html();
    var rowGroup = cell.attr('data-comment');   
    var groupNumber = rowGroup.replace("group",""); 
    if( comment.replace("&nbsp;", "") && assessSummary[groupNumber] != undefined){                 
        assessSummary[groupNumber].comment = comment;
        $('[data-assess="comment-'+rowGroup+'"]').css({'background':'#fff'}); 
    }
    
}

/**
 * Submit the result of the assessment to the server for processing and storage
 * @param object e
 * @returns undefined
 */
function submitAssessment(e){      
    if(validate('comment') == false){        
       return false;   
    }
    var btn = $(e.currentTarget);   
    var result = JSON.stringify(assessSummary);
    $('[name="result"]').val(result);     
    //$("#resultForm").submit()
    btn.attr('type','submit');
       
}

/**
 * Vaidates the assessment and summary comments.
 * @param string data
 * @retunrs undefined
 */
function validate(data){
    var message = "Please evaluate the following item number(s): ";
    var validated = true;
    var minReqScore, actualScore;
    for(var x=1; x<=totalAssesssment; x++){                   
        if(data == 'score'){
            $('[data-assess="'+data+'-group'+x+'"]').css({'background':'#22c75a'});           
        }
        if(data == 'comment'){
            minReqScore = parseInt($('[data-minreq="'+x+'"]').html());
            actualScore = parseInt($('[data-actual="'+x+'"]').html());
            if(actualScore >= minReqScore){
                continue;
            }
        }      
        if(assessSummary[x] == undefined || assessSummary[x][data] == undefined){
            message += x + ' ';     
            $('[data-assess="'+data+'-group'+x+'"]').css({'background':'#F08080'});
            validated = false;
        }    
         
    } 
    $('.alert-danger').slideUp('fast');
    $('#message').html('');
    if(validated == false){
        currentY = (window.scrollY == undefined) ? window.pageYOffset : window.scrollY;
        scrollToTop(currentY);
        $('.alert-danger').slideDown('fast');
        $('#message').html(message);
    }    
    
    return validated;
}

/**
 * Scrolls the user to the top of the page.
 * @param Number currentY
 * @returns unndefined
 */
function scrollToTop(currentY){        
    currentY -= 10; 
    if(currentY <= 0){
        return false;
    }
    window.scrollTo(0, currentY);
    setTimeout(scrollToTop(currentY), 100)  
}
</script>
<?php require_once('Partials/footer.php'); ?>
