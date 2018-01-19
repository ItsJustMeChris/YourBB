<?php if (self::$user::loggedIn()) { header('Location: /'); }?>
            <div class="row">
                <div class="col">
                    <div class="card mt-5 mb-5">
                        <div class="card-header">
                            Create
                        </div>
                        <div class="card-body">
                            <form id="create_1" method="post">
                                <div class="form-group">
                                    <label for="forumname">Name</label>
                                    <input type="text" id="forumname" class="form-control" name="forumname" placeholder="Enter forum name">
                                    <br>
                                </div>
                                <div class="form-group">
                                    <label for="forumdescription">description</label>
                                    <input type="text" id="forumdescription" class="form-control" name="forumdescription" placeholder="Enter forum description">
                                    <br>
                                </div>
                                <input class="btn btn-primary" type="submit" type="submit" name="login" value="Login" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php foreach(self::$controller::list() as $key=>$value): ?>
                <div class="row">
                    <div class="col">
                        <div class="card mt-5 mb-5">
                            <div class="card-header">
                                <?php echo self::$controller::list()[$key]['name']; ?>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo self::$controller::list()[$key]['description']; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

            <script type="text/javascript">
                $(document).ready(function() {
                    $(document).on('submit', '[id^=create_]', function(e) {
                        e.preventDefault();
                        var data = $(this).serialize()
                        $.ajax({
                            type: 'POST',
                            url: '/forum/create',
                            data: data,
                            dataType: 'html',
                            success: function (data) {
                                console.log(data)
                                $("html").html(data);
                            },
                            error: function(data) {
                                console.log(data)
                                swal("ERR!", "Something blew up.", "error")
                            }
                        })
                        return false
                    })
                })
            </script>
