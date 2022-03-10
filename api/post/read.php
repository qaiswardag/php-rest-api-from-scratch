<?php
// warnings
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// headers

// in php we have the header function that we can use
// since it is a public api we gonna add *
// no auth or token is required
header('Access-Control-Allow-Origin: *');

// we wanna accept json
header('Content-Type: application/json');

// bring in the database and post
include_once '../../config/Database.php';
include_once '../../modals/Post.php';

// Instantiate DB & Connect
$database = new Database();
// a variable for our connection
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);

//blog post query
$result = $post->read();
// get row count
$num = $result->rowCount();

// let's check if there is any post
if ($num > 0) {
// post array
    $post_arr = array();
    $post_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post_item = array(
            'id' => $id,
            'title' => $title,
            // body is usually allowed to have html
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name
        );

        // push to 'data'
        array_push($post_arr['data'], $post_item);
    } // end of loop

    // turn to json & output
    echo json_encode($post_arr);

} else {
// no posts
    echo json_encode(
        array('message' => 'No post found')
    );

}
