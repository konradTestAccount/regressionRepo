<?php
$genericFacet = \T4\PHPSearchLibrary\FacetFactory::getInstance('GenericFacet', $documentCollection, $queryHandler);
$filters = $queryHandler->getQueryValuesForPrint();
$categoryFilters = array('courseType','courseDepartments','courseFaculties','courseDuration','courseLocation');
$dateFilters = array('startDateAfter','startDateBefore');
$rangeFilters = array('courseCost' => '24000');
?>
<div class="panel callout">

    <header>
        <div class="h4">Program search</div>
    </header>
    <form action="<?php echo $mainLibraryUrl ?>" method="get" class="sidebar-course-search">
        <label for="keywords">Search by text:
            <input type="text" name="keywords" id="keywords" placeholder="Enter search term" />
        </label>
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
        <div id="checkboxes-<?php echo strtolower($element)?>" class="columns-full">
            <div class=" course-search-widget">
                <fieldset>
                    <legend>Type</legend>
                    <label for="<?php echo $element; ?>" class="label-text">
                        Search by Type:
                    </label>
                    <select id="<?php echo $element; ?>" name="<?php echo $element ?>" data-cookie="T4_persona">
                        <option value="">All</option>
                        <?php foreach ($search as $item) : ?>
                        <option value="<?php echo strtolower($item['value']) ?>"
                                <?php echo $item['selected'] ? 'selected' : '' ?>><?php echo $item['value'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </fieldset>
            </div>
        </div>
        <?php endif; ?>
        <?php
                $element = 'courseDepartments';
                $genericFacet->setMember('element', $element);
                $genericFacet->setMember('type', 'List');
                $genericFacet->setMember('facetSource', 'documents');
                $genericFacet->setMember('sortingState', true);
                $genericFacet->setMember('multipleValueState', true);
                $genericFacet->setMember('multipleValueSeparator', ', ');
                $search = $genericFacet->displayFacet(); ?>
        <?php if (!empty($search)) : ?>
        <div id="checkboxes-<?php echo strtolower($element)?>" class="columns-full">
            <div class=" course-search-widget">
                <fieldset>
                    <legend>Department</legend>
                    <label for="<?php echo $element; ?>" class="label-text">
                        Search by Department:
                    </label>
                    <select id="<?php echo $element; ?>" name="<?php echo $element ?>" data-cookie="T4_persona">
                        <option value="">All</option>
                        <?php foreach ($search as $item) : ?>
                        <option value="<?php echo strtolower($item['value']) ?>"
                                <?php echo $item['selected'] ? 'selected' : '' ?>><?php echo $item['value'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </fieldset>
            </div>
        </div>
        <?php endif; ?>
        <?php
                $element = 'courseFaculties';
                $genericFacet->setMember('element', $element);
                $genericFacet->setMember('type', 'List');
                $genericFacet->setMember('facetSource', 'documents');
                $genericFacet->setMember('sortingState', true);
                $genericFacet->setMember('multipleValueState', true);
                $genericFacet->setMember('multipleValueSeparator', ', ');
                $search = $genericFacet->displayFacet(); ?>
        <?php if (!empty($search)) : ?>
        <div id="checkboxes-<?php echo strtolower($element)?>" class="columns-full">
            <div class=" course-search-widget">
                <fieldset>
                    <legend>Faculties</legend>
                    <label for="<?php echo $element; ?>" class="label-text">
                        Search by Faculties:
                    </label>
                    <select id="<?php echo $element; ?>" name="<?php echo $element ?>" data-cookie="T4_persona">
                        <option value="">All</option>
                        <?php foreach ($search as $item) : ?>
                        <option value="<?php echo strtolower($item['value']) ?>"
                                <?php echo $item['selected'] ? 'selected' : '' ?>><?php echo $item['value'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </fieldset>
            </div>
        </div>
        <?php endif; ?>
        <?php
                $element = 'courseDuration';
                $genericFacet->setMember('element', $element);
                $genericFacet->setMember('type', 'List');
                $genericFacet->setMember('facetSource', 'documents');
                $genericFacet->setMember('sortingState', true);
                $genericFacet->setMember('multipleValueState', true);
                $genericFacet->setMember('multipleValueSeparator', ', ');
                $search = $genericFacet->displayFacet(); ?>
        <?php if (!empty($search)) : ?>
        <div id="checkboxes-<?php echo strtolower($element)?>" class="columns-full">
            <div class=" course-search-widget">
                <fieldset>
                    <legend>Duration</legend>
                    <label for="<?php echo $element; ?>" class="label-text">
                        Search by Duration:
                    </label>
                    <select id="<?php echo $element; ?>" name="<?php echo $element ?>" data-cookie="T4_persona">
                        <option value="">All</option>
                        <?php foreach ($search as $item) : ?>
                        <option value="<?php echo strtolower($item['value']) ?>"
                                <?php echo $item['selected'] ? 'selected' : '' ?>><?php echo $item['value'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </fieldset>
            </div>
        </div>
        <?php endif; ?>
        <?php
                $element = 'courseLocation';
                $genericFacet->setMember('element', $element);
                $genericFacet->setMember('type', 'List');
                $genericFacet->setMember('facetSource', 'documents');
                $genericFacet->setMember('sortingState', true);
                $genericFacet->setMember('multipleValueState', true);
                $genericFacet->setMember('multipleValueSeparator', ', ');
                $search = $genericFacet->displayFacet(); ?>
        <?php if (!empty($search)) : ?>
        <div id="checkboxes-<?php echo strtolower($element)?>" class="columns-full">
            <div class=" course-search-widget">
                <fieldset>
                    <legend>Location</legend>
                    <label for="<?php echo $element; ?>" class="label-text">
                        Search by Location:
                    </label>
                    <select id="<?php echo $element; ?>" name="<?php echo $element ?>" data-cookie="T4_persona">
                        <option value="">All</option>
                        <?php foreach ($search as $item) : ?>
                        <option value="<?php echo strtolower($item['value']) ?>"
                                <?php echo $item['selected'] ? 'selected' : '' ?>><?php echo $item['value'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </fieldset>
            </div>
        </div>
        <?php endif; ?>
        <input type="submit" value="Find a program" class="button small primary expand" />
    </form>
</div><!-- /.panel -->
