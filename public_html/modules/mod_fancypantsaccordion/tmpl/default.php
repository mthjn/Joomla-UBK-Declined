<?php

#@license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

defined('_JEXEC') or die;

// loads in contenthelper if needed (on pages without an article etc)
if(!class_exists('ContentHelperRoute')) require_once (JPATH_SITE . '/components/com_content/helpers/route.php');

?>

<?php
	$showCat = $params->get('showCat');
	$headingHeight = $params->get('headingHeight');
    $headingSize = $params->get('headingSize');
    $catSize = $params->get('catSize');
    $database = JFactory::getDbo();
    $close = $params->get('close_buttons');
    $i = 1;
?>

<?php if($headingHeight != "" || $headingSize != "" || $catSize != "" ): ?>
	<style type="text/css">
		<?php if($headingHeight != "" ): ?>
			.fancypantsaccordionholder > ul > li { height: <?php echo $headingHeight; ?>px; list-style: none; }
		<?php endif; ?>
		<?php if($headingHeight != "" && $headingSize == "" ): ?>
			.fancypantsaccordionholder > ul > li .headerlink { line-height: <?php echo $headingHeight; ?>px; }
		<?php elseif ($headingHeight == "" && $headingSize != "" ): ?>
			.fancypantsaccordionholder > ul > li .headerlink { font-size: <?php echo $headingSize; ?>px; }
		<?php elseif($headingHeight != "" && $headingSize !="" ): ?>
			.fancypantsaccordionholder > ul > li .headerlink { font-size: <?php echo $headingSize; ?>px; line-height: <?php echo $headingHeight; ?>px; }
		<?php endif; ?>
		<?php if($showCat == '1' && $catSize == ""): ?>
			.fancypantsaccordionholder > ul > li .headerlink p{ display: inline; }
		<?php elseif($showCat == '1' && $catSize != ""): ?>
			.fancypantsaccordionholder > ul > li .headerlink p{ display: inline; font-size: <?php echo $catSize; ?>px; }
		<?php endif; ?>
	</style>
<?php endif; ?>

<div class="fancypantsaccordionholder <?php echo $moduleclass_sfx;?>">

	<ul class="accordion">

		<?php foreach ($list as $item): ?>

		<?php
			$categoryID = $item->catid;
			$itemID = $item->id;

			$query = $database->getQuery(true);
			$query->select('title');
			$query->from('#__categories');
			$query->where('id = '.$categoryID);
			$database->setQuery($query);
			$catname = $database->loadResult();

			$url = JRoute::_(ContentHelperRoute::getArticleRoute($item->id, $item->catid));
		?>

		<li class="accordion-item">
			<a href="#" id="c7-accordion-heading-<?php echo $i ;?>" class="headerlink">
			<?php if ($showCat == '0'):
					echo htmlspecialchars($item->title);
				else:
					echo htmlspecialchars($item->title)." <p>(".$catname.")</p>" ;
				endif;
			?>
				<span class="acc-arrow">Open or Close</span>
			</a>

			<div class="acc-content">
				<?php

					$intro = $item->introtext;

					if($params->get('render','1')){
						JPluginHelper::importPlugin('content');
						$intro = JHtml::_('content.prepare', $intro, '', 'mod_custom.content');
					}

					echo $intro;

					if($item->readmore != 0){
						echo "<a href='". $url ."'>Read More</a>";
					}

                    if($close == '1'){
                        echo '<button class="close">Close this</button>';
                    }

				?>
			</div>
		</li>

		<?php $i++; ?>

		<?php endforeach; ?>
	</ul>

</div>

<script type="text/javascript">
	
	jQuery(function() {
		var hello = jQuery('.fancypantsaccordionholder').accordion({
			oneOpenedItem:true,
			speed:300,
			scrollSpeed:300
			<?php
				if($params->get('firstopen') == 1){
					if($params->get('whichopen')){
						echo ",open:".$params->get('whichopen');
					} else {
						echo ",open:0";
					}
				}
			?>
		});

		<?php if($close == '1'){ ?>
        	jQuery('.close').on('click', function(){
            	var open_item = jQuery(this).parents('.acc-open');
				open_item.children('a').click();
        	});
		<?php } ?>
    });

</script>
