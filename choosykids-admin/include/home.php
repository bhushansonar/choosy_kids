<script type="text/javascript" src="<?php echo $AbsoluteURLAdmin; ?>js/ui/ui.tabs.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Tabs
        $('#tabs, #tabs2, #tabs5').tabs();
    });
</script>
<div id="sub-nav"><div class="page-title">
        <h1>Dashboard</h1>
    </div>
</div>
<div id="page-layout"><div id="page-content">
        <div id="page-content-wrapper">
            <div class="clear"></div>
            <div class="inner-page-title">
                <h2>Welcome to Choosy-Kids Panel</h2>
            </div>
            <div id="dashboard-buttons">
                <ul>
                    <li>
                        <a class="admin tooltip" title="Administrator" href="<?php echo $AbsoluteURLAdmin; ?>index.php?p=admin_list">Administrator</a>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <a class="users tooltip" title="User" href="<?php echo $AbsoluteURLAdmin; ?>index.php?p=user_list">Users</a>
                        <div class="clear"></div>
                    </li>

                    <li>
                        <a class="Books tooltip" title="Site Menu" href="<?php echo $AbsoluteURLAdmin; ?>index.php?p=list_site_menu">Site Menu</a>
                        <div class="clear"></div>
                    </li>

                    <li>
                        <a class="purchase tooltip" title="Site Content" href="<?php echo $AbsoluteURLAdmin; ?>index.php?p=list_site_content">Site Content</a>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <a class="product tooltip" title="Product" href="<?php echo $AbsoluteURLAdmin; ?>index.php?p=product">Product</a>
                        <div class="clear"></div>
                    </li>

                    </li>
<!--                    <li>
                        <a class="category tooltip" title="Category" href="<?php echo $AbsoluteURLAdmin; ?>index.php?p=category">Category</a>
                        <div class="clear"></div>
                    </li>-->
                    <li>
                        <a class="review tooltip" title="Product Review" href="<?php echo $AbsoluteURLAdmin; ?>index.php?p=product_review">Product Review</a>
                        <div class="clear"></div>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
