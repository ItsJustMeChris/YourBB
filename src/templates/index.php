<!DOCTYPE html>
<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <meta charset="charset=utf-8">
    <title>The Template name</title>
</head>

<body>
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
                            <?php if($data['loggedin']): ?>
                            <form id="logout_1" method="post">
                                <input class="dropdown-item" type="submit" type="submit" name="logout" value="Logout" />
                            </form>
                            <?php else: ?>
                                <a class="dropdown-item" href="/auth">Login</a>
                            <?php endif; ?>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="row">
            <div class="col">
                <div class="card mt-5 mb-5">
                    <div class="card-header">
                        Data
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mt-5 mb-5">
                    <div class="card-header">
                        Data
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if($data['loggedin']): ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('submit', '[id^=logout_]', function (e) {
                e.preventDefault();
                var data = $(this).serialize()
                $.ajax({
                  type: 'POST',
                  url: window.location.href + '/auth/logout',
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
                  error: function (data) {
                      console.log(data)
                    swal("ERR!", "Something blew up.", "error")
                  }
                })
                return false
            })
        })
    </script>
    <?php endif; ?>
</body>
</html>
