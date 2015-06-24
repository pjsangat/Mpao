<?php if($sub_total > 0){ ?>
<table class="table">
    <tbody>
        <tr class="bg-success">
            <td class="col-md-4"><strong>Subtotal</strong></td>
            <td class="col-md-4"></td>
            <td class="col-md-1" style="text-align: center">
            </td>
            <td class="col-md-1 text-center"></td>
            <td class="col-md-1 text-center">
                <strong><?php echo 'P'.number_format($sub_total, 2, ".", ","); ?></strong>
            </td>
            <td class="col-md-1 text-center">
            </td>
        </tr>
    </tbody>
</table>

<?php } ?>