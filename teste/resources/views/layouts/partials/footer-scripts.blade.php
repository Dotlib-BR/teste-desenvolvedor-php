<?php
/**
 * Created by PhpStorm.
 * User: Vlademir Junior
 * Date: 02/07/2019
 * Time: 03:33
 */
?>
<script defer>
    $(function () {
        $('#enterSearch').keydown(function(event) {
            let keyCodeEnter = 13;

            if (event.keyCode === keyCodeEnter) {
                this.form.submit();
                return false;
            }
        });
    });
</script>
