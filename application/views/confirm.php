        <?php
            if ($status != 0){
                foreach ($status as $test) {
                    echo $test;
                }

            }
        ?>
        <div id="confirm" class="white_opacity">
            <label>payment confirm</label>
            <?php echo form_open_multipart('confirm/send'); ?>
                <table>
                    <tr>
                        <td>reference number : </td>
                        <td><input name="reference" type="text" /></td>
                    </tr>
                    <tr>
                        <td>name : </td>
                        <td><input name="name" type="text" /></td>
                    </tr>
                    <tr>
                        <td>bank account : </td>
                        <td><input name="account" type="text" /></td>
                    </tr>
                    <tr>
                        <td>bank company : </td>
                        <td><input name="bank" type="text" /></td>
                    </tr>
                    <tr>
                        <td>time : </td>
                        <td><input name="time" type="text" /></td>
                    </tr>
                    <tr>
                        <td>upload image : </td>
                        <td><input name="image" type="file" /></td>
                    </tr>
                </table>
                <a href="javascript:send()"><label>confirm</label></a>
            </form>
        </div>