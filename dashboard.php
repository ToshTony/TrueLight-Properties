<?php
include 'con.php';

// Fetch properties
$prop_sql = "SELECT * FROM properties";
$prop_result = $conn->query($prop_sql);

// Fetch blogs
$blog_sql = "SELECT * FROM blogs";
$blog_result = $conn->query($blog_sql);

// Fetch messages
$message_sql = "SELECT * FROM contact_messages";
$message_result = $conn->query($message_sql);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="ToshTony" />
    <link rel="shortcut icon" href="images/tlogo.png" />

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="fonts/icomoon/style.css" />
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css" />

    <link rel="stylesheet" href="css/tiny-slider.css" />
    <link rel="stylesheet" href="css/aos.css" />
    <link rel="stylesheet" href="css/style.css" />

    <title>Admin Dashboard</title>
  </head>
  <body>
    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
          <span class="icofont-close js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>

    <nav class="site-nav">
      <div class="container">
        <div class="menu-bg-wrap">
          <div class="site-navigation">
            <a href="index.html" class="logoo m-0 float-start"><img src="images/tlogo.png" class="img-fluid" width="90px" height="90px" alt=""><span class="logo-name">True Light Properties Admin</span></a>
            <ul
              class="js-clone-nav d-none d-lg-inline-block pt-2 text-start site-menu float-end"
            >
              <li class="active"><a href="dashboard.php">Admin Home</a></li>
              <li><a href="#">Properties</a></li>
              <li><a href="#">Blogs</a></li>
              <li><a href="#">Messages</a></li>
              <li><a href="#">Logout</a></li>
            </ul>

            <a
              href="#"
              class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none"
              data-toggle="collapse"
              data-target="#main-navbar"
            >
              <span></span>
            </a>
          </div>
        </div>
      </div>
    </nav>

    <div class="section" style="margin-top:100px;">
        <div class="container">
            <!-- My Properties Section -->
            <div class="property_section shadow shadow-lg p-3">
                <div class="row mb-5 align-items-center">
                    <div class="col-6 col-lg-6">
                        <h2 class="font-weight-bold text-primary heading">My Properties</h2>
                    </div>
                    <div class="col-6 col-lg-6 text-lg-end">
                        <p>
                        <a href="#" target="_blank" class="btn btn-primary text-white py-3 px-4 m-2">View all properties</a>
                        <span>  <a href="add_property.php"  class="btn btn-info m-2">Add New Property</a></span>
                        </p>
                    </div>
                </div>

                <!-- Property Display -->
                <div class="row">
                    <div class="col-12">
                        <div class="property-slider-wrap">
                            <div class="property-slider">
                                <?php
                                    while ($row = $prop_result->fetch_assoc()) {
                                        echo "<div class='property-item'>";
                                            echo "<a href='property-single.php?id=" . $row['id'] . "' class='img'>
                                            <img src='" . $row['image'] . "' alt='Property Image' class='img-fluid' />
                                            </a>";
                                            echo "<div class='property-content'>";
                                                echo "<div class='price mb-2'><span>" . number_format($row['price']) . "</span></div>";
                                                echo "<div><span class='d-block mb-2 text-black-50'>" . $row['description'] . "</span></div>";
                                                echo "<span class='city d-block mb-3'>" . $row['location'] . "</span>";
                                                echo "<div class='specs d-flex mb-4'>
                                                <span class='d-block d-flex align-items-center me-3'>
                                                <span class='icon-book me-2'></span>
                                                <span class='caption'>Ready Title</span>
                                                </span>
                                                <span class='d-block d-flex align-items-center'>
                                                <span class='icon-image me-2'></span>
                                                <span class='caption'>Ready to View</span>
                                                </span>
                                            </div>";
                                        echo "<a href='property-single.php?id=" . $row['id'] . "' class='btn btn-primary py-2 px-3'>See details</a>";
                                        echo "<hr>";
                                        echo "<a href='edit-property.php?id=" . $row['id'] . "' class='btn btn-info py-2 px-3'>Edit Property</a>";
                                    
                                        echo "</div>"; // Close property-content
                                        echo "</div>"; // Close property-item
                                    }
                                ?>
                            </div>
                            <!-- slider end -->
                            <div
                                id="property-nav"
                                class="controls"
                                tabindex="0"
                                aria-label="Carousel Navigation"
                                >
                                <span
                                class="prev"
                                data-controls="prev"
                                aria-controls="property"
                                tabindex="-1"
                                >Prev</span
                                >
                                <span
                                class="next"
                                data-controls="next"
                                aria-controls="property"
                                tabindex="-1"
                                >Next</span
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of property section -->

     

            <div class="section_blog shadow shadow-lg mt-5 p-3">
    <div class="row mb-5 align-items-center">
        <div class="col-6 col-lg-6">
            <h2 class="font-weight-bold text-primary heading">My Blogs</h2>
        </div>
        <div class="col-6 col-lg-6 text-lg-end">
            <p>
                <a href="#" target="_blank" class="btn btn-primary text-white py-3 px-4">View all blogs</a>
            </p>
        </div>
    </div>

    <div class="row">
        <?php
            if ($blog_result->num_rows > 0) {
                while ($blog = $blog_result->fetch_assoc()) {
                    echo "<div class='col-lg-4 col-md-6'>";
                    echo "<div class='blog-item'>";

                    // Blog Image
                    echo "<div class='blog-image'>";
                    if (!empty($blog['image'])) {
                        echo "<img src='" . $blog['image'] . "' alt='Blog Image' class='img-fluid mb-3' />";
                    } else {
                        echo "<img src='images/default-image.jpg' alt='Default Blog Image' class='img-fluid mb-3' />";
                    }
                    echo "</div>"; // Close blog-image

                    // Blog Title and Content
                    echo "<h4>" . $blog['title'] . "</h4>";
                    echo "<p>" . substr($blog['content'], 0, 100) . "...</p>";
                    echo "<a href='blog-single.php?id=" . $blog['id'] . "' class='btn btn-primary py-2 px-3'>Read more</a>";
                    echo "<hr>";

                    // Edit and Delete Buttons
                    echo "<a href='edit-blog.php?id=" . $blog['id'] . "' class='btn btn-info py-2 px-3'>Edit</a>";
                    echo "<a href='delete-blog.php?id=" . $blog['id'] . "' class='btn btn-danger py-2 px-3'>Delete</a>";

                    echo "</div>"; // Close blog-item
                    echo "</div>"; // Close col-lg-4 col-md-6
                }
            } else {
                echo "<p>No blogs available.</p>";
            }
        ?>
    </div>
</div>
<!-- End of blog Section -->




            <!-- Messages Section -->
            <div class="section_messages mt-5 shadow shadow-lg p-3 mb-3">
                <div class="row mb-5 align-items-center">
                    <div class="col-6 col-lg-6">
                        <h2 class="font-weight-bold text-primary heading">Messages</h2>
                    </div>
                    <div class="col-6 col-lg-6 text-lg-end">
                        <p>
                        <a href="#" target="_blank" class="btn btn-primary text-white py-3 px-4">View all messages</a>
                        </p>
                    </div>
                   

                <div class="row">
                    <?php
                        if ($message_result->num_rows > 0) {
                            while ($message = $message_result->fetch_assoc()) {
                                echo "<div class='col-lg-4 col-md-6'>";
                                echo "<div class='message-item'>";
                                echo "<h5>" . $message['name'] . "</h5>";
                                echo "<p><strong>Email:</strong> " . $message['email'] . "</p>";
                                echo "<p><strong>Message:</strong> " . substr($message['message'], 0, 100) . "...</p>";
                                echo "<a href='view-message.php?id=" . $message['id'] . "' class='btn btn-primary py-2 px-3'>View</a>";
                                echo "<hr>";
                                echo "<a href='delete-message.php?id=" . $message['id'] . "' class='btn btn-danger py-2 px-3'>Delete</a>";
                                echo "</div>";
                                echo "</div>";
                                }
                        } else {
                            echo "<p>No messages available.</p>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="widget">
              <h3>Contact</h3>
              <address>Nairobi, Kenya</address>
              <ul class="list-unstyled links">
                <li><a href="tel://11234567890">+254741432777</a></li>
                <li><a href="info@truelightproperties.co.ke">info@truelightproperties.co.ke</a></li>
              </ul>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="widget">
              <h3>Sources</h3>
              <ul class="list-unstyled float-start links">
                <li><a href="#">About us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Vision</a></li>
                <li><a href="#">Mission</a></li>
                <li><a href="#">Terms</a></li>
                <li><a href="#">Privacy</a></li>
              </ul>
              <ul class="list-unstyled float-start links">
                <li><a href="#">Partners</a></li>
                <li><a href="login.php">Admin</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Creative</a></li>
              </ul>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="widget">
              <h3>Links</h3>
              <ul class="list-unstyled">
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Instagram</a></li>
                <li><a href="#">LinkedIn</a></li>
                <li><a href="#">Pinterest</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Preloader -->
    <div id="overlayer"></div>
    <div class="loader">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/counter.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>
