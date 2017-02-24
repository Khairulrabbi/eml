<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="subject">Subject</label>
                <?php email_subject() ?>
<!--                <input class="form-control" type="text" name="subject" id="subject" />-->
            </div>
            <div class="form-group">
                <label for="message">Message Body</label>
                <textarea class="form-control" type="text" name="message" id="message"></textarea>
            </div>
            <div class="form-group">
                <label for="attachment">Select Attachment</label>
                <input type="file" name="mail_attachment" id="attachment" />
            </div>
            <input type="submit" value="Submit" class="btn btn-primary" />
        </form>
    </div>
</div>