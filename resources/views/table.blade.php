<?php
/**
 * Created by PhpStorm.
 * User: rossedlin
 * Date: 2020-05-14
 * Time: 12:19
 *
 * @var \stdClass $obj
 */
?>

<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Email</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Avatar</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach($obj->data as $item) { ?>
        <tr>
            <th scope="row"><?= $item->id  ?></th>
            <td><?= $item->email  ?></td>
            <td><?= $item->first_name  ?></td>
            <td><?= $item->last_name  ?></td>
            <td><img src="<?= $item->avatar ?>" height="64" alt="Avatar"></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
