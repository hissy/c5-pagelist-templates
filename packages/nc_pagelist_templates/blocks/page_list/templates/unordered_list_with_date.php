<?php
	defined('C5_EXECUTE') or die("Access Denied.");
	$textHelper = Loader::helper("text"); 
	// now that we're in the specialized content file for this block type, 
	// we'll include this block type's class, and pass the block to it, and get
	// the content
	
	if (count($cArray) > 0) { ?>
	<ul class="ccm-page-list">
	
	<?php
	for ($i = 0; $i < count($cArray); $i++ ) {
		$cobj = $cArray[$i]; 
		$target = $cobj->getAttribute('nav_target');

		if ($cobj->getCollectionPointerExternalLink() != '') {
			if ($cobj->openCollectionPointerExternalLinkInNewWindow()) {
				$target = "_blank";
			}
		}

		$title = $textHelper->entities($cobj->getCollectionName()); ?>
	
		<li>
			<div class="ccm-page-list-date-public"><?php echo $cobj->getCollectionDatePublic('Y-m-d') ?></div>
			<div class="ccm-page-list-title"><a <?php if ($target != '') { ?> target="<?php echo $target?>" <?php } ?> href="<?php echo $nh->getLinkToCollection($cobj)?>"><?php echo $title?></a></div>
			<?php if ( "" != $cobj->getCollectionDescription() ) { ?>
			<div class="ccm-page-list-description">
				<?php
				if(!$controller->truncateSummaries){
					echo $textHelper->entities($cobj->getCollectionDescription());
				}else{
					echo $textHelper->entities($textHelper->shorten($cobj->getCollectionDescription(),$controller->truncateChars));
				}
				?>
			</div>
			<?php } ?>
		</li>
	<?php } ?>
	
	</ul>
	
		<?php 
		if(!$previewMode && $controller->rss) {
				$btID = $b->getBlockTypeID();
				$bt = BlockType::getByID($btID);
				$uh = Loader::helper('concrete/urls');
				$rssUrl = $controller->getRssUrl($b);
				?>
				<div class="ccm-page-list-rss-icon">
					<a href="<?php echo $rssUrl?>" target="_blank"><img src="<?php echo $uh->getBlockTypeAssetsURL($bt, 'rss.png')?>" width="14" height="14" alt="<?php echo t('RSS Icon')?>" title="<?php echo t('RSS Feed')?>" /></a>
				</div>
				<link href="<?php echo BASE_URL . $rssUrl?>" rel="alternate" type="application/rss+xml" title="<?php echo $textHelper->entities($controller->rssTitle)?>" />
			<?php 
		}
	} 
	
	if ($paginate && $num > 0 && is_object($pl)) {
		$pl->displayPaging();
	}
	
?>