<?php
    $genericFacet = \T4\PHPSearchLibrary\FacetFactory::getInstance('GenericFacet', $documentCollection, $queryHandler);
    $filters = $queryHandler->getQueryValuesForPrint();
    $categoryFilters = array('type','title','department');
    $dateFilters = array();
    $rangeFilters = array();
    ?>
   <div id="searchoptions-filters" role="search" data-t4-ajax-group="directorySearch">
            <div id="event-filters">
                <?php if ($filters !== null) : ?>
                    <ul class="no-bullet">
                        <?php
                        $i = 0;
                        foreach ($categoryFilters as $key) {
                            if (isset($filters[$key]) && is_array($filters[$key])) :
                                foreach ($filters[$key] as $value) :?>
                                    <li class="filter-<?php echo $i++ ?>  small primary"  data-t4-value="<?php echo strtolower($value) ?>" data-t4-filter="<?php echo $key ?>"><?php echo $value ?><span  class="remove"><i class="fa fa-times"></i></span></li>
                                    <?php
                                endforeach;
                            elseif (isset($filters[$key])) :
                                $value = $filters[$key]; ?>
                                <li class="filter-<?php echo $i++ ?>  small primary"  data-t4-value="<?php echo strtolower($value) ?>"  data-t4-filter="<?php echo $key ?>"><?php echo $value ?><span  class="remove"><i class="fa fa-times"></i></span></li>
                                <?php
                            endif;
                        }
                        foreach ($dateFilters as $key) {
                            if (isset($filters[$key])) :
                                $value = $filters[$key]; ?>
                                <li class="filter-<?php echo $i++ ?>  small primary" data-t4-filter="<?php echo $key ?>"><?php echo date('m/d/Y', strtotime($value)); ?><span class="remove"><i class="fa fa-times"></i></span></li>
                                <?php
                            endif;
                        }
                        foreach ($rangeFilters as $key => $max) {
                            if (isset($filters[$key]) && $filters[$key]!== $max) :
                                $value = $filters[$key]; ?>
                                <li class="filter-<?php echo $i++ ?>  small primary" data-t4-filter="<?php echo $key ?>"><?php echo '$'.$value; ?><span class="remove"><i class="fa fa-times"></i></span></li>
                                <?php
                            endif;
                        }
                        if (isset($filters['keywords'])) :
                            ?>
                                <li class="filter-<?php echo $i++ ?> small primary"  data-t4-filter="keywords">  <?php echo $filters['keywords'] ?><span class="remove"><i class="fa fa-times"></i></span></li>
                            <?php
                        endif; ?>
                    </ul>
                    <?php if ($i > 0) : ?>
                        <a href="index.php" class="button primary small clear-filters" data-t4-ajax-link="true">Clear Filters <i class="fa fa-chevron-right"></i></a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
    </div>
    <div class="staff-search-filters" id="searchoptions"  role="search" data-t4-ajax-group="directorySearch"  >
        <form method="get">
            <div id="hidden-form"  data-t4-ajax-group="directorySearch">
                <?php $hiddenFields = array('keywords', 'paginate','showall', 'lastname'); ?>
                <?php foreach ($hiddenFields as $hiddenField) : ?>
                    <?php if (isset($query[$hiddenField])) : ?>
                        <input type="hidden" name="<?php echo $hiddenField ?>" value=" <?php echo is_array($query[$hiddenField]) ? implode(' ', $query[$hiddenField]) : $query[$hiddenField]; ?>" />
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="columns-full">
                <div class="h3">Refine your Results</div>
            </div>
            <?php
            $element = 'type';
            $genericFacet->setMember('element', $element);
            $genericFacet->setMember('type', 'List');
            $genericFacet->setMember('facetSource', 'documents');
            $genericFacet->setMember('sortingState', true);
            $genericFacet->setMember('multipleValueState', true);
            $genericFacet->setMember('multipleValueSeparator', ', ');
            $genericFacet->setMember('customSortByName', [
                'Academic',
                'Researcher',
                'Other'
            ]);
            $search = $genericFacet->displayFacet();
            ?>
            <?php if (!empty($search)) : ?>
                <div id="checkboxes-<?php echo strtolower($element)?>" class="columns-full">
                    <div class="panel staff-search-widget">
                        <fieldset>
                            <legend class="h4">Type</legend>
                            
                                <span class="clear" data-t4-clear="<?php echo $element; ?>">Clear filters &times;</span>
                            
                                <label for="<?php echo $element; ?>" class="label-text">
                                    Select type of staff:
                                </label>
                                <select id="<?php echo $element; ?>" name="<?php echo $element ?>" data-cookie="T4_persona">
                                    <option value="">All</option>
                                    <?php foreach ($search as $item) : ?>
                                        <option data-category="<?php echo strtolower($item['value']) ?>" <?php echo $item['selected'] ? 'selected' : '' ?>><?php echo $item['value'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                        </fieldset>
                    </div>
                </div>
            <?php endif; ?>
            <?php
                $element = 'title';
                $genericFacet->setMember('element', $element);
                $genericFacet->setMember('type', 'List');
                $genericFacet->setMember('facetSource', 'documents');
                $genericFacet->setMember('sortingState', true);
                $genericFacet->setMember('multipleValueState', true);
                $genericFacet->setMember('multipleValueSeparator', ', ');
                $search = $genericFacet->displayFacet();
            ?>
            <?php if (!empty($search)) : ?>
                <div id="checkboxes-<?php echo strtolower($element)?>" class="columns-full">
                    <div class="panel staff-search-widget">
                        <fieldset>
                            <legend class="h4">Title</legend>
                            
                                <span class="clear" data-t4-clear="<?php echo $element; ?>">Clear filters &times;</span>
                            
                            <?php $i = 0; ?>
                            <?php foreach ($search as $item) : ?>
                                <label for="<?php echo $element.'['.$i.']'; ?>" class="label-text">
                                    <input type="checkbox" id="<?php echo $element.'['.$i++.']'; ?>" value="<?php echo $item['value'] ?>" data-cookie="T4_persona" name="<?php echo $element ?>" data-category="<?php echo strtolower($item['value']) ?>" <?php echo $item['selected'] ? 'checked' : '' ?>>
                                    <?php echo $item['label'] ?>
                                </label>
                            <?php endforeach; ?>
                        </fieldset>
                    </div>
                    
                </div>
            <?php endif; ?>
            <?php
                $element = 'department';
                $genericFacet->setMember('element', $element);
                $genericFacet->setMember('type', 'List');
                $genericFacet->setMember('facetSource', 'documents');
                $genericFacet->setMember('sortingState', true);
                $genericFacet->setMember('multipleValueState', true);
                $genericFacet->setMember('multipleValueSeparator', ', ');
                $search = $genericFacet->displayFacet();
            ?>
            <?php if (!empty($search)) : ?>
                <div id="checkboxes-<?php echo strtolower($element)?>" class="columns-full">
                    <div class="panel staff-search-widget">
                        <fieldset>
                            <legend class="h4">Departments</legend>
                            
                                <span class="clear" data-t4-clear="<?php echo $element; ?>">Clear filters &times;</span>
                            
                            <?php $i = 0; ?>
                            <?php foreach ($search as $item) : ?>
                                <label for="<?php echo $element.'['.$i.']'; ?>" class="label-text">
                                    <input type="checkbox" id="<?php echo $element.'['.$i++.']'; ?>" value="<?php echo $item['value'] ?>" data-cookie="T4_persona" name="<?php echo $element ?>" data-category="<?php echo strtolower($item['value']) ?>" <?php echo $item['selected'] ? 'checked' : '' ?>>
                                    <?php echo $item['label'] ?>
                                </label>
                            <?php endforeach; ?>
                        </fieldset>
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


