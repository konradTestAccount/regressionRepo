<?php
    $genericFacet = \T4\PHPSearchLibrary\FacetFactory::getInstance('GenericFacet', $documentCollection, $queryHandler);
    $filters = $queryHandler->getQueryValuesForPrint();
    $categoryFilters = array('courseType','courseDepartments','courseFaculties','courseDuration','courseLocation');
    $dateFilters = array('startDateAfter','startDateBefore');
    $rangeFilters = array('courseCost' => '24000');

    ?>
    
    <div id="searchoptions" role="search" data-t4-ajax-group="courseSearch" aria-label="Main Filters">
        <form method="get" action="<?php echo $mainLibraryUrl ?>">
            <div id="hidden-form" data-t4-ajax-group="courseSearch">
                <input type="hidden" name="keywords" value="<?php echo !empty($query['keywords']) ? $query['keywords']: ''  ?>" />
            </div>
            <div class="columns-full">
                <div class="h3">Refine your Results</div>
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
                <div id="checkboxes-<?php echo strtolower($element)?>" class="columns-full">
                    <div class="panel course-search-widget">
                        <fieldset>
                            <legend class="h4">Type</legend>
                                <label for="<?php echo $element; ?>" class="label-text">
                                    Select type of program:
                                </label>
                                <select id="<?php echo $element; ?>" name="<?php echo $element ?>" data-cookie="T4_persona">
                                    <option value="">All</option>
                                    <?php foreach ($search as $item) : ?>
                                        <option value="<?php echo strtolower($item['value']) ?>" <?php echo $item['selected'] ? 'selected' : '' ?>><?php echo $item['value'] ?></option>
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
                    <div class="panel course-search-widget">
                        <fieldset>
                            <legend class="h4">Departments</legend>
                            <?php $i = 0; ?>
                            <?php foreach ($search as $item) : ?>
                                <label for="<?php echo $element.'['.$i.']'; ?>" class="label-text">
                                    <input type="checkbox" id="<?php echo $element.'['.$i++.']'; ?>" value="<?php echo $item['value'] ?>" data-cookie="T4_persona" name="<?php echo $element ?>" data-t4-value="<?php echo strtolower($item['value']) ?>" <?php echo $item['selected'] ? 'checked' : '' ?>>
                                    <?php echo $item['label'] ?>
                                </label>
                            <?php endforeach; ?>
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
                    <div  class="panel course-search-widget">
                        <fieldset>
                            <legend class="h4">Faculty</legend>
                            <?php $i = 0; ?>
                            <?php foreach ($search as $item) : ?>
                                <label for="<?php echo $element.'['.$i.']'; ?>" class="label-text">
                                    <input type="checkbox" id="<?php echo $element.'['.$i++.']'; ?>" value="<?php echo $item['value'] ?>" data-cookie="T4_persona" name="<?php echo $element ?>" data-t4-value="<?php echo strtolower($item['value']) ?>" <?php echo $item['selected'] ? 'checked' : '' ?>>
                                    <?php echo $item['label'] ?>
                                </label>
                            <?php endforeach; ?>
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
                    <div class="panel course-search-widget">
                        <fieldset>
                            <legend class="h4">Duration</legend>
                            <?php $i = 0; ?>
                            <label for="<?php echo $element.'['.$i.']'; ?>" class="label-text">
                                <input type="radio" id="<?php echo $element.'['.$i++.']'; ?>" value="" data-cookie="T4_persona" name="<?php echo $element ?>" <?php echo !isset($filters[$element]) ? 'checked' : '' ?>>
                                All
                            </label>
                            <?php foreach ($search as $item) : ?>
                                <label for="<?php echo $element.'['.$i.']'; ?>" class="label-text">
                                    <input type="radio" id="<?php echo $element.'['.$i++.']'; ?>" value="<?php echo $item['value'] ?>" data-cookie="T4_persona" name="<?php echo $element ?>" data-t4-value="<?php echo strtolower($item['value']) ?>" <?php echo $item['selected'] ? 'checked' : '' ?>>
                                    <?php echo $item['label'] ?>
                                </label>
                            <?php endforeach; ?>
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
                $genericFacet->setMember('multipleValueSeparator', '|');
                $search = $genericFacet->displayFacet(); ?>
            <?php if (!empty($search)) : ?>
            <?php 
                $subSearch = [];
                foreach ($search as $key => &$item) :
                    $subitem = explode('>', $item['value']);
                    if (isset($subitem[1]) && !empty($subitem[1])) {
                        if (!isset($subSearch[$subitem[0]])) {
                            $subSearch[$subitem[0]] = [
                                'value' => $subitem[0],
                                'label' => $subitem[0],
                                'selected' => $item['selected'],
                                'categories' => []
                            ];
                        }

                        $subSearch[$subitem[0]]['categories'][] = [
                            'value' => $item['value'],
                            'label' => $subitem[1],
                            'selected' => $item['selected']
                        ];
                    } else {
                        $subSearch[$item['value']] = $item;
                        $subSearch[$item['value']]['categories'] = [];
                    }
                endforeach;
                usort($subSearch, function ($a, $b) {
                    return $a['value'] > $b['value'];
                });
                $search = $subSearch;

                ?>
                <div id="checkboxes-<?php echo strtolower($element)?>" class="columns-full">
                    <div class="panel course-search-widget">
                        <fieldset>
                            <legend class="h4">Campus</legend>
                            <?php $i = 0; ?>
                            <ul class="no-bullet">
                            <?php foreach ($search as $key => $item) : ?>
                                <li>
                                <label for="<?php echo $element.'['.$i.']'; ?>" class="label-text">
                                    <input type="checkbox" id="<?php echo $element.'['.$i++.']'; ?>"  value="<?php echo (!isset($item['categories']) || (isset($item['categories']) && empty($item['categories']))) ? $item['value'] : '' ?>" data-cookie="T4_persona" name="<?php echo $element ?>" data-t4-value="<?php echo strtolower($item['value']) ?>" <?php echo $item['selected'] ? 'checked' : '' ?>>
                                    <?php echo $item['label'] ?>
                                </label>

                                <?php if (isset($item['categories'])) : ?>
                                        <ul>
                                        <?php foreach ($item['categories'] as $subitem) : ?>
                                            <li>
                                            <label for="<?php echo $element.'['.$i.']'; ?>" class="label-text subitem">
                                            <input type="checkbox" id="<?php echo $element.'['.$i++.']'; ?>" value="<?php echo $subitem['value'] ?>" data-cookie="T4_persona" name="<?php echo $element ?>" data-t4-value="<?php echo strtolower($subitem['value']) ?>" <?php echo $subitem['selected'] ? 'checked' : '' ?>>
                                            <?php echo $subitem['label'] ?>
                                            </label>
                                            </li>
                                        <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                    </li>
                            <?php endforeach; ?>
                        </ul>
                        </fieldset>
                    </div>
                </div>
            <?php endif; ?>
            <?php
                $elementAfter = 'startDateAfter';
                $genericFacet->setMember('element', $elementAfter);
                $genericFacet->setMember('type', 'Date');
                $genericFacet->setMember('facetSource', 'documents');
                $genericFacet->setMember('sortingState', true);
                $genericFacet->setMember('multipleValueSeparator', ', ');
                $dateAfter = $genericFacet->displayFacet();
                $elementBefore = 'startDateBefore';
                $genericFacet->setMember('element', $elementBefore);
                $genericFacet->setMember('type', 'Date');
                $genericFacet->setMember('facetSource', 'documents');
                $genericFacet->setMember('sortingState', true);
                $genericFacet->setMember('multipleValueSeparator', ', ');
                $dateBefore = $genericFacet->displayFacet(); ?>
            <?php if (!empty($search)) : ?>
                <div id="range-<?php echo strtolower($element)?>" class="columns-full">
                    <div class="panel course-search-widget">
                        <div class="h4">Starting Dates</div>
                        <label for="date-<?php echo strtolower($elementAfter)?>">
                            From
                        </label>
                        <input
                            name="<?php echo $elementAfter ?>"
                            id="date-<?php echo strtolower($elementAfter)?>"
                            type="date"
                            placeholder="YYYY-MM-DD"
                            value="<?php echo $dateAfter['value']; ?>" />
                        <label for="date-<?php echo strtolower($elementBefore)?>">
                            To
                        </label>
                        <input
                            name="<?php echo $elementBefore ?>"
                            id="date-<?php echo strtolower($elementBefore)?>"
                            type="date"
                            placeholder="YYYY-MM-DD"
                            value="<?php echo $dateBefore['value']; ?>" />
                    </div>
                </div>
            <?php endif; ?>
             <?php
                 $element = 'courseCost';
                $genericFacet->setMember('element', $element);
                $genericFacet->setMember('type', 'Range');
                $genericFacet->setMember('facetSource', 'documents');
                $genericFacet->setMember('sortingState', true);
                $genericFacet->setMember('multipleValueSeparator', ', ');
                $search = $genericFacet->displayFacet(); ?>
            <?php if (!empty($search)) : ?>
                 <div id="range-<?php echo strtolower($element)?>" class="columns-full">
                     <div class="panel course-search-widget">
                        <div class="h4">Maximum Cost</div>
                         <label for="pay-range-slider" class="hidden">
                             Range
                         </label>
                         <?php $step = ($search['max']-$search['min'])/8 ?>
                         <div class="range">
                            <input
                                name="<?php echo $element ?>"
                                class="range-slider2"
                                id="pay-range-slider"
                                type="range"
                                min="<?php echo $search['min']; ?>"
                                max="<?php echo $search['max']; ?>"
                                step="<?php echo $step; ?>"
                                value="<?php echo $search['value']; ?>" />
                                <div class="range-list">
                                    <?php if ($step > 0) : ?>
                                        <?php for ($i=$search['min'], $c=0; $i<=$search['max']; $i+=$step, $c++) : ?>
                                            <?php if ($c%2!=1) : ?>
                                                <span><?php echo '$'.($i/1000).'K' ?></span>
                                            <?php endif;?> 
                                        <?php endfor; ?>
                                    <?php endif;?> 
                                </div>
                        </div>
                     </div>
                 </div>
            <?php endif; ?>
             <noscript>
                <div class="submit-btn">
                    <div class="panel">
                        <button type="submit" class="button small secondary expand">Filter</button>
                    </div>
                </div>
             </noscript>
        </form>
    </div>

