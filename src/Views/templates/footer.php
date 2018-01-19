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
                      dataType : 'html',
                      success: function (data) {
                          $("html").html(data);
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
