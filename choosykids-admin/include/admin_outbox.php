<?php
$p = loadVariable("p","");
$a = loadVariable("a","");
$To = loadVariable("To","");
$Subject = loadVariable("Subject","");
$Message = loadVariable("Message","");
if ($a=="") $a='list';
if ($a=="list") {
	$SQL="select * from message where Status='1' AND AdminSendID='1' order by MessageID DESC";
	$rsAdmin = $objDB->select($SQL);
}
?>
<script type="text/javascript">
$(document).ready(function() {
	/* Table Sorter */
	$("#sort-table")
	.tablesorter({
		widgets: ['zebra'],
		headers: { 
		            // assign the secound column (we start counting zero) 
		            0: { 
		                // disable it by setting the property sorter to false 
		                sorter: false 
		            }, 
		            // assign the third column (we start counting zero) 
		            5: { 
		                // disable it by setting the property sorter to false 
		                sorter: false 
		            } 
		        } 
	})
	
	.tablesorterPager({container: $("#pager")}); 
	
	$(".header").append('<span class="ui-icon ui-icon-carat-2-n-s"></span>');

	
});

 	/* Check all table rows */

var checkflag = "false";
function check(field) {
if (checkflag == "false") {
for (i = 0; i < field.length; i++) {
field[i].checked = true;}
checkflag = "true";
return "check_all"; }
else {
for (i = 0; i < field.length; i++) {
field[i].checked = false; }
checkflag = "false";
return "check_none"; }
}


</script>
<style type="text/css">
.hastable table a.btn span.ui-icon {
	left:0.2em;
}
</style>
<div id="sub-nav"><div class="page-title">
        		<?php if(isset($val) && $val != ''){
					 	$header = $val;
					 }else{
					 	$header = 'Message List';
					 }
					 ?>
			<h1><?=$header?></h1>
		</div>
</div>
<div id="page-layout">
	<div id="page-content">
			<div id="page-content-wrapper">
				<div class="inner-page-title">
					<h2>Messages</h2>
                <div class="clear"></div>
				</div>
				<div class="hastable">
                	
                		<?php if(isset($_SESSION['success']) && $_SESSION['success'] != '' && $_SESSION['check'] == 'add'){ ?>
                        <div class="response-msg inf ui-corner-all">
							<div>
                            <span>Success Message</span>
								<?=$_SESSION['success']?><?php unset($_SESSION['success']); unset($_SESSION['check']); ?>
							</div>
						</div>
						<?php } ?>
                        <?php if(isset($_SESSION['error']) && $_SESSION['error'] != '' && $_SESSION['check'] == 'add'){ ?>
                        <div class="response-msg inf ui-corner-all">
							<div>
                           		 <span>Error Message</span>
								<?=$_SESSION['error']?><?php unset($_SESSION['error']); unset($_SESSION['check']); ?>
							</div>
						</div>
						<?php } ?>
                   		<table id="sort-table"> 
						<thead> 
						<tr>
                            <th><input type="checkbox"  name="checkall" id="checkall" value="1" onclick="return checkAll(this.id);" /></th>
						    <th>User Name</th>
							<th>Subject</th>
							<th>Message</th>                                   
							<th>Date</th>
							<th style="width:128px">Options</th> 
						</tr> 
						</thead> 
                        <?php /*?><tfoot>
								<tr>
									<td colspan="6">
										<? if($totalPages>1){?>
                                            <div class="pagination">
                                                <a href="<?=$_SERVER['PHP_SELF']?>?p=<?=$p?>&page=1" title="First Page">&laquo; First</a>
                                                <?php if($page != 1){?>
	                                                <a href="<?=$_SERVER['PHP_SELF']?>?p=<?=$p?>&page=<? echo $page-1; ?>" title="Previous Page">&laquo; Previous</a>
                                                <?php } ?>
															<?php for ($j=1;$j<=$totalPages;$j++) {?>
                                                                	<a href="<?=$_SERVER['PHP_SELF']?>?p=<?=$p?>&page=<? echo $j; ?>" class="number <?php if ($j==$page){?> current<?php } ?>" title="Page :<? echo $j; ?>"><? echo $j; ?></a>
															<?php } ?>
												 <?php if($page != ($j -1)){?>
                                                	<a href="<?=$_SERVER['PHP_SELF']?>?p=<?=$p?>&page=<? echo $page+1; ?>" title="Next Page">Next &raquo;</a>
	                                             <?php } ?>                                                            
                                                <a href="<?=$_SERVER['PHP_SELF']?>?p=<?=$p?>&page=<?=$totalPages?>" title="Last Page">Last &raquo;</a>
                                            </div> <!-- End .pagination -->
                                        <? }?>
										<div class="clear"></div>
									</td>
								</tr>
							</tfoot><?php */?>
                        <tbody> 
                         <?php if(!empty($rsAdmin)){ ?>
                            <form id="frmdelmember" name="frmdelmember" method="post" action="manage.php"> 				
                            <input type="hidden" name="a" value="muldelete"> 
                            <input type="hidden" name="p" value="admin">
                            	<?php for($i=0;$i<count($rsAdmin);$i++){ ?>
						<tr>
							<td class="center"><?php if ($_SESSION['session_adminID']!=$rsAdmin[$i]['MessageID']) { ?><input name="multipledel[]" type="checkbox" id="multipledel[]" value="<?=$rsAdmin[$i]['MessageID']?>"><?php }else{ ?><?=$i+1?><?php } ?></td> 
                            <?php
							$SQL = "SELECT * FROM registration WHERE RegistrationID='".$rsAdmin[$i]['ToID']."'";
							$rsName = $objDB->select($SQL);
							for($n=0;$n<count($rsName);$n++){
							?>
                            <td><?=$rsName[$n]['FirstName']." ".$rsName[$n]['LastName']?></td>
                            <?php }?>
							<td><?=$rsAdmin[$i]['Subject']?></td>
							<td><?=$rsAdmin[$i]['Message']?></td>
							<td><?=$rsAdmin[$i]['Date']?></td>
							<td>
                            <a href="<?=$AbsoluteURLAdmin?>admin/index.php?p=outbox_msg_view&a=edit&MessageID=<?=$rsAdmin[$i]['MessageID']?>" title="View" style="float:left" class="btn_no_text btn ui-state-default ui-corner-all tooltip"><span class="ui-icon ui-icon-wrench"></span></a>
                                         <?php if ($_SESSION['session_adminID']!=$rsAdmin[$i]['MessageID'] && $role!=$rsAdmin[$i]['MessageID'] ) { ?>
										 <?php /*?><a href="javascript:void(0);" title="Delete" onclick='if(confirm(&quot;Are you sure you want to Delete?&quot;)) { document.location.href=&quot;<?=$AbsoluteURLAdmin?>admin/manage.php?p=admin&a=delete&AdminID=<?=$rsAdmin[$i]['AdminID']?>&quot; }' style="float:left"><span class="ui-icon ui-icon-circle-close"></span></a>
                                         <a id="modal_confirmation_link<?=$i?>" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="javascript:void(0);" title="Delete"><span class="ui-icon ui-icon-circle-close"></span></a>
                                        
                                         <div id="modal_confirmation<?=$i?>" title="Delete ?">
                                            <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure you want to Delete? This will Delete all the information related this admin.</p>
                                        </div>
                                        <script language="javascript" type="text/javascript">
											jQuery(document).ready(function() {
												jQuery("#modal_confirmation<?=$i?>").dialog({
													autoOpen: false,
													bgiframe: true,
													resizable: false,
													width:500,
													modal: true,
													overlay: {
														backgroundColor: '#000',
														opacity: 0.5
													},
													buttons: {
														'Delete': function() {
															document.location.href="<?=$AbsoluteURLAdmin?>admin/manage.php?p=message&a=delete&MessageID=<?=$rsAdmin[$i]['MessageID']?>";
															jQuery(this).dialog('close');
														},
														Cancel: function() {
															jQuery(this).dialog('close');
														}
													}
												});
												
												jQuery('#modal_confirmation_link<?=$i?>').click(function(){
													jQuery('#modal_confirmation<?=$i?>').dialog('open');
													return false;
												});
											});
										</script><?php */?> 
                                         <?php } ?>
									</td>
                          		</tr> 
                         <?php } ?>
                       	</form>
                         <?php }else{ ?>
                         <tr>
							<td colspan="10" align="center" style="text-align:center;font-weight:bolder"><?=NO_RECORD?></td>
                         </tr>
						<?php } ?>
						</tbody>
                        </table>
						<div id="pager">
					
								<a class="btn_no_text btn ui-state-default ui-corner-all first" title="First Page" href="#">
									<span class="ui-icon ui-icon-arrowthickstop-1-w"></span>
								</a>
								<a class="btn_no_text btn ui-state-default ui-corner-all prev" title="Previous Page" href="#">
									<span class="ui-icon ui-icon-circle-arrow-w"></span>
								</a>
							
								<input type="text" class="pagedisplay"/>
								<a class="btn_no_text btn ui-state-default ui-corner-all next" title="Next Page" href="#">
									<span class="ui-icon ui-icon-circle-arrow-e"></span>
								</a>
								<a class="btn_no_text btn ui-state-default ui-corner-all last" title="Last Page" href="#">
									<span class="ui-icon ui-icon-arrowthickstop-1-e"></span>
								</a>
								<select class="pagesize">
									<option value="10" selected="selected">10 results</option>
									<option value="20">20 results</option>
									<option value="30">30 results</option>
									<option value="40">40 results</option>

								</select>								
						</div>
					</form>
                	<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
	</div>
</div>
