<tr data-id="<?php echo $id; ?>">
    <td class="text-left"><?php echo $name; ?></td>
    <td class="text-center visible-sm visible-md visible-lg"><?php echo $email; ?></td>
    <td class="text-center visible-sm visible-md visible-lg"><?php echo $localization; ?></td>
    <td class="text-center visible-sm visible-md visible-lg">
      <?php
        if( is_array($interests) ){
          $list_interests = array();
          foreach( $interests as $value ){
            $list_interests[] = $value['name'];
          }
          echo implode(',', $list_interests);
        }
      ?>
    </td>
    <td class="text-center">
        <div class="btn-group">
            <button type="button" class="btn btn-default btn-edit-member">Editar</button>
        </div>
    </td>
</tr>
