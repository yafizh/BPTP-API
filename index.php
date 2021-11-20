<?php include 'Connection.php';
require "Request.php";

$apiService = new Request($conn);
if (isset($_GET['request'])) {
    if ($_GET['request'] == 'login') {
    } else if ($_GET['request'] == 'getAllBooks') {
        echo $apiService->getAllBooks();
    } else if ($_GET['request'] == 'getBookByBookId') {
        echo $apiService->getBookByBookId($_POST['book_id']);
    } else if ($_GET['request'] == 'getBookByCategoryId') {
        echo $apiService->getBookByCategoryId($_POST['category_id']);
    } else if ($_GET['request'] == 'postBook') {
        $image_uploaded = false;
        $file_uploaded = false;

        $upload_cover_image = null;
        $upload_file = null;

        if (isset($_FILES["book-cover-img"])) {
            $cover_image_dir = "uploads/cover/";
            $cover_image_extension = explode(".", $_FILES["book-cover-img"]["name"]);
            $cover_image_extension = end($cover_image_extension);
            $upload_cover_image = date('YmdHis') . "." . $cover_image_extension;
            if (move_uploaded_file($_FILES["book-cover-img"]["tmp_name"], 'uploads/cover/' . $upload_cover_image)) $image_uploaded = true;
        } else $image_uploaded = true;

        if (isset($_FILES["book-digital-file"])) {
            $file_dir = "uploads/file/";
            $file_extension = explode(".", $_FILES["book-digital-file"]["name"]);
            $file_extension = end($file_extension);
            $upload_file = date('YmdHis') . "." . $file_extension;
            if (move_uploaded_file($_FILES["book-digital-file"]["tmp_name"], 'uploads/file/' . $upload_file)) $file_uploaded = true;
        } else $file_uploaded = true;

        if ($image_uploaded && $file_uploaded){
            $book = [
                'book-category-id' => $_POST['book-category-id'],
                'book-language-id' => $_POST['book-language-id'],
                'book-title' => $_POST['book-title'],
                'book-sub-title' => $_POST['book-sub-title'],
                'book-classification-number' => $_POST['book-classification-number'],
                'book-isbn-number' => $_POST['book-isbn-number'],
                'book-publisher' => $_POST['book-publisher'],
                'book-publish-place' => $_POST['book-publish-place'],
                'book-publish-date' => $_POST['book-publish-date'],
                'book-author' => $_POST['book-author'],
                'book-illustration' => $_POST['book-illustration'],
                'book-width' => $_POST['book-width'],
                'book-height' => $_POST['book-height'],
                'book-page' => $_POST['book-page'],
                'book-stock' => $_POST['book-stock'],
                'upload-cover-image' => $upload_cover_image,
                'upload-file' => $upload_file,
                'book-description' => $_POST['book-description']
            ];
            echo $apiService->postBook($book);
        }
    }
}
