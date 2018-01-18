    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">Liquid Auth</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Welcome: <?php echo $data['username']; ?>
                            </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <form id="logout_1" method="post">
                                <input class="dropdown-item" type="submit" type="submit" name="logout" value="Logout" />
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
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
                        dataType: 'html',
                        success: function (data) {
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
        <script type="text/javascript">
            $(document).ready(function() {
                $(document).on('submit', '[id^=register_]', function(e) {
                    e.preventDefault();
                    var data = $(this).serialize()
                    $.ajax({
                        type: 'POST',
                        url: '/auth/register',
                        data: data,
                        dataType : 'html',
                        success: function (data) {
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
    </div>
