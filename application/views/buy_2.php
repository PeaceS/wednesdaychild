        <div id="shipping" class="white_opacity">
            <table>
                <tr type="first">
                    <td>first name *</td>
                    <td><input validate="alphabet" value="<?php echo $shippingAddress['first']; ?>" /></td>
                </tr>
                <tr type="last">
                    <td>last name *</td>
                    <td><input validate="alphabet" value="<?php echo $shippingAddress['last']; ?>" /></td>
                </tr>
                <tr type="address" class="address">
                    <td>address *</td>
                    <td><textarea validate="require"><?php echo $shippingAddress['address']; ?></textarea></td>
                </tr>
                <tr type="zip">
                    <td>zip code *</td>
                    <td><input validate="number" value="<?php echo $shippingAddress['zip']; ?>" /></td>
                </tr>
                <tr type="city">
                    <td>city *</td>
                    <td><input validate="alphabet" value="<?php echo $shippingAddress['city']; ?>" /></td>
                </tr>
                <tr type="country">
                    <td>country *</td>
                    <td>
                        <select validate="require">
                            <?php foreach ($listCountry as $item) { ?>
                            <?php if ($shippingAddress['country'] == $item['shipping_country']) { ?>
                            <option selected value="<?php echo $item['shipping_country']; ?>"><?php echo $item['shipping_country']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $item['shipping_country']; ?>"><?php echo $item['shipping_country']; ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr type="phone">
                    <td>phone *</td>
                    <td><input validate="number" value="<?php echo $shippingAddress['phone']; ?>" /></td>
                </tr>
                <tr type="email">
                    <td>email *</td>
                    <td><input validate="email" value="<?php echo $shippingAddress['email']; ?>" /></td>
                </tr>
                <tr class="required_field">
                    <td>*required field</td>
                    <td>
                        <div id="menu">
                            <a href="javascript:back();"><label class="back">back</label></a>
                            <a href="javascript:next();"><label class="next">next</label></a>
                        </div>
                    </td>
                </tr>
            </table>
