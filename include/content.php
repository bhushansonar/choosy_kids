<!-- main -->
<?php
global $objDB;
global $p;
$content_uri = $p;
$query = "SELECT * FROM `site_content` WHERE `content_uri`= '$content_uri'  AND `status` = '1'";
$result = $objDB->select($query);
if ($result) {
    ?><div id="main">
        <div class="main-container holder">
            <!-- grid-cols -->
            <div class="grid-cols">
                <!-- col67 -->
                <?php
                echo $result[0]['content'];
                ?>
            </div>
            <?php if (!isset($_GET['p']) || $p == "home") { ?>

                <section class="boxes">
                    <div class="holder">
                        <!-- title-box -->
                        <!-- boxes-section -->
                        <div class="boxes-section">
                            <article class="col">

                                <div class="text-box" style="width:450px;">
                                    <h3>training</h3>
                                    <img src="images/box-1.png">
                                    <p>A mentor is conscientious person who has he ability to listen, to instruct, to encourge, and to connect. A mentor shares knowledge, wisdom and understanding with a vested interest to guide and encourage</p>
                                    <a class="btn" href="#">Read More</a>
                                </div>
                            </article>
                            <article class="col">

                                <div class="text-box" style="width:450px;margin-left: 30px;">
                                    <h3>Music</h3>
                                    <img src="images/box-2.png">
                                    <p>A mentor is conscientious person who has he ability to listen, to instruct, to encourge, and to connect. A mentor shares knowledge, wisdom and understanding with a vested interest to guide and encourage</p>
                                    <a class="btn" href="#">Read More</a>
                                </div>
                            </article>
                        </div>
                    </div>
                </section>
            <?php } ?>
        </div>
        <!-- boxes -->

        <!-- clients -->
    </div>

    <?php
} else {
    echo "No data Selected";
}
 