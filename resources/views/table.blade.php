<?php
/**
 * Created by PhpStorm.
 * User: rossedlin
 * Date: 2020-05-14
 * Time: 12:19
 *
 * @var string $url
 * @var array  $rows
 */
?>

<div class="col-xs-12">
    I just scrapped this url
    <a href="<?= $url ?>" target="_blank" style="color: #00A8FF;"><?= $url ?></a>, here are the results
</div>

<div class="col-xs-12 mt-5">
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Blog Thumbnail</th>
            <th scope="col">Title</th>
            <th scope="col">Href</th>
            <th scope="col">Description</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach($rows as $row) { ?>
        <tr>
            <td><img src="<?= $row['img'] ?>" height="64" alt="Blog Thumbnail"></td>
            <td><?= $row['title'] ?></td>
            <td><a href="<?= $row['href'] ?>" target="_blank"><?= $row['href'] ?></a></td>
            <td><?= $row['description'] ?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>