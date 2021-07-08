<!DOCTYPE html>
<div class="box banner">


<h1><a class="heading" href="index.php?page=home">Calories</a></h1></div> <!-- / banner -->

<!-- Navigation goes here.  Edit BOTH the file name and the link name -->
<div class="box nav">

    <div class="linkwrapper">
        <div class="commonsearches">
            <a href="index.php?page=showall">Menu</a> |
            <a href="index.php?page=calculator">Calculator</a> |
            <a href="index.php?page=showallactivity"> Activity </a>
        </div> <!-- / common searches -->

        <div class="topsearch">

            <!-- Quick Search -->
            <form method="post" action="index.php?page=quicksearch" enctype="multipart/form-data">

                <input class="search quickse    arch" type="text" name="quick_search" size="40" value="" required placeholder="Quick Search..." />

                <input class="submit" type="submit" name="find_quick" value="&#xf002;" />

            </form> <!-- / quick search -->

        </div> <!-- / top search -->

        <div class="topadmin">

            <?php
            if (isset($_SESSION['admin'])) { // end user is logged in if

            ?>
                <a href="index.php?page=../admin/newentry" title="Add a new entry"><i class="fa fa-plus fa-2x"></i></a>

                &nbsp; &nbsp;

                <a href="index.php?page=../admin/admin_panel" title="Admin Panel"><i class="fa fa-ellipsis-v fa-2x"></i></a>

                &nbsp; &nbsp;

                <a href="index.php?page=../admin/logout" title="logout"><i class="fa fa-sign-out fa-2x"></i></a>


            <?php
            } else {
            ?>
                <a href="index.php?page=../admin/login" title="login"><i class="fa fa-sign-in fa-2x"></i></a>
            <?php
            }
            ?>
        </div> <!-- / top admin -->

    </div>
    <!--- / link wrapper -->

</div> <!-- / nav -->