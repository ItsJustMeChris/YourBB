<?php if (self::$user::loggedIn()) { header('Location: /'); }?>
            <div class="row">
                <div class="col">
                    <div class="card mt-5 mb-5">
                        <div class="card-header">
                            Login
                        </div>
                        <div class="card-body">
                            <form id="login_1" method="post">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="username" id="username" class="form-control" name="username" placeholder="Enter Username">
                                    <br>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" class="form-control" name="password" placeholder="Enter Password">
                                    <br>
                                </div>
                                <input class="btn btn-primary" type="submit" type="submit" name="login" value="Login" />
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mt-5 mb-5">
                        <div class="card-header">
                            Register
                        </div>
                        <div class="card-body">
                            <form id="register_1" method="post">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="username" id="username" class="form-control" name="username" placeholder="Enter Username">
                                    <br>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="username" id="email" class="form-control" name="username" placeholder="Enter Email">
                                    <br>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" class="form-control" name="password" placeholder="Enter Password">
                                    <br>
                                </div>
                                <input class="btn btn-primary" type="submit" type="submit" name="register" value="Register" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                    $(document).on('submit', '[id^=login_]', function(e) {
                        e.preventDefault();
                        var data = $(this).serialize()
                        $.ajax({
                            type: 'POST',
                            url: '/auth/login',
                            data: data,
                            dataType: 'json',
                            success: function (data) {
                              if (data.error) {
                                    swal({
                                        title: 'Error!',
                                        text: data.error,
                                        timer: 1200,
                                        type: 'error',
                                        showCancelButton: false,
                                        showConfirmButton: false
                                    })
                              } else {
                                  swal({
                                      title: 'Logged In!',
                                      text: data.success,
                                      timer: 1200,
                                      type: 'success',
                                      showCancelButton: false,
                                      showConfirmButton: false
                                  })
                              }
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
            <script type="text/javascript">
                $(document).ready(function() {
                    $(document).on('submit', '[id^=register_]', function(e) {
                        e.preventDefault();
                        var data = $(this).serialize()
                        $.ajax({
                            type: 'POST',
                            url: '/auth/register',
                            data: data,
                            dataType : 'json',
                            success: function (data) {
                              if (data.error) {
                                    swal({
                                        title: 'Error!',
                                        text: data.error,
                                        timer: 1200,
                                        type: 'error',
                                        showCancelButton: false,
                                        showConfirmButton: false
                                    })
                              } else {
                                  swal({
                                      title: 'Logged In!',
                                      text: data.success,
                                      timer: 1200,
                                      type: 'success',
                                      showCancelButton: false,
                                      showConfirmButton: false
                                  })
                              }
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
