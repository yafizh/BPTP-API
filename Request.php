<?php

class Request
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function login($username, $password)
    {
        $query = "SELECT * FROM users WHERE 
                username='" . $this->conn->real_escape_string($username) . "' 
                AND 
                password='" . $this->conn->real_escape_string($password) . "'";
        $result = $this->conn->query($query);
        return json_encode($result->fetch_all(MYSQLI_ASSOC));
    }

    public function getAllBooks()
    {
        $result = $this->conn->query("SELECT * FROM book_table");
        return json_encode($result->fetch_all(MYSQLI_ASSOC));
    }

    public function getBookByBookId($bookId)
    {
        $result = $this->conn->query("SELECT * FROM book_table WHERE book_id = " . $bookId);
        return json_encode($result->fetch_all(MYSQLI_ASSOC));
    }

    public function getBookByCategoryId($categoryId)
    {
        $result = $this->conn->query("SELECT * FROM book_table WHERE book_category_id = " . $categoryId);
        return json_encode($result->fetch_all(MYSQLI_ASSOC));
    }

    public function postBook($book){
        $query = "INSERT INTO book_table (
            book_category_id,
            book_language_id,
            book_title,
            book_sub_title,
            book_classification_number,
            book_isbn_number,
            book_publisher,
            book_publish_place,
            book_publish_date,
            book_author,
            book_illustration,
            book_width,
            book_height,
            book_page,
            book_stock,
            book_cover_uri,
            book_file_uri,
            book_description
        ) VALUES (
            '" . $book['book-category-id'] . "',
            '" . $book['book-language-id'] . "',
            '" . $book['book-title'] . "',
            '" . $book['book-sub-title'] . "',
            '" . $book['book-classification-number'] . "',
            '" . $book['book-isbn-number'] . "',
            '" . $book['book-publisher'] . "',
            '" . $book['book-publish-place'] . "',
            '" . $book['book-publish-date'] . "',
            '" . $book['book-author'] . "',
            '" . $book['book-illustration'] . "',
            '" . $book['book-width'] . "',
            '" . $book['book-height'] . "',
            '" . $book['book-page'] . "',
            '" . $book['book-stock'] . "',
            '" . $book['upload-cover-image'] . "',
            '" . $book['upload-file'] . "',
            '" . $book['book-description'] . "'
        )";

        if ($this->conn->query($query) === TRUE) {
            return json_encode([
                "isSuccess" => true,
                "message" => "New record created successfully"
            ]);
        } else {
            return json_encode([
                "isSuccess" => false,
                "message" => $this->conn->error
            ]);
        }
    }
}
