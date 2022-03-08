<?php
$genericFacet = \T4\PHPSearchLibrary\FacetFactory::getInstance('GenericFacet', $documentCollection, $queryHandler);
$filters = $queryHandler->getQueryValuesForPrint();
$categoryFilters = array('courseType','courseDepartments','courseFaculties','courseDuration','courseLocation');
$dateFilters = array('startDateAfter','startDateBefore');
$rangeFilters = array('courseCost' => '24000');
?>
<div class="panel callout large-12 medium-12 course-search-widget clearfix columns">
    <h3>Find a program</h3>
    <form action="<?php echo $mainLibraryUrl ?>" class="home-course-search">
        <div class="row">
            <div class="small-12 columns">
                <label for="keywordsHome"><span class="sr-only">Search</span>
                    <input type="text" name="keywords" id="keywordsHome" placeholder="Enter search term" />
                </label>
            </div>
        </div>
        <?php
            $element = 'courseType';
            $genericFacet->setMember('element', $element);
            $genericFacet->setMember('type', 'List');
            $genericFacet->setMember('facetSource', 'documents');
            $genericFacet->setMember('sortingState', true);
            $genericFacet->setMember('multipleValueState', true);
            $genericFacet->setMember('multipleValueSeparator', ', ');
            $genericFacet->setMember('customSortByName', ['Undergraduate','Postgraduate','Advanced Diploma','Associate']);
            $search = $genericFacet->displayFacet(); ?>
        <?php if (!empty($search)) : ?>
        <fieldset>
            <legend class="hidden">Choose a Course Type</legend>
            <?php $i = 0; ?>
            <?php foreach ($search as $item) : ?>
          	<?php if (in_array($item['label'], ['Undergraduate', 'Postgraduate'])) : ?>
            <label for="<?php echo $element.'Home['.$i.']'; ?>" class="label-inline">
                <input type="radio" id="<?php echo $element.'Home['.$i++.']'; ?>" value="<?php echo $item['value'] ?>"
                       data-cookie="T4_persona" name="<?php echo $element ?>"
                       data-t4-value="<?php echo strtolower($item['value']) ?>"
                       <?php echo $item['selected'] ? 'checked' : '' ?>>
                <?php echo $item['label'] ?>
            </label>
          	<?php endif; ?>
            <?php endforeach; ?>
        </fieldset>
        <?php endif; ?>
        <input type="submit" value="Find a program" class="button small primary expand" />
    </form>
    <a href="<?php echo $mainLibraryUrl ?>" class="course-link">Programs A - Z</a>
</div>


