<?php defined('C5_EXECUTE') or die("Access Denied.");
/**
 * Sitewide Data helper
 * Used to gather the data for pages around the site
 *
 * @copyright © 2013 Artesian Design, Inc
 * @author Andrew Householder <andrew@artesiandesigninc.com>
 * @version 0.9
 */
class DataHelper {

	public $globalImageAttribute = 'page_thumbnail';
	public $placeholderFileID = 186; // this is hacky, but the only way to have a TRUE fallback
	protected $priorityAttribs = array();

	function setPriorityAttribs($attributes) {
		$this->priorityAttribs = (is_array($attributes)) ? $attributes : array($attributes);
	}

	/**
	 * Goes up the site tree
	 */
	function recursiveAttributeSearch($page, $akHandle){
		$ak = CollectionAttributeKey::getByHandle($akHandle);
		if (is_object($ak)) {
			$result = new stdClass();
			$result->value = false;
			$result->page = $page;

			$ancestors = Loader::helper('navigation')->getTrailToCollection($page);
			array_unshift($ancestors, $page);
			foreach ($ancestors as $ancestor) {
				if (!$result->value){
					$result->value = $ancestor->getAttribute($akHandle);
					if ($result->value) { $result->page = $ancestor; }
				}
			}
			return $result;
		}
	}

	/**
	 * Goes down the site tree to get a page thumbnail
	 * @param  [type] $page [description]
	 * @param  string $type [description]
	 * @return [type]       [description]
	 */
	function getPageThumbnail($page, $areas = 'Main') {

		// if the page is a redirected page, get the thumb from the target
		if ($page->getAttribute('page_redirect')) {
			Loader::model('master_redirect','master_redirect');
			$page = ($npage = MasterRedirect::getTargetPage($page)) ? $npage : $page;
		}

		if (!$img && is_object($project = $page->getAttribute('page_thumbnail'))) {
			$img = $page->getAttribute('page_thumbnail');
		} else

		if (!$img = self::scrapePageForThumbnail($page, $area)) {
			$pl = new PageList();
			$pl->filterByParentID($page->getCollectionID());
			$pl->sortByDisplayOrder();
			$pl->sortBy('is_featured','desc');

			foreach ($pl->get() as $page) {
				if (!$img) {
					$img = self::scrapePageForThumbnail($page, $area);
				}
			}
		}

		$img = ($img instanceof File) ? $img : DataHelper::getPlaceholderFile();
		return $img;

	}

	function getPageTitle($page) {
		$ptc = Loader::controller($page);
		if (is_object($ptc) && method_exists($ptc, 'getPageTitle')) {
			return $ptc->getPageTitle($page);
		} else {
			return $page->getCollectionName();
		}
	}

	function getPageDescription($page, $truncate = 0, $area = 'Main') {
		return $this->scrapePageForSummary($page, $truncate, $area);
	}

	/**
	 * This function scrapes a given page for an image of some sort to represent
	 * it as a thumbnail. Order of priority is
	 * 1. Priority Attributes
	 * 2. "page_thumbnail" attribute (image_file)
	 * 3. "gallery" attribute (fileset)
	 * 4. Parse through the passed area to find an image, slideshow, or content block.
	 * @param  Page $page
	 * @param  string $type variable to search different attribute "types" (grouped by prefix)
	 * @param  array  $priorityAttribs array of AttributeTypeHandles to skim first
	 * @return File $img
	 */
	function scrapePageForThumbnail($page, $areas = 'Main') {
		$img = false;

		// we take into account the priority attributes passed here
		if (count($this->priorityAttribs)) {
			foreach ($this->priorityAttribs as $akHandle) {
				if (!$img) {
					$img = self::getImageFromAttribute($page, $akHandle);
				}
			}
		}

		if (!is_array($areas)) {
			$areas = array($areas);
		}

		foreach($areas as $area) :

			// we fall back to normal methods
			if (!$img) {
				if (!$img = self::getImageFromAttribute($page, $this->globalImageAttribute)) {
					if ($files = self::getPageImages($page, 'default', 1, $this->priorityAttribs)) {
						$img = $files[0];
					}
					if (!$img) {
						$slideshow = new Area($area);
						$blocks = $slideshow->getAreaBlocksArray($page);
						if (count($blocks)) {
							foreach ($blocks as $b) {
								$btHandle = $b->getBlockTypeHandle();
								if (!$img) {
									switch($btHandle) {
										case('image'):
											$img = $b->getInstance()->getFileObject();
											break;
										case('slideshow'):
											$ss = $b->getInstance();
											$ss->loadBlockInformation();
											$img = File::getByID($ss->images[0]['fID']);
											break;
										case('content'):
											$content = $b->getInstance()->content;
											if (preg_match('/{CCM:FID_([0-9]+)}/i', $content, $ccmTag)) {
												$img = File::getByID($ccmTag[1]);
											}
											break;
										default:
										// nada
									}
								}
							}
						}
					}
				}
			}

		endforeach;

		return $img;

	}

	/**
	 * Function to gather some sort of summary data from a page. We check following locations in order
	 * 1. Meta Description (page attribute)
	 * 2. Description
	 * 3. Actual page content via the "Content" block in a given area (defaults to "Main")
	 * @param  Page $page 	page object to search
	 * @param  int $truncate Truncate summary by n chars.
	 * @param  string $area Area handle to search for content
	 * @return string       page summary
	 */
	function scrapePageForSummary($page, $truncate = 0, $area = 'Main'){
		$summary = '';
		if ($page instanceof Page && !$page->error) {
			if ($summary = $page->getAttribute('meta_description')) {
				// no code needed
			} elseif ($summary = $page->getCollectionDescription()) {
				// no code needed
			} else {
				// last ditch effort. we are going to try to get some content from the
				// first "Content" block in the given area (Defaults to "Main")
				$m = new Area($area);
				$blocks = $m->getAreaBlocksArray($page);
				if (count($blocks)) {
					foreach ($blocks as $b) {
						if (!$summary && $b->getBlockTypeHandle() == 'content') {
							$html = $b->getInstance()->getContent();
							$doc = new DOMDocument();
							$doc->loadHTML($html);
							$paragraphs = $doc->getElementsByTagName('p');
							if ($firstp = $paragraphs->item(0)) {
								$summary = strip_tags($firstp->nodeValue);
							}
						}
					}
				}
			}
		}
		return ($truncate) ? Loader::helper('text')->shortenTextWord($summary, $truncate) : $summary;
	}

	function getPageImages($page, $type = 'default', $qty = null) {

		$files = false;
		$fl = new FileList();

		if ($fsID = $page->getAttribute('gallery')) {
			$fl->filterBySet(FileSet::getByID($fsID));
		} else if ($fsID = $page->getAttribute($type . '_files')) {
			$pfs = FileSet::getByID($fsID);
			$ifs = FileSet::getByName(ucwords($type) . ' Images');
			$fl->filterBySet($pfs);
			$fl->filterBySet($ifs);
		}

		if ($fsID) {
			$fl->sortByFileSetDisplayOrder();
			$files = $fl->get($qty);
		}

		return $files;

	}

	function getImageFromFileset($fsID, $order = 'display'){
		// can pass a fileset object or fileset id
		$fs = ($fsID instanceof FileSet) ? $fs = $fsID : FileSet::getByID($fsID);
		$fl = new FileList();
		$fl->filterBySet($fs);

		switch ($order) {
			case('random'):
				$files = $fl->get();
				$file = $files[array_rand($files)];
				break;
			default:
				$fl->sortByFileSetDisplayOrder();
				$files->$fl->get(1);
				$file = $files[0];
		}
		return $file;
	}

	function getImageFromAttribute($page, $akHandle) {

		$img = false;
		$ak = CollectionAttributeKey::getByHandle($akHandle);
		if (is_object($ak)) {
			if ($val = $page->getAttribute($akHandle)) {
				$atHandle = $ak->getAttributeType()->getAttributeTypeHandle();
				switch ($atHandle) {
					case('image_file'):
						$img = $val;
						break;
					case('fileset'):
						$img = $this->getImageFromFileset($val);
						break;
					default:
				}
				$img->source = $akHandle;
			}
		}
		return $img;

	}

	public static function getPlaceholderFile() {

		// we get the stack for the placeholder image
		$phStack = Stack::getByName('Placeholder Image');
		if ($phStack instanceof Stack) {
			$image = false;
			// and then we iterate through the blocks and get the first image block's
			// image this allows for a crude sort of "versioning". they can have multiple
			// images in the stack, but whichever is first takes priority
			foreach ($phStack->getBlocks(STACKS_AREA_NAME) as $block) {
				if (!$image && $block->btHandle == 'image') {
					$image = $block->getController()->getFileObject();
				}
			}
		}

		if (!$image) {
			$fileList = new FileList();
			$fileList->filterByTag('placeholder');
			$files = $fileList->get(1);
			if (count($files)) {
				$image = $files[0];
			}
		}


		// if after all that if we STILL don't have an image, resort to getting one by ID
		$image = ($image) ? $image : File::getByID($this->placeholderFileID);
		$image->isPlaceholder = true; // quick lil property so we can tell on the views if we're being served a ph
		return $image;
	}

	/**
	 * text color logic. convert hexes to rgb and sum their values then if its greater than
	 * half the total color sum, its light so we use dark fonts.
	 * @param $color HEX value for a given color
	 * @param $darkColor HEX value if the background is light
	 * @param $lightColor HEX value if the background is dark
	 * @return $textColor HEX string of calculated color
	 */
	public function getReadableTextColor($color, $darkColor = '#000000', $lightColor = '#FFFFFF') {
		$isBackgroundLight = (!$color || (hexdec(substr($color,1,2)) + hexdec(substr($color,3,2)) + hexdec(substr($color,5,2)) > 384));
		return ($isBackgroundLight) ? $darkColor : $lightColor;
	}

}
