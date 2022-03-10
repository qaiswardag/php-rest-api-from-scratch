<?php

class Post
{
    // post properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;
//
    // DB stuff — properties
    private $conn;
    private $table = 'posts';

    // constructor with db
    // constructor is basically method that runs automatically
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // methods:

    // Get Posts
    public function read()
    {
        // create query
        $query = 'SELECT 
        c.name as category_name,
        p.id,
        p.category_id,
        p.title,
        p.body,
        p.author,
        p.created_at
        FROM
    ' . $this->table . ' p
    LEFT JOIN 
    categories c ON p.category_id = c.id
    ORDER BY
    p.created_at DESC';

        // prepare statements
        // stmt = statement
        $stmt = $this->conn->prepare($query);

        // so far we only prepared our query and we have not yet executed the query
        // execute query
        $stmt->execute();

        // return statement
        return $stmt;
    }
}

