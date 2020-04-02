<?php
    class Post {
        private $user_obj;
        private $con;

        public function __construct($con, $user) {
            $this->con = $con;
            $this->user_obj = new User($con, $user)
        }

        public function submitPost($body, $user_to) {
            // TODO: add strip_tags() to remove html tags
            $body = $body;
            $body = mysqli_real_escape_string($this->con, $body);
            $check_empty = preg_replace('/\s+/', '', $body); // Delete all spaces

            if($check_empty != "") {
                $date_added = date("Y-m-d H:i:s");

                $added_by = $this->user_obj->getUsername();

                if($user_to == $added_by) {
                    $user_to = "none";
                }

                $query = mysqli_query($this->con, "INSERT INTO posts VALUES('', '$body', '$added_by', '$user_to', '$date_added', 'no', 'no', '0')");
                $returned_id = mysqli_insert_id($this->con);

                $num_posts = $this->user_obj->getNumPosts();
                $num_posts++;
                $update_query = mysqli_query($this->con, "UPDATE users SET num_posts='$num_posts' WHERE username='$added_by'");
                
            }
        }
    }
?>