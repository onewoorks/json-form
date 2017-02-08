<?= $header; ?>

<div class='panel panel-primary'>
    <div class='panel-heading text-uppercase'>List of Template Documents</div>
    <div class='panel-body'>
        <div class='btn btn-default'>Existed Document</div>
        <div class='btn btn-default'>Document Without JSON</div>
        <br><br>
        <table class='table table-condensed table-bordered'>
            <thead>
                <tr>
                    <th>Discipline</th>
                    <th>Document Type</th>
                    <th>Document Title</th>
                    <th class='text-center'>Status</th>
                    <th class='text-center'>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($available_documents as $document):?>
                <tr>
                    <td><?php echo $document;?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class='text-center'><div class='btn btn-xs btn-default'>Generate</div></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>        
    </div>
</div>
