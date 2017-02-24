<div class="col-lg-6 col-lg-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading">Create Master Table</div>
        <div class="panel-body">
            <?php echo @$msg; ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="table_name">Name</label>
                    <input type="text" class="form-control" name="table_name" id="table_name" placeholder="Enter Table Name"/>
                </div>
                <input class="btn btn-primary" type="submit" value="Create"/>
            </form>
        </div>
    </div>
</div>