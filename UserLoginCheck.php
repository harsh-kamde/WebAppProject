<?php
require_once './includess/db.php';

                        if (!isset($_COOKIE['user_id'])) {
                        // User is not logged in, display login and register links
                         
                            header("Location: login.php"); // Redirect to index.php

                            }
                         else {
                         // User is logged in, redirect to payment gateway
                         $conn = db_connect();
                         $course_ids =  $_GET["course_id"];

                         $sql = "SELECT price, title  FROM courses WHERE course_id = '$course_ids'";
                        
                         $result = mysqli_query($conn, $sql);
                         $row = mysqli_fetch_array($result);
                         var_dump($row);
                         $price = (int) $row['price'];
                         $title = $row['title'];
    
                         db_close($conn);

                         header("Location: ./payment-gateway/checkout.php?course_title=' . $title .'&course_price=.$price"); // Redirect to payment gateway

                        }
                    ?>