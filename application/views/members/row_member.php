<tr data-objectId="<?php echo $objectId; ?>">
    <td class="text-left"><?php echo $name; ?></td>
    <td class="text-center visible-sm visible-md visible-lg"><?php echo $email; ?></td>
    <td class="text-center visible-sm visible-md visible-lg"><?php echo $localization; ?></td>
    <td class="text-center visible-sm visible-md visible-lg"><?php echo implode(',', $interest); ?></td>
    <td class="text-center">
        <div class="btn-group">
            <button type="button" class="btn btn-default btn-edit-member">Editar</button>
        </div>
    </td>
</tr>