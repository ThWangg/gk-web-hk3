<?php
// admin/controller/post_delete.php
require_once __DIR__ . '/../../model/postAdmin.php';
$postModel = new Post();

$id = (int)($_GET['id'] ?? 0);
if ($id) {
    // try common method names
    $ok = false;
    if (method_exists($postModel, 'delete')) $ok = $postModel->delete($id);
    else if (method_exists($postModel, 'deletePost')) $ok = $postModel->deletePost($id);
    // else if (method_exists($postModel, 'remove')) $ok = $postModel->remdeove($id);

}
header('Location: ?page=post_list&msg=deleted');
exit();
