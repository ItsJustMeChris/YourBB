            <div class="footer">
                Copyright ItsJustMeChris - Heart
            </div>
        </div>
        <?php if (self::$user::loggedIn()): ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $(document).on('submit', '[id^=logout_]', function (e) {
                    e.preventDefault();
                    var data = $(this).serialize()
                    $.ajax({
                      type: 'POST',
                      url: '/auth/logout',
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
