<?php require_once('Partials/navigation.php'); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered table-striped display" id="example">                 
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Auhor</th>
                            <th>Title</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Auhor</th>
                            <th>Title</th>
                        </tr>
                    </tfoot>
                    <tbody>                                    
                    <?php
                        $tableStr= '';
                        foreach($books as $book){
                             $tableStr.= '<tr>';
                             $tableStr.= '<td>'.$book->id.'</td>';
                             $tableStr.= '<td>'.$book->author.'</td>';
                             $tableStr.= '<td>'.$book->title.'</td>';
                             $tableStr.= '</tr>';
                        }       
                        echo $tableStr;
                    ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</section>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<?php require_once('Partials/footer.php'); ?>